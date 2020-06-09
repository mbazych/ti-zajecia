<?php
session_start();
if (!isset($_SESSION['logged']['email'])) {
    header('location: ../');
    exit();
}
require_once '../scripts/connect.php';
$sql = "SELECT * FROM city, users,`state` WHERE city.state_id = `state`.id AND users.city_id = city.id AND users.id =" . $_SESSION['logged']['user_id'];
$response = $conn->query($sql);
$person = $response->fetch_assoc();
$sql = "SELECT events.*, users_events.*
    FROM users_events, events, users 
    WHERE users_events.user_id = users.id
        AND users_events.event_id = events.id
        AND users_events.user_id = " . $_SESSION['logged']['user_id'] . " ORDER BY date";
$response2 = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile</title>
    <!-- Favicon-->
<? require_once './layouts/head.html'?>
</head>

<body id="page-top">
    <!-- Navigation-->
    <?
    if (isset($_SESSION['error'])) {
        echo '<div class="col-md4">
                            <div class="card">
                              <div class="text-center card-header card-text text-secondary">
                              ' . $_SESSION['error'] . '
                              </div>
                            </div>
                          </div>
                          ';
        unset($_SESSION['error']);
        exit();
    }
    if (isset($_SESSION['info'])) {
        echo '<div class="col-md4">
                            <div class="card">
                              <div class="text-center card-header card-text text-secondary">
                              ' . $_SESSION['info'] . '
                              </div>
                            </div>
                          </div>
                          ';
        unset($_SESSION['info']);
    }
    require_once './layouts/navbar.php';
    ?>


    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">

        <div class="d-flex justify-content-center">

            <div class="col-lg-12">
                <h1 class="masthead-subhead">
                    Hello,
                    <?echo  $person['name'] ?>
                </h1>
            </div>
        </div>
    </header>
    <!-- General-->
    <section class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-11 ml-auto col-lg-3 mb-12 info text-white" style="text-align: center; max-height:700px; height:450px;">
                    <div class="row" style="text-align: left;">
                        <div class="col-md-11 col-lg-11 mb-12 text-center">
                            <?echo "<img style='text-align:center; height:200px; width:200px; object-fit:cover; border-radius:10px' src='../static/img/{$person['photo_path']}'/>" ?>
                            <div style="text-align:left;"><br />
                                <div class="lead">
                                    Your place:<br />
                                </div>
                                <?echo "&nbsp&nbsp&nbsp".$person['state'].", " ?><br />
                                <?echo "&nbsp&nbsp&nbsp".$person['city']?>
                                <hr style="border-color:white" />
                                <div class="lead">
                                    Your email:<br />
                                </div>
                                <?echo "&nbsp&nbsp&nbsp<a href='mailto:".$person['email']."'>".$person['email']."</a>"?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-11 ml-auto col-lg-6 mb-12">
                    <h3 class="masthead-subhead text-center mb-0">Your nearest events</h3>
                    <hr style="border-color:black" />
                    <?
                        while($event = $response2->fetch_assoc()){
                            echo "<div class='participants d-flex'>
                                    <div class='person-img-circle p-2'>
                                        <img src='../static/img/".$event['photo_path']."' alt='".$event['photo_path']."'/>
                                    </div>
                                    <div class='participant p-2'> "
                                    .$event['name']."
                                    </div>
                                        <div class='you p-2 ml-auto' style='font-size:15px;'>"
                                            .date("g:i a", strtotime($event['date']))."<br />"
                                            .date("l,", strtotime($event['date']))."<br />"
                                            .date("F j, Y", strtotime($event['date'])).
                                        "</div>
                                </div>";
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