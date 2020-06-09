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
    <? require_once './layouts/head.html'?>
</head>

<body id="page-top">
    <!-- Navigation-->
    <?require_once './layouts/navbar.php'?>

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

        <div class="container col-lg-12 d-flex justify-content-center" style="margin:3% 0%; padding:0 10%;">
            <!-- <div class=" "> -->
            <form action="./events.php" method="GET" id="searchForm" class="input-group">

                <?php
                require_once("../scripts/connect.php");
                $result = $conn->query("SELECT id,categorie FROM categories ORDER BY ID DESC");
                ?>
                <select name="category" id="category" style="border:1px solid #2c3e50;" class="col-md-11 col-lg-2 mb-12 btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <option value="">Select category</option>
                    <<?php
                        while ($row = $result->fetch_assoc()) {
                            echo <<<Category
                                        <option value={$row['id']}>{$row['categorie']}</option>
Category;
                        }
                        ?> </select> <?php
                                                    $result = $conn->query("SELECT id,city FROM city ORDER BY ID DESC");
                                                    ?> <select name="city" id="city" style="border:1px solid #2c3e50;margin-left:10px" class="col-md-11 col-lg-2 mb-12 btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <option value="">Select city</option>
                        <<?php
                            while ($row = $result->fetch_assoc()) {
                                echo <<<City
                                        <option value={$row['id']}>{$row['city']}</option>
City;
                            }
                            ?> </select>
                </select>


                <input type="text" class="col-md-11 col-lg-5 mb-12" name="search" style="border-radius:7px;border:1px solid #2c3e50;margin-left:10px" placeholder="Search events...">
                <button class="col-md-11 col-lg-2 mb-12 glyphicon glyphicon-search btn-default btn takepart-btn" style="color:#2c3e50;margin-left:10px" type="submit">
                    Submit
                </button>
            </form><!-- end form -->
            <!-- </div>end col-xs-8        -->
        </div><!-- end row -->


        <div class="container col-lg-6 d-flex" style="margin:3% 0%; padding:0 10%;">
            Filters:
            <?

                            if ($_GET['category'] != NULL && !empty($_GET['category'])){
                                $res=$conn->query("SELECT * FROM categories WHERE id=".$_GET['category']);
                                echo "<div class='p-2' style='margin:0px 0px 0px 10px;box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 1);  border-radius:8px'>category: <b>".$res->fetch_assoc()['categorie']."</b></div>";
                            }
                            if ($_GET['city'] != NULL && !empty($_GET['city'])){
                                $res=$conn->query("SELECT * FROM city WHERE id=".$_GET['city']);
                                echo "<div class='p-2' style='margin:0px 10px;box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 1);  border-radius:8px'>city: <b>".$res->fetch_assoc()['city']."</b></div>";
                            }
                            if ($_GET['search'] != NULL && !empty($_GET['search'])){
                                echo "<div class='p-2' style='margin:0px 10px;box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 1);  border-radius:8px'> quote: <b>".$_GET['search']."</b></div>";
                            }
                            ?>
        </div>
    </section>
    <section>
        <?php
        $sql = "SELECT `id`,`name`,photo_path,`date`,CONCAT(SUBSTRING(`description`,1,50),'...') as `description`
            FROM events WHERE (`name` LIKE '%" . $_GET['search'] . "%'OR `description` LIKE '%" . $_GET['search'] . "%') ";
        if ($_GET['category'] != NULL && !empty($_GET['category'])) $sql .= " AND `categorie_id` = " . $_GET['category'];
        if ($_GET['city'] != NULL && !empty($_GET['city'])) $sql .= " AND `city_id` = " . $_GET['city'];

        $result = $conn->query($sql);
        ?>
        <div class="container">
            <div class="row col-12 col-sm-12 mb-12 col-md-12 col-lg-12 text-center justify-content-center d-flex">
                <!-- <div class=" col-sm"> -->
                <?php
                if ($result->num_rows == 0)
                    echo "<div class='col-lg-12' style='margin:20% 0; color:red'><h1> No Results <h1></div>";

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col col-12 mb-12 xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3' style='margin-bottom:2%'>
                        <a href='./event_details.php?id=" . $row['id'] . "' style='text-decoration:none; color:#2c3e50;'>
                                        <div class='card'>
                                            <div class='card-header' style='padding:0'>
                                                <img class='card-img-top' style='height:150px; object-fit:cover' src='../static/img/{$row['photo_path']}'>
                                                
                                                </div>    
                                                <div class='card-body' style='height:150px'>
                                                        <h5 class='card-title'> 
                                                            {$row['name']}
                                                        </h5>
                                                        <p class='card-text'>
                                                            {$row['description']}
                                                        </p>
                                            </div><div class='card-body' style='color:gray;'>
                                            " . date('g:i a', strtotime($row['date'])) . "
                                            <br />
                                            " . date('F j, Y', strtotime($row['date'])) . "
                                            </div>
                                        </div>
                                        </a>
                                     </div>";
                }
                ?>
                <!-- </div> -->
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