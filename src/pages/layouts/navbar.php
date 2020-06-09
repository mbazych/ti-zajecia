<nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
        <div class="container">

            <a class="navbar-brand js-scroll-trigger" href="../index.php">
                EVENTANO
            </a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?
                    if(isset($_SESSION['logged']['email'])){
                    ?>
                    <li class="nav-item mx-0 mx-lg-1"><a style="padding:0px !important;" class="nav-link py-3 px-0 px-lg-3 rounded" href="./profile_page.php"><i style="font-size:3.5rem;" class="fa fa-user-circle" aria-hidden="true"></i></a></li>
                    <?
                    }
                    ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./events.php">Events</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#categories">Categories</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../#contact">Contact</a></li>
                    <?if(!isset($_SESSION['logged']['email'])){?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./login.php">Login</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="./register.php">Register</a></li>
                    <?}else{?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="border: 1px solid white" href="./new_event.php">New event</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color:#1abc9c" href="../scripts/logout.php">Log out</a></li>

                    <?}?>
                </ul>
            </div>
        </div>
    </nav>