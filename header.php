<?php
if (!isset($_SESSION)){
    session_start();
}
?>
<header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
            <?php
            if (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "CUSTOMER") {
                echo '<h1 class="text-light"><a href="home_customer.php"><span>Foodshala</span></a></h1>';
            }
            elseif (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "RESTAURANT") {
                echo '<h1 class="text-light"><a href="home_restaurant.php"><span>Foodshala</span></a></h1>';
            }
            else {
                echo '<h1 class="text-light"><a href="index.php"><span>Foodshala</span></a></h1>';
            }
            ?>
<!--            <h1 class="text-light"><a href="inner-page.php"><span>Delicious</span></a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <?php
                if (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "CUSTOMER") {
                    echo '<li class="active"><a>Welcome '.$_SESSION['userInfo']['first_name'].'</a></li>';
                    echo '<li class="active"><a href="home_customer.php">Home</a></li>';
                }
                elseif (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "RESTAURANT") {
                    echo '<li class="active"><a>Welcome '.$_SESSION['userInfo']['first_name'].'</a></li>';
                    echo '<li class="active"><a href="home_restaurant.php">Home</a></li>';
                }
                else {
                    echo '<li class="active"><a href="index.php">Home</a></li>';
                }
                ?>
<!--                <li class="active"><a href="inner-page.php">Home</a></li>-->
                <!-- <li><a href="#about">About</a></li> -->
                <li><a href="view_menu.php">Menu</a></li>
                <?php
                    if (isset($_SESSION['userInfo'])) {
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                    else {
                        echo '<li><a href="login.php">Login</a></li>';
                    }
                ?>
                <?php
                if (!isset($_SESSION['userInfo'])) {
                    echo '<li><a href="registration_customer.php">Customer Registration</a></li>';
                    echo '<li><a href="registration_restaurant.php">Restaurant Registration</a></li>';
                }
                ?>
<!--                <li><a href="registration_customer.php">Customer Registration</a></li>-->
<!--                <li><a href="registration_restaurant">Restaurant Registration</a></li>-->
                <!-- <li><a href="#gallery">Gallery</a></li> -->


                <!-- <li class="book-a-table text-center"><a href="#book-a-table">Book a table</a></li> -->
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header>