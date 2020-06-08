<?php
session_start();

if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    require_once('./connect.php');
    if ($conn->connect_errno != 0) {
        $_SESSION['error'] = "Błędne połączenie z bazą danych";
        header("location: ../");
        exit();
    }

    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
    $pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");

    $sql = sprintf("SELECT * FROM `users` WHERE email='%s'", mysqli_real_escape_string($conn, $email));
    if ($res = $conn->query($sql)) {
        // $pass = password_hash($pass2,PASSWORD_ARGON2ID); //argon nie dziala
        if (!$res->num_rows) {
            $_SESSION['error'] = "Niepoprawny email lub hasło";
            header("location: ../login.php");
            exit();
        }
        $row = $res->fetch_assoc();
        if ($row['password'] != $pass) {
            $_SESSION['error'] = "Niepoprawny email lub hasło";
            header("location: ../login.php");
            exit();
        }

        $_SESSION['logged']['user_id'] = $row['id'];
        $_SESSION['logged']['name'] = $row['name'];
        $_SESSION['logged']['surname'] = $row['surname'];
        $_SESSION['logged']['email'] = $row['email'];
        $_SESSION['logged']['photo_path'] = $row['photo_path'];
        $conn->query("UPDATE user SET last_logged = CURRENT_TIMESTAMP() WHERE email='" . $row['email'] . "'");
        $conn->close();


        header('location:../');
    }
} else {
    $_SESSION['error'] = "Wypełnij wszystkie pola";
    header("location: ../");
    exit();
}
