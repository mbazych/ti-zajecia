

 <?php
    session_start();
    if(!empty($_POST['name']) &&  !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['birthday'])){



        if($_POST['email']!=$_POST['email2']){
            $_SESSION['error'] = "Provided emails are different from each other";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        }

        if($_POST['pass']!=$_POST['pass2']){
            $_SESSION['error'] = "Provided passwords are different";
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }
        if(!isset($_POST['terms'])){
            $_SESSION['error'] = "Please agree to the terms";
            ?>
            <script>
                window.history.back();
            </script>
            <?php
        
        }
        require_once './connect.php';

        if($conn->connect_errno){
            $_SESSION['error']="Error connecting to the database";
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

                $query = "SELECT * FROM `user` WHERE email=?";
                $statement = $conn->prepare($query);
                $statement->bind_param('s',$email);
                $statement->execute();
                $input = $statement->get_result();
                $count=0;
                while($record = $input->fetch_assoc()){
                    $count++;
                }
                if($count>0)
                    $_SESSION['error']="Account with provided email already exists";
                else
                    $_SESSION['error']= 'Something went wrong. Please contact support@bazych.com';
                header("location: ../pages/register.php?asd='$pass'");
            }
        
        
        }


    }else{
        $_SESSION['error'] = "Some fields are empty";
        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
?>