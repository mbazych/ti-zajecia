<?php
session_start();
if (!empty($_POST['name']) && !empty($_POST['city']) && !empty($_POST['address']) && !empty($_POST['categorie']) && !empty($_POST['date']) && !empty($_POST['description'])) {
    require_once './connect.php';

    if ($_POST['date'] <= date("Y-m-d H:i")) {
        $_SESSION['error'] = "Event date must be in the future";
?>
        <script>
            window.history.back();
        </script>
    <?php
        exit();
    }


    if ($conn->connect_errno) {
        $_SESSION['error'] = "Connection error";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit();
    }

    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $categorie = $_POST['categorie'];
    $date = date("Y-m-d H:m:s", strtotime($_POST['date']));
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $host_id = $_SESSION['logged']['user_id'];
    $photo = $_POST['photo'];
    $uploaddir = '../static/img/';
    $photo = $uploaddir . basename($_FILES['photo']['name']);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
        
        $sql = "INSERT INTO `events` (`name`, `description`, `city_id`, `address`, `date`, `categorie_id`, `photo_path`, `host_id`)
            VALUES ('".$name."', '".$description."', ".$city.", '".$address."', '".$date."', ".$categorie.", '".$_FILES['photo']['name']."', ".$host_id.")";
        $conn->query($sql);

        $event_id = $conn->insert_id;

        $sql="INSERT INTO `users_events` (`user_id`,event_id) VALUES (".$host_id.",".$event_id.")";
        $conn->query($sql);

        foreach ($tags as $tag ){
               $conn->query("INSERT INTO `events_tags`(`event_id`, `tag_id`) VALUES(".$event_id.", ".$tag.")");
        }

        header("location: ../pages/event_details.php?id={$event_id}");
    } else {
        $_SESSION['error'] = "Error while saving the file";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit();
    }
} else {
    $_SESSION['error'] = "Wypełnij wszystkie pola";
    ?>
    <script>
        window.history.back();
    </script>
<?php
}
?>