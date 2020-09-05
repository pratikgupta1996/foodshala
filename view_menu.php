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

    <title>View Menu</title>
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
<script>
    function orderConfirmation() {
        var confirmOrder = confirm("Are you sure, you want to place the order ?");
        if (!confirmOrder) {
            return false;
        }
    }
</script>
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

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
        <div class="container">

            <div class="section-title">
                <h2>Check our tasty <span>Menu</span></h2>
            </div>

            <div class="row menu-container">

                <?php
                include "database_connection.php";
                $sql = "SELECT item_details.id AS item_details_id, item_details.name AS item_name, item_details.price AS price, 
                        users.id AS restaurant_id, users.first_name AS restaurant_name, 
                        preference_type.id AS preference_type_id, preference_type.name AS preference_type_name FROM item_details 
                        JOIN users ON (item_details.restaurant_id = users.id) 
                        JOIN preference_type ON (item_details.preference_type_id = preference_type.id)";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-6 menu-item filter-starters">
                            <div class="menu-content">
                                <a><?= $row['item_name'] ?></a><span>Rs. <?= $row['price'] ?></span>
                            </div>
                            <div class="menu-ingredients">
                                <?= $row['preference_type_name'] ?>, Restaurant: <?= $row['restaurant_name'] ?>
                            </div>
                            <?php
                            if (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] == "RESTAURANT"):
                                ?>
                                <div>
<!--                                    <a href="add_order.php" style="pointer-events: none">Order</a>-->
                                </div>
                            <?php
                            else:
                                $itemDetailsId = $row['item_details_id'];
                                $restaurantId = $row['restaurant_id'];
                                $preferenceTypeId = $row['preference_type_id'];
                                ?>
                                <div>
                                    <a onclick="return orderConfirmation()" href="add_order.php?item_details_id=<?= $itemDetailsId ?>&restaurant_id=<?= $restaurantId?>&preference_type_id=<?= $preferenceTypeId ?>">Order</a>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>

        </div>
    </section>
    <!-- End Menu Section -->

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