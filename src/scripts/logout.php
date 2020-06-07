<?
    session_start();
    if(isset($_SESSION['logged']["email"])){
        session_destroy();
?>
        <script>
            window.history.back();
        </script>
<?
    }else{
        header('location: ../');
    }
?>