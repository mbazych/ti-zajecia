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
    $date = $_POST['date'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $host_id = $_SESSION['logged']['user_id'];
    $photo = $_POST['photo'];
    $uploaddir = '../static/img/';
    $photo = $uploaddir . basename($_FILES['photo']['name']);
    $photo2 = $uploaddir . basename($_FILES['photo']['name']);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo2)) {

        $sql = "INSERT INTO `events` (`name`, `description`, `city_id`, `address`, `date`, `categorie_id`, `photo_path`, `host_id`)
            VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssissisi', $name, $description, $city, $address, $date, $categorie, $_FILE['photo']['name'], $host_id);
        $i = $stmt->execute();
        if($i){
            echo $conn->insert_id;
        }
        else
            echo $conn->errno;

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