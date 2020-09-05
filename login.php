<?php
if (!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "CUSTOMER") {
    header("Location: home_customer.php");
}
elseif (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "RESTAURANT") {
    header("Location: home_restaurant.php");
}
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
<!--    <link href="assets/img/favicon.png" rel="icon">-->
<!--    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Delicious - v2.1.0
    * Template URL: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Top Bar ======= -->
<?php include "top_bar.php" ?>

<!-- ======= Header ======= -->
<?php include "header.php" ?>
<!-- End Header -->

<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section>

    </section>
    <!-- End Breadcrumbs Section -->

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
        <div class="container">

            <div class="section-title">
                <h2><span>Login</span></h2>
            </div>

            <form name="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="php-email-form" >
                <div class="form-row">
                    <div class="col-lg-6 col-md-6 form-group">
                        <input class="form-control" type="text" name="mobile_number"  placeholder="Your Phone"
                               minlength="10" maxlength="10" required>
<!--                        <div class="validate"></div>-->
                    </div>
                    <div class="col-lg-6 col-md-6 form-group">
                        <input class="form-control" type="password" name="password"  placeholder="Password" required>
<!--                        <div class="validate"></div>-->
                    </div>
                </div>
                <?php
                if (isset($_POST['login'])) {
                    include "database_connection.php";
                    include "user_check.php";
                    $mobileNumber = $_POST['mobile_number'];
                    $password = md5($_POST['password']);
                    if (isValidLogin($mobileNumber, $password)) {
                        $sql = "SELECT * FROM users WHERE mobile_number='$mobileNumber' AND password='$password'";
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['userInfo'] = $row;
                        if ($row['user_type'] == "CUSTOMER"){
                            echo '<script>window.location="home_customer.php"</script>';
//            header("Location: home_customer.php");
                        }
                        else if ($row['user_type'] == "RESTAURANT") {
//                            header("Location: home_restaurant.php");
                            echo '<script>window.location="home_restaurant.php"</script>';
                        }
                    }
                    else {
                        ?>
                        <div class="mb-3">
                            Invalid User
                        </div>
                <?php
                    }
                }
                ?>


                <div class="text-center">
<!--                    <input type="submit" name="login" value="Login">-->
                    <button name="login" type="submit">Login</button>
                </div>
            </form>

        </div>
    </section>
    <!-- End Book A Table Section -->


</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<?php include "footer.php" ?>
<!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<!--<script src="assets/vendor/php-email-form/validate.js"></script>-->
<script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

<!-- Template Main JS File-->
<script src="assets/js/main.js"></script>

</body>

</html>
