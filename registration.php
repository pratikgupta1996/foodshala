<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Registration</title>
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
    <section class="breadcrumbs">

    </section>
    <!-- End Breadcrumbs Section -->
    <section id="menu" class="menu">
        <div class="container">
            <?php
            include "database_connection.php";
            include "user_check.php";
            if (isset($_POST['restaurant_registration_submit']) || isset($_POST['customer_registration_submit'])) {
//                if (isset($_POST['email']) && empty($_POST['email'])){
//                    $email = NULL;
//                }
//                else {
                    $email = $_POST['email'];
//                }
                $mobileNumber = $_POST['mobile_number'];
                $password = md5($_POST['password']);
//                echo "$email $mobileNumber $password";
                if (isUserExists($email, $mobileNumber)) {
                    echo "user already exists";
                } else {
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $preferenceTypeId = "NULL";
                    if (isset($_POST['preference_type'])) {
                        $preferenceTypeId = $_POST['preference_type'];
                    }
                    $userType = $_POST['user_type'];
                    if (empty($email)){
                        $sql = "INSERT INTO users (first_name, last_name, mobile_number, password, user_type, preference_type_id)
                VALUES ('$firstName', '$lastName', '$mobileNumber', '$password', '$userType', $preferenceTypeId);";
                    }
                    else {
                        $sql = "INSERT INTO users (first_name, last_name, email, mobile_number, password, user_type, preference_type_id)
                VALUES ('$firstName', '$lastName', '$email', '$mobileNumber', '$password', '$userType', $preferenceTypeId);";
                    }

                    $insertUser = mysqli_query($con, $sql) or die(mysqli_error($con));
                    if ($insertUser) {
                        echo "Registered successfully";
                    } else {
                        echo "could not register";
                    }
                }
            } else {
                echo "Invalid request";
            }
            ?>
        </div>
    </section>


</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<?php include "footer.php" ?>
<!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>