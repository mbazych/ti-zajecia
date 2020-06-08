<?php
session_start();
if (!isset($_SESSION['logged']['email'])) {
  header('location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>EVENTANO</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../static/js/docsupport/prism.css">
  <link rel="stylesheet" href="../static/js/chosen.css">
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="./static/assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../static/css/styles.css" rel="stylesheet" />
  <link href="../static/css/pageStyle.css" rel="stylesheet" />
  <script type="text/javascript">
    $(function() {
      document.getElementById('textarea').onkeyup = function() {
        document.getElementById('count').innerHTML = "Characters left: " + (500 - this.value.length);
      }
    });

    $(function() {
      $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
      });

    });
  </script>
</head>

<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="./#page-top">EVENTANO</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../events.php">Events</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#categories">Categories</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#contact">Contact</a></li>
          <?if(!isset($_SESSION['logged']['email'])){?>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="../login.php">Login</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="../register.php">Register</a></li>
          <?}else{?>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./new_event.php">New event</a></li>
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="../scripts/logout.php">Log out</a></li>

          <?}?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <h1 class="masthead-heading text-uppercase mb-0">New Event</h1>
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
      <form enctype="multipart/form-data" id="form" action="../scripts/add_event.php" class="col-md-12 col-lg-12 mb-5 row text-center" method="post">
        <div class="col-lg-6">
          <div class="form-group form-group-lg">
            <label for="inputName">Name</label>
            <input name="name" type="text" class="form-control-lg form-control" id="inputName" placeholder="Enter name">
          </div>
          <div class="form-group form-group-lg">
            <label for="inputCity">City</label>
            <select name="city" type="text" class="form-control-lg form-control" id="inputCity" placeholder="City">
              <option selected disabled>City</option>
              <?php
              require_once('../scripts/connect.php');
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
          <div class="form-group form-group-lg">
            <label for="inputAddress">Address</label>
            <input name="address" type="text" class="form-control-lg form-control" id="inputAddress" placeholder="Enter address">
          </div>
          <div class="form-group form-group-lg">
            <label for="inputcategorie">Category</label>
            <select name="categorie" type="text" class="form-control-lg form-control" id="inputCategorie" placeholder="Categorie">
              <option selected disabled>Category</option>
              <?php
              $zapytanie = "SELECT * FROM `categories`";
              $wpisz = $conn->query($zapytanie);
              while ($rekord = $wpisz->fetch_assoc()) {
                echo <<<CATEGORIE
                                        <option value={$rekord['id']}>{$rekord['categorie']}</option>
                                  CATEGORIE;
              }
              ?>
            </select>

          </div>
          <div class="form-group">
            <label for="inputDate">Event date</label>
            <input name="date" type="datetime-local" class="form-control-lg form-control" id="inputDate" aria-describedby="dateHelp" placeholder="Enter Event Date">
          </div>
        </div>
        <div class="col-lg-6">
          <label for="textarea">Description</label>

          <textarea name="description" style="resize:none" id="textarea" form="form" rows="6" placeholder="description" maxlength="500" class="form-control-lg form-control"></textarea>
          <div id="count" style="text-align: right; padding-right:10px;">Characters left: 500</div>



          <label for="inputTags">Tags</label>
          <select placeholder="Tags" multiple name="tags[]" class="chosen-select form-control-lg form-control" id="inputTags">
            <?php
            $zapytanie = "SELECT * FROM `tags`";
            $wpisz = $conn->query($zapytanie);
            while ($rekord = $wpisz->fetch_assoc()) {
              echo <<<CATEGORIE
                   <option value={$rekord['id']}>{$rekord['tag']}</option>
            CATEGORIE;
            }
            ?>
          </select>
          <br />
          <br />


          <label for="inputPhoto">Select event photo </label><br />
          <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
          <input name="photo" accept="image/*" style="background-color:transparent;border:none; border-bottom:1px solid #ccc; color:white" class="form-control-lg form-control" id="inputPhoto" type="file" />
        </div>
        <button type="submit" class="btn btn-dark col-lg-6 btn-lg" style="margin-left:25%; margin-right:25%; margin-top:10px">Create this event</button>


        </div>
        <script src="../static/js/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../static/js/chosen.jquery.js" type="text/javascript"></script>
        <script src="../static/js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
        <script src="../static/js/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
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