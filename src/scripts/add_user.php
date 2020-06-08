<?php
    session_start();
    if(!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['city']) && !empty($_POST['pass2']) && !empty($_POST['birthday']) && !empty($_POST['name']) && !empty($_POST['surname']) ){


        

        if($_POST['pass']!=$_POST['pass2']){
            $_SESSION['error'] = "Hasła są rózne";
             ?>
             <script>
                 window.history.back();
             </script>
             <?php
        }

        require_once './connect.php';

        if($conn->connect_errno){
            $_SESSION['error']="Błędne połączenie z bazą danych";
            header("location: ../register.php");
        }else{
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            $city=$_POST['city'];
            $birthday=$_POST['birthday'];
            $photoname = $_FILES['photo']['name'];
            if ($photoname != '') {
                $uploaddir = '../static/img/';
                $photo = $uploaddir . basename($photoname);
                if (file_exists($photo)) {
                    $photoname = "(2)" . $photoname;
                    $photo = $uploaddir . basename($photoname);
                    if (file_exists($photo)) {
                        $photoname = "(2)" . $photoname;
                        $photo = $uploaddir . basename($photoname);
                    }
                }
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
                    $_SESSION['error'] = "Error while saving the file";
                ?>
                    <script>
                        window.history.back();
                    </script>
            <?php
                    exit();
                }
            }else{
                $photoname="default_photo.png";
            }

            $sql= "INSERT INTO `users`(`name`, `surname`, `email`, `password`, `city_id`, `birthday`, `photo_path`)
            VALUES (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssiss',$name,$surname,$email,$pass, $city, $birthday, $photoname);
            $i=$stmt->execute();
            if($i){
                $_SESSION['info']="Now you can log in";
                header("location: ../login.php");
                exit();
            }else{

                 $zapytanie = "SELECT * FROM `users` WHERE email=?";
                 $statement = $conn->prepare($zapytanie);
                 $statement->bind_param('s',$email);
                 $statement->execute();
                 $wpisz = $statement->get_result();
                 $count=0;
                 while($rekord = $wpisz->fetch_assoc()){
                     $count++;
                 }
                 if($count>0)
                     $_SESSION['error']="Account with this email already exsists";
                 else
                     $_SESSION['error']= 'Something went wrong';
                     ?>
                     <script>
                         window.history.back();
                     </script>
             <?php
                
            }
        
        
        }


    }else{
        $_SESSION['error'] = "Wypełnij wszystkie pola";
         ?>
             <script>
                 window.history.back();
             </script>
         <?php
    }
?>
