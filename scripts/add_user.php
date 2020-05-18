<?php 
    session_start();
    $_SESSION['error']=0;
    if (
        !empty($_POST['name'] ) 
    &&  !empty($_POST['surname'] ) 
    &&  !empty($_POST['email1'] ) 
    &&  !empty($_POST['email2'] ) 
    &&  !empty($_POST['pass1'] ) 
    &&  !empty($_POST['pass2'] )
    &&  !empty($_POST['birthday'] ) 
        )  
      {
        $error = 0;
        if (!isset($_POST['terms'])) {
            $_SESSION['error'] = 'Zaznacz pole z akceptacją regulaminu.';
            ?>
                <script>
                    window.history.back(); 
                </script>
            <?php
        }

        if($_POST['email1'] != $_POST['email2']) {
            $_SESSION['error'] = 'Adresy email są różne!';
            ?>
                <script>
                    window.history.back(); 
                </script>
            <?php
        }

        if($_POST['pass1'] != $_POST['pass2']) {
            $_SESSION['error'] = 'Hasła są różne!';
            ?>
                <script>
                    window.history.back(); 
                </script>
            <?php
        }
        require_once '../scripts/connect.php';
    } else {
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        ?>
        <script>
            window.history.back(); 
        </script>

        <?php
    }
    
?>