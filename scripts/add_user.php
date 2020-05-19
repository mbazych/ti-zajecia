<?php
    session_start();
    if(!empty($_POST['name']) &&  !empty($_POST['surname']) && !empty($_POST['email1']) && !empty($_POST['email2']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['birthday'])){

        if(!isset($_POST['terms'])){
            $_SESSION['error'] = "Zaznacz pole z regulaminem";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        
        }

        if($_POST['pass1']!=$_POST['pass2']){
            $_SESSION['error'] = "Hasła są rózne";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        }
        if($_POST['email1']!=$_POST['email2']){
            $_SESSION['error'] = "Emaile są rózne";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        }

        require_once './connect.php';
    }else{
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
?>