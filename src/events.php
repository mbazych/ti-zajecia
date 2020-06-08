<?
    session_start();
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
    <link rel="icon" type="image/x-icon" href="./static/assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="static/css/styles.css" rel="stylesheet" />
    <link href="static/css/pageStyle.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
        <div class="container">

            <a class="navbar-brand js-scroll-trigger" href="./#page-top">EVENTANO</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./events.php">Events</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./#about">About</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./#contact">Contact</a></li>
                    <?if(!isset($_SESSION['logged']['email'])){?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./login.php">Login</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="./register.php">Register</a></li>
                    <?}else{?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./pages/new_event.php">New event</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="./scripts/logout.php">Log out</a></li>

                    <?}?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <h1 class="masthead-heading text-uppercase mb-0">EVENTANO</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Your desired events in one place.</p>
        </div>
    </header>
    <section>
        <div class="container d-flex align-items-center flex-column">
            <div class="col-lg-9 col-lg-push-1 mt-5 mb-5 text-center">

                <div class="container d-flex col-lg-12 align-items-center flex-row">
                    <div class="row">
                        <!-- <div class=" "> -->
                        <form action="./scripts/search.php" method="get" id="searchForm" class="input-group">

                            <?php
                            require_once("./scripts/connect.php");
                            $result = $conn->query("SELECT id,categorie FROM categories ORDER BY id DESC");
                            ?>
                            <select name="category" id="category" class="col-md-11 col-lg-3 mb-12 btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <option value="Select category">Select category</option>
                                <<?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo <<<Category
                                        <option value={$row['id']}>{$row['categorie']}</option>
Category;
                                    }
                                    ?> </select> <?php
                                                    require_once("./scripts/connect.php");
                                                    $result = $conn->query("SELECT id,city FROM city ORDER BY ID DESC");
                                                    ?> <select name="city" id="city" style="margin-left:10px" class="col-md-11 col-lg-3 mb-12 btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <option value="Select city">Select city</option>
                                    <<?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo <<<City
                                        <option value={$row['id']}>{$row['city']}</option>
City;
                                        }
                                        ?> </select> <input type="text" class="col-md-11 col-lg-3 mb-12 btn" name="x" style="border:1px solid #2c3e50;margin-left:10px" placeholder="Search events...">
                                        <button class="col-md-11 col-lg-2 mb-12 glyphicon glyphicon-search btn-default btn takepart-btn" style="color:#2c3e50;margin-left:10px" type="submit">
                                            Submit
                                        </button>
                        </form><!-- end form -->
                        <!-- </div>end col-xs-8        -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end col-md-9 -->
        </div>
    </section>
    <section>


        <!-- <div class="container d-flex align-items-center flex-column">
                <div class="col-lg-9 col-lg-push-1 mt-5 mb-5">
                    
                    <div class="container d-flex align-items-center flex-row">
                        <div class="row">
                            <div class=" col-xl-3">
                            <?php
                            //     require_once("./scripts/connect.php");
                            //     $result = $conn->query("SELECT id,name,description FROM events ORDER BY ID DESC");

                            // while ($row = $result->fetch_assoc()) {
                            //     echo "<div class='card'><div class='card-header'> {$row['name']}<div class='card-body'>{$row['description']} </div> </div></div>";
                            // }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
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