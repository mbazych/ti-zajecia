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
            $sql= "INSERT INTO `users`(`name`, `surname`, `email`, `password`, `city_id`, `birthday`)
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssis',$name,$surname,$email,$pass, $city, $birthday);
            $i=$stmt->execute();
            if($i){
                exit();
                header("location: ../index.php");
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
                     $_SESSION['error']="Email juz istnieje w bazie";
                 else
                     $_SESSION['error']= 'Cos poszlo nie tak';
                header("location: ../register.php");
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
