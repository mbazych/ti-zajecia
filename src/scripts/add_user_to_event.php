<?
    session_start();

    if(isset($_SESSION['logged']['email'])){
        require_once './connect.php';
        if(isset($_GET['viewer'])){
            $sql = sprintf("DELETE FROM `users_events` WHERE `user_id`=? AND `event_id`=?");
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii',$_SESSION['logged']['user_id'], $_GET['event_id']);
            $_SESSION['info'] = "Successfully deleted from event";
            $i=$stmt->execute();
        }else{
            $sql = sprintf("INSERT INTO `users_events`(`user_id`,`event_id`) VALUES (?,?)");
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii',$_SESSION['logged']['user_id'], $_GET['event_id']);
            $_SESSION['info'] = "Successfully added to event";
            $i = $stmt->execute();
        }
        if($i){
            header("location: ../pages/event_details.php?id={$_GET['event_id']}");   
        }else{
            unset($_SESSION['info']);
            $_SESSION['error']="Something went wrong... Try later";
        }
    }else{
        header('location: ../login.php');
    }
    
    exit();
    
?>