<?php
if (!isset($_SESSION)) {
    session_start();
}
include "user_check.php";
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

    <title>Add Menu Item</title>
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
                <h2><span>Add Item</span></h2>
            </div>

            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" role="form" class="php-email-form">
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 form-group">
                        <input type="text" name="item_name" class="form-control" id="name"
                               placeholder="Item Name" required>
                        <div class="validate"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        <input type="text" name="price" class="form-control" id="name" placeholder="Price" required>
                        <div class="validate"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group">
                        Type:
                        <?php
                        include "database_connection.php";
                        $sql = "SELECT * FROM preference_type";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <input type="radio" name="preference_type" value=<?= $row['id'] ?> required /><label><?= $row['name'] ?></label>
                                <?php
                            }
                        }
                        ?>
                        <div class="validate"></div>
                    </div>
                </div>

                <?php
                include "database_connection.php";
                if (isset($_POST['add_menu_item_submit'])) {
//    print_r($_SESSION['userInfo']);
                    $itemName = $_POST['item_name'];
                    $price = doubleval($_POST['price']);
                    $preferenceTypeId = $_POST['preference_type'];
                    $restaurantId = $_SESSION['userInfo']['id'];
                    if (isItemAlreadyAdded($itemName, $preferenceTypeId, $restaurantId)) {
                        echo '<div class="mb-3">This item is already added.</div>';
                    } else {
                        $sql = "INSERT INTO item_details (name, price, preference_type_id, restaurant_id)
                VALUES ('$itemName', $price, $preferenceTypeId, $restaurantId);";
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        if ($result){
                            echo '<div class="mb-3">added new item succesfully</div>';
                        }
                        else {
                            echo '<div class="mb-3">could not add new item.</div>';
                        }
                    }
                }

                function isItemAlreadyAdded($itemName, $preferenceTypeId, $restaurantId)
                {
                    include "database_connection.php";
                    $sql = "SELECT * FROM item_details where name='$itemName' AND preference_type_id=$preferenceTypeId AND restaurant_id=$restaurantId";
                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                    if (mysqli_num_rows($result) > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                ?>

                <div class="text-center">
                    <button name="add_menu_item_submit" type="submit">Add Menu Item</button>
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

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<!--<script src="assets/vendor/php-email-form/validate.js"></script>-->
<script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>