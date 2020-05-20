<?php
    session_start();
    if(!empty($_POST['email']) && !empty($_POST['pass'])){

        require_once './connect.php';

        if($conn->connect_errno){
            $_SESSION['error']="Error connecting to the database";
            header("location: ../pages/register.php");
        }else{
            
            $email=$_POST['email'];
            $pass=$_POST['pass'];

            $sql= "SELECT * FROM `user` WHERE email=? AND pass=?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss',$email,$pass);
            $stmt->execute();
            $result = $stmt->fetch();
            if($result){
                header("location: ../pages/index2.html");
                exit();
            } else {
                
                $_SESSION['error'] = "Wrong credentials";
                ?>
                    <script>
                        window.history.back();
                    </script>
                <?php
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