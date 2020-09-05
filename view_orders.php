<?php
if (!isset($_SESSION)) {
    session_start();
}
include "user_check.php";
include "database_connection.php";
if (!isAuthorizedUser("RESTAURANT")) {
    echo "Not authorized to view this page<br>";
    echo '<a href="login.php">Login</a>';
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>View Orders</title>
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
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Order <span>Details</span></h2>
            </div>

            <?php
            $restaurantId = $_SESSION['userInfo']['id'];
            $sql = "SELECT order_details.id AS order_id, date(order_details.created_time) AS order_date,
                    users.first_name AS customer_first_name, users.last_name AS customer_last_name,
                    item_details.name AS item_name, item_details.price AS order_amount 
                    FROM order_details
                    JOIN users ON (order_details.customer_id = users.id)
                    JOIN item_details ON (order_details.item_details_id = item_details.id)
                    WHERE order_details.restaurant_id = $restaurantId";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Item Name</th>
                        <th>Order Date</th>
                        <th>Order Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderId = $row['order_id'];
                        $customerName = $row['customer_first_name'] . " " . $row['customer_last_name'];
                        $itemName = $row['item_name'];
                        $orderDate = $row['order_date'];
                        $orderAmount = $row['order_amount'];
                        ?>
                        <tr>
                            <td><?= $orderId ?></td>
                            <td><?= $customerName ?></td>
                            <td><?= $itemName ?></td>
                            <td><?= date("d-m-Y", strtotime($orderDate)) ?></td>
                            <td><?= $orderAmount ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "No orders yet";
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