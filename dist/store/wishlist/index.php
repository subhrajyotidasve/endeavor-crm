<?php
$currentPage = 'guest';
$accountSection = 'wishlist';
$accountTitle = 'Wishlist';
$pageTitle = 'View your wishlist';
$metaDes = 'View your wishlist';
$javascript = ['wishlist_page'];

include("../../_/inc/header.inc.php");

if (!isset($_SESSION['wishlist']) || empty($_SESSION['wishlist'])) { ?>
        
    <main role="main" id="main-content">
        <section id="shopping-basket" class="outer-wrap shopping-basket" style="text-align: center !important;">
            <div class="generic-shop-head row row--narrow row--no-bottom-margin row--vpadding">
                <h1 class="generic-shop-head__title">Your Wishlist is empty</h1>
                <p class="generic-shop-head__copy">Click the love heart icons on any items that take your fancy.</p>
                <p class="generic-shop-head__copy"><a href="/">Start shopping!</a></p>
            </div>
        </section>
    </main>

<?php } else {
    
    $products = Cart::guestWishlist();

?>
<main role="main" id="main-content" class="outer-wrap customer-admin">
    
    <section class="outer-wrap shopping-basket">
        <div class="generic-shop-head row row--narrow row--no-bottom-margin row--vpadding" style="text-align: center !important;">
            <h1 class="generic-shop-head__title">Wishlist</h1>
            <p class="generic-shop-head__copy">Don't lose your favourite items</p>
            <p class="generic-shop-head__copy"><a href="/account/">Sign in</a> or <a href="/account/register-account/">Create an account</a></p>
        </div>
    </section>

    <section class="row row--has-flex-grid row--no-bottom-margin">

        <div class="my-account-wishlist__flex-container">

        <?php foreach($products as $product) { ?>

        <div id="wishlist-item-<?= $product['id']?>" class="my-account-wishlist__product col-1-of-3">

            <svg style="cursor:pointer" aria-hidden="true" class="my-account-wishlist__close" viewBox="0 0 100 100">
                <use id="wishlist-remove-item-<?= $product['id'] ?>" xlink:href="<?=$svg_sprite_url?>#icon-close"></use>
            </svg>

            <img class="my-account-wishlist__thumb" src="/..<?php echo $product['product_thumbnail_image']; ?>" alt="<?php echo $product['product_name']; ?>">
            
            <h2 class="my-account-wishlist__h2"><?php
                            echo $product['product_name'];
                            //                                    if ($product['product_size']) {
                            //                                        echo " ".$product['product_size'];
                            //                                                  }
                        ?></h2>

            <div class="my-account-wishlist__body">
                <div class="my-account-wishlist__stock-wrap">
                    <span class="my-account-wishlist__stock">
                        <svg aria-hidden="true" class="my-account-wishlist__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-tick"></use>
                        </svg>
                        In Stock
                    </span>
                    <span class="my-account-wishlist__price">£<?php echo $product['product_price']; ?></span>
                </div>

            </div>

            <small id="item-added-<?= $product['id'] ?>" hidden>Added to Basket</small>
<!--            <a id="add-to-cart---><?//= $product['id'] ?><!--" class="my-account__button my-account__button--block">Add to Basket</a>-->
            <a href="<?= $product['product_website_url'] ?>" class="my-account__button my-account__button--block">View Product</a>

        </div>

        <?php } ?>

        </div><!-- flex-container -->

    </section>
</main>
<?php } ?>

<?php include("../../_/inc/footer.inc.php"); ?>