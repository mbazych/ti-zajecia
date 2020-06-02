<?php
    session_start();
    if(!empty($_POST['name'])
    && !empty($_POST['surname'])
    && !empty($_POST['email1'])
    && !empty($_POST['email2']) 
    && !empty($_POST['pass1']) 
    && !empty($_POST['pass2']) 
    && !empty($_POST['birthday'])){

<<<<<<< HEAD
<<<<<<< HEAD
        if(!isset($_POST['terms'])){
            $_SESSION['error'] = "Zaznacz pole z regulaminem";
            ?>
            <script>
                window.history.back();
            </script>
            <?
        
        }
=======

>>>>>>> parent of 0ecd87e... revert

<<<<<<< HEAD
<<<<<<< HEAD
        if($_POST['email']!=$_POST['email2']){
            $_SESSION['error'] = "Emaile są rózne";
=======
        if(!isset($_POST['terms'])){
            $_SESSION['error'] = "Please agree to the terms";
>>>>>>> parent of 89ad1d4... test
=======
        if($_POST['pass1']!=$_POST['pass2']){
            $_SESSION['error'] = "Hasła są rózne";
>>>>>>> parent of ff4fc25... changes
            ?>
            <script>
                window.history.back();
            </script>
            <?
        
        }
<<<<<<< HEAD
=======

>>>>>>> parent of 0ecd87e... revert

<<<<<<< HEAD
        if($_POST['pass']!=$_POST['pass2']){
            $_SESSION['error'] = "Hasła są rózne";
=======
        if($_POST['email']!=$_POST['email2']){
            $_SESSION['error'] = "Provided emails are different from each other";
>>>>>>> parent of 89ad1d4... test
=======
        if($_POST['email1']!=$_POST['email2']){
            $_SESSION['error'] = "Emaile są rózne";
>>>>>>> parent of ff4fc25... changes
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
    }else{
        $_SESSION['error'] = "Wypełnij wszystkie pola!";
        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
?>