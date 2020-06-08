<?php
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
  <link href="./static/css/pageStyle.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo 'EVENTANO' ?></a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./events.php">Events</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#categories">Categories</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./#contact">Contact</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./login.php">Login</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="./register.php">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <h1 class="masthead-heading text-uppercase mb-0">REGISTER</h1>
      <!-- Icon Divider-->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
      </div>
      <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="col-md1">
                          <div class="card">
                            <div class="text-center card-header card-text text-secondary">
                            ' . $_SESSION['error'] . '
                            </div>
                          </div>
                        </div>
                        ';
        unset($_SESSION['error']);
      }
      ?>
      <form enctype="multipart/form-data" action="./scripts/add_user.php" method="post" class="col-md-12 col-lg-12 mb-5 row text-center">
        <div class="col-lg-6">
          <div class="form-group form-group-lg">
            <label for="inputEmail">Email address</label>
            <input name="email" type="email" class="form-control-lg form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group form-group-lg">
            <label for="inputName">Name</label>
            <input name="name" type="text" class="form-control-lg form-control" id="inputName" placeholder="Enter name">
          </div>
          <div class="form-group form-group-lg">
            <label for="inputSurname">Surname</label>
            <input name="surname" type="text" class="form-control-lg form-control" id="inputSurname" placeholder="Enter surname">
          </div>
          <div class="form-group form-group-lg">
            <label for="inputCity">City</label>
            <select name="city" type="text" class="form-control-lg form-control" id="inputCity" placeholder="City">
              <option selected disabled>City</option>
              <?php
              require_once('./scripts/connect.php');
              $zapytanie = "SELECT * FROM `city`";
              $wpisz = $conn->query($zapytanie);
              while ($rekord = $wpisz->fetch_assoc()) {
                echo <<<CITY
                                        <option value={$rekord['id']}>{$rekord['city']}</option>
                        CITY;
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input name="pass" type="password" class="form-control-lg form-control" id="inputPassword" aria-describedby="passwordHelp" placeholder="Enter safe password">
          </div>
          <div class="form-group">
            <label for="inputPassword2">Repeat password</label>
            <input name="pass2" type="password" class="form-control-lg form-control" id="inputPassword2" aria-describedby="passwordHelp" placeholder="Repeat password">
          </div>
          <div class="form-group">
            <label for="inputDate">Birthday date</label>
            <input name="birthday" type="date" class="form-control-lg form-control" id="inputDate" aria-describedby="dateHelp" placeholder="Enter birthday date">
          </div>
          <label for="inputPhoto">Select profile photo </label><br />
          <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
          <input name="photo" accept="image/*" style="background-color:transparent;border:none; border-bottom:1px solid #ccc; color:white" class="form-control-lg form-control" id="inputPhoto" type="file" />
        
          </div>
          <button type="submit" class="form-control-lg form-control btn btn-dark  btn-lg">Register</button>


    </div>
    </form>
    </div>
  </header>
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