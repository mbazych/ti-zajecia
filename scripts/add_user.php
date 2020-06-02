
<?
    session_start();
    if(!empty($_POST['name']) &&  !empty($_POST['surname']) && !empty($_POST['email'])&& !empty($_POST['city'])&& !empty($_POST['nationality']) && !empty($_POST['email2']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['birthday'])){

        if(!isset($_POST['terms'])){
            $_SESSION['error'] = "Zaznacz pole z regulaminem";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        
        }

        if($_POST['email']!=$_POST['email2']){
            $_SESSION['error'] = "Emaile są rózne";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        }

        if($_POST['pass']!=$_POST['pass2']){
            $_SESSION['error'] = "Hasła są rózne";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        }

        require_once './connect.php';

        if($conn->connect_errno){
            $_SESSION['error']="Błędne połączenie z bazą danych";
            header("location: ../pages/register.php");
        }else{
            echo 'ok';
            $city=$_POST['city'];
            $nationality=$_POST['nationality'];
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            // szyfrowanko z ARGON2ID
            // $pass = password_hash($pass2,PASSWORD_ARGON2ID); //argon nie dziala
            $birthday=$_POST['birthday'];
            $sql= "INSERT INTO `user`(`name`, `surname`, `city_id`, `nationality_id`, `email`, `pass`)
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssiiss',$name,$surname,$city,$nationality,$email,$pass);
            $i=$stmt->execute();
            if($i){
                header("location: ../index.php?register=success");
                exit();
            }else{

                $zapytanie = "SELECT * FROM `user` WHERE email=?";
                $statement = $conn->prepare($zapytanie);
                $statement->bind_param('s',$email);
                $statement->execute();
                $wpisz = $statement->get_result();
                $count=0;
                while($rekord = $wpisz->fetch_assoc()){
                    $count++;
                }
                if($count>0)
                    $_SESSION['error']="Email juz istnieje w bazie";
                else
                    $_SESSION['error']= 'Cos poszlo nie tak';
                header("location: ../pages/register.php");
            }
        
        
        }


    }else{
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        ?>
            <script>
                window.history.back();
            </script>
        <?
    }
?>