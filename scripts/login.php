<?php
    session_start();
    if(isset($_SESSION['logged']['permission'])){
        switch($_SESSION['logged']['permission']){
          case 1:
           header('location:./../pages/logged/admin.php');
          break;
       
          case 2:
           header('location:./../pages/logged/user.php');
          break;
    
          header('location:./../pages/logged/moderator.php');
          case 3:
       break;
      }
      exit();
      }

    if(!empty($_POST['email']) && !empty($_POST['pass'])){
        require_once('./connect.php');
        if($conn->connect_errno!=0){
            $_SESSION['error'] = "Błędne połączenie z bazą danych";
            header("location: ../");
            exit();
        }
        
        $email = htmlentities($_POST['email'],ENT_QUOTES, "UTF-8");
        $pass = htmlentities($_POST['pass'],ENT_QUOTES, "UTF-8");

    $sql = sprintf("SELECT * FROM `user` WHERE email='%s'",mysqli_real_escape_string($conn, $email));

    if($res = $conn->query($sql)){
        // $pass = password_hash($pass2,PASSWORD_ARGON2ID); //argon nie dziala
        if(!$res->num_rows){
            $_SESSION['error'] = "Niepoprawny email lub hasło";
            header("location: ../");
            exit();
        }
        $row = $res->fetch_assoc();
        if($row['pass']!=$pass){
            $_SESSION['error'] = "Niepoprawny email lub hasło";
            header("location: ../");
            exit();
        }
        if($row['status_id']!=1){
            $_SESSION['error'] = "Skontaktuj się z administratorem aby odblokować konto lub aktywuj je na poczcie";
            header("location: ../");
            exit();
        }


       $_SESSION['logged']['permission']=$row['permission_id'];
       $_SESSION['logged']['name']=$row['name'];
       $_SESSION['logged']['surname']=$row['surname'];
       $_SESSION['logged']['email']=$row['email'];
       $conn->close();

       switch($_SESSION['logged']['permission']){
           case 1:
            header('location:./../pages/logged/admin.php');
           break;
        
           case 2:
            header('location:./../pages/logged/user.php');
           break;

           header('location:./../pages/logged/moderator.php');
           case 3:
        break;

       }
    //    header('location:../pages/');
        

    }

    }else{
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        header("location: ../");
        exit();
    }


?>