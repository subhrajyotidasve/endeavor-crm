<?php
$currentPage = 'cart';
$pageType = 'cart';
$corona = 'corona';
$pageTitle = 'Debug';
$metaDes = 'Debug';
$javascript = ['cart_page'];

include("../../_/inc/header.inc.php");

// var_dump($_SESSION['cart']);

?>

<!-- Bootstrap CSS -->
<!-- <link href="/_/admin/css/bootstrap.min.css" rel="stylesheet"> -->

<div class="container-fluid">
    <div class="row" style="max-width: unset;">

    <div class="col-lg-3">
            <?php
            echo '<h1>Cart Session</h1>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['cart']);
            echo '</pre>';
            echo 'Cart Items: '.count($_SESSION['cart']);
            ?>
        </div>

        <div class="col-lg-3">
            <?php
            echo '<h1>Voucher Session</h1>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['voucher']);
            echo '</pre>';
            ?>
        </div>

        <div class="col-lg-3">
            <?php
            echo '<h1>Customer Session</h1>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['customer']);
            echo '</pre>';
            ?>
        </div>

        <div class="col-lg-3">
            <?php
            echo '<h1>Order Session</h1>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['order']);
            echo '</pre>';
            ?>
        </div>

        <div class="col-lg-3">
            <?php
            echo '<h1>Wishlist Session</h1>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['wishlist']);
            echo '</pre>';
            echo '<pre style="font-size:12px;">';
            var_dump($_SESSION['wishlist_count']);
            echo 'Wishes: '.$wishes;
            echo 'Total Wishes: '.$_SESSION['wishlist_count'];
            echo '</pre>';
            ?>
        </div>

    </div>
</div>

<?php include("../../_/inc/footer.inc.php"); ?>
<!-- Bootstrap JS -->
<!-- <script src="/_/admin/js/bootstrap.bundle.min.js"></script> -->
