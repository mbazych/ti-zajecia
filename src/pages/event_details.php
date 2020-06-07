<?php
session_start();
if(!isset($_GET['id'])){
    header('location: ../');
    exit();
}
$id = $_GET['id'];
require_once '../scripts/connect.php';
$response = $conn->query("SELECT events.*, city.*, categories.*,users.name as `host_name`,users.surname as `host_surname`, users.email 
                            FROM events, categories, city, users
                            WHERE events.city_id = city.id
                                AND events.categorie_id = categories.id
                                AND events.host_id = users.id
                                AND events.id = " . $id);
if($response->num_rows ==0){
    $_SESSION['error']="This event is expired or has never existed";
    header('location: ../');
    exit();
}
$item = $response->fetch_assoc();
$response2 = $conn->query("SELECT users.*, users_events.*
                            FROM users_events, events, users 
                            WHERE users_events.user_id = users.id
                                AND users_events.event_id = events.id
                                AND users_events.event_id = " . $id);
$response3 = $conn->query("SELECT tags.*
                            FROM events_tags, events, tags 
                            WHERE events_tags.tag_id = tags.id
                                AND events_tags.event_id = events.id
                                AND events_tags.event_id = " . $id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EVENTANO</title>
    <!-- Favicon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="icon" type="image/x-icon" href="./static/assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../static/css/styles.css" rel="stylesheet" />
</head>
<style>
    .event_photo {
        position: relative;
        top: -130px;
        border-radius: 10px;
        z-index: 2;
        background-color: transparent;
    }


    .photo {
        width: 100%;
        height: 100%;
        box-shadow: 0px 21px 68px -11px rgba(0, 0, 0, 0.75);
        border-radius: 10px;
    }

    .masthead {
        position: relative;
        z-index: 1;
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    .info {

        position: relative;
        top: -110px;
        z-index: 0;
        margin-left: 25px;
        margin-right: 25px;
        padding-top: 30px;
        background-color: #2c3e50;
        border-radius: 10px;
        max-height: 350px;
    }

    .share-btn {
        border: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
        font-weight: lighter;
        position: relative;
        border: 1px solid white;
        color: white;
        top: 30px
    }

    .takepart-btn {
        border: 10px solid white;
        border: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;
        font-weight: lighter;
        position: relative;
        color: white;
        z-index: 5;
        top: 15px;
        box-shadow: 0px 21px 58px -11px rgba(0, 0, 0, 0.75);
        width: 100%;
        background-color: #1abc9c;
    }

    .participants {
        margin: 0px 10px;
        border-bottom:1px solid #ccc;
    }

    .participant {
        margin: 20px;
    }


    .person-img-circle img {
        border-radius: 25px;
        margin: 10px 0;
        height: 50px;
        width: 50px;
    }

    .tag {
        border: 1px solid gray;
        margin: 10px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .space {
        margin-top: 10%;
    }
</style>
<script>
    function shareClick() {
        if (confirm("Copy url to clickboard?")) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = window.location.href;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            alert("Copied!");
        }
    }
</script>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="../#page-top">EVENTANO</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#portfolio">Events</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#about">About</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#contact">Contact</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../login.php">Login</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="row">
            <div class="col-lg-6 ml-auto">
                <h1 class="masthead-subhead">
                    <?echo  $item['name'] ?>
                </h1>
            </div>
            <div class="col-lg-6 ml-auto">
                <h3 class="masthead-subhead ">
                    <i class="fa fa-map-pin" aria-hidden="true" style="color:#d55"></i>
                    <?echo $item['city'] ?>,
                    ul.
                    <?echo $item['address'] ?><br />

                    <button class="btn btn-default btn-sm share-btn" onclick="shareClick()">
                        <i class="fa fa-share"></i> Share</button>
                </h3>
            </div>
        </div>
    </header>
    <!-- General-->
    <section class="page-section">
        <div class="container">
            <div class="row">
                <div class="event_photo col-md-12 col-lg-8 mb-12">
                    <? echo '<img class="photo" src="../static/img/'.$item['photo_path'].'" alt="'.$item['photo_patht'].'"/>'?>
                </div>
                <div class="col-md-11 col-lg-3 mb-12 info text-white" style="text-align: center;">
                    <div style="text-align: right;">
                        <div class="lead">
                            Scheduled on:<br />
                        </div>
                        <?echo date("g:i a", strtotime($item['date']))?><br />
                        <?echo date("l, F j, Y", strtotime($item['date']))?>
                    </div>
                    <hr style="border-color:white" />
                    <div style="text-align: right;">
                        <div class="lead">
                            Host:<br />
                        </div>
                        <?echo $item['host_name'].' '.$item['host_surname']?><br />
                        <?echo "<a href='mailto:".$item['email']."'>Contact via mail</a>"?>

                    </div>
                    <hr style="border-color:white" />
                    <form action="../scripts/add_user_to_event.php">
                        <button class="btn-default btn-sm btn takepart-btn">
                            Take part
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-lg-7 mb-12">
                    <h2 class="page-section-heading text-center text-secondary mb-0">Description</h2><br />
                    <p class="lead mb-0" style="text-align: justify;">
                        <?echo $item['description'] ?>
                    </p>
                </div>
                <div class="col-md-11 col-lg-5 mb-12">
                    <h3 class="masthead-subhead text-center mb-0">Participants</h3>
                    <hr style="border-color:black" />
                    <?
                        while($person = $response2->fetch_assoc()){
                            echo "<div class='participants row'>
                                    <div class='person-img-circle'>
                                        <img src='../static/img/".$person['photo_path']."' alt='".$person['photo_path']."' class='img-size-50'/>
                                </div>
                                    <div class='participant'>"
                                        .$person['name']." ".$person['surname'].
                                    "</div>
                                </div>";
                        }
                    ?>
                </div>
            </div>

            <div class="space ">
                <p>Tags:</p>
                <div class="row">
                    <?
                        while($tag = $response3->fetch_assoc()){
                            echo "<div class='col-md-11 col-lg-2 mb-12 tag'>".$tag['tag']."</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">

                <!-- Footer Social Icons-->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Around the Web</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-6">
                    <h4 class="text-uppercase mb-4">About EVENTANO</h4>
                    <p class="lead mb-0">EVENTANO is a place where you can find all the events you need for you to enjoy or learn from.</p>
                    <p>Website created by <a href="https://www.linkedin.com/in/mbazych/">Michał Bazych</a> and <a href="https://www.linkedin.com/in/mateusz-czarczy%C5%84ski-1263a5173/">Mateusz Czarczyński</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright © EVENTANO.com 2020</small></div>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <script src="./static/assets/mail/jqBootstrapValidation.js"></script>
    <script src="./static/assets/mail/contact_me.js"></script>
    <!-- Core theme JS-->
    <script src="static/js/scripts.js"></script>
</body>

</html>