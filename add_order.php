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

    <title>Add order</title>
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
    <section id="menu" class="menu">
        <div class="container">
        <?php
        include "user_check.php";
        include "database_connection.php";
        if (!isAuthorizedUser("CUSTOMER")) {
            echo "Please login to order the food<br>";
//            echo "<a href='login.php'>Login</a><br>";
//            echo "<a href='index.php'>Home</a>";
        }
        else{
            $customerId = $_SESSION['userInfo']['id'];
            $itemDetailsId = $_REQUEST['item_details_id'];
            $restaurantId = $_REQUEST['restaurant_id'];
            $preferenceTypeId = $_REQUEST['preference_type_id'];
            $sql = "INSERT INTO order_details (customer_id, restaurant_id, item_details_id)
            VALUES ($customerId, $restaurantId, $itemDetailsId)";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            if ($result) {
                $orderSuccessfulMessage = "Your order placed successfully, Your order ID is: ".mysqli_insert_id($con);
                echo $orderSuccessfulMessage."<br>";
                echo "Go to <a href='index.php'>home</a>";
//        echo "<script> alert($orderSuccessfulMessage) </script>";
//        header("Location: view_menu.php?order_success=".true);
            }
            else{
                echo "Could not place order<br>";
                echo "<a href='view_menu.php'>View Menu</a>";
            }
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