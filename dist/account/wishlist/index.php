<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'wishlist';
$accountTitle = 'Wishlist';
$pageTitle = 'Dashboard you have to place an order';
$metaDes = 'Dashboard you have to place an order';
$javascript = ['wishlist_page'];

include("../../_/inc/header.inc.php");

$wishlist = Cart::getAllWishlist();

if (!$wishlist) {

    include('no-wishlist.php');
} else {
?>
    <main role="main" id="main-content" class="customer-admin">
        <section class="row my-account">
            <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
            <nav class="my-account-breadcrumb">
            <ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item">Wishlist</li>
				</ul>
			</nav>
            <div class="my-account-grid-wrap">
                <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
                <section class="my-account-wishlist">
                <?php
                foreach($wishlist as $product) {
                ?>
                <div id="wishlist-item-<?= $product['id']?>" class="my-account-wishlist__product">
                    <svg id="wishlist-remove-item-<?= $product['id'] ?>" style="cursor:pointer" aria-hidden="true" class="my-account-wishlist__close" viewBox="0 0 100 100">
                        <use xlink:href="<?=$svg_sprite_url?>#icon-close"></use>
                    </svg>
                    <img class="my-account-wishlist__thumb" src="/..<?php echo $product['product_thumbnail_image']; ?>" alt="<?php echo $product['product_name']; ?>">
                    <h2 class="my-account-wishlist__h2">
		                    <?php
		                      echo $product['product_name'];
//						              if ($product['product_size']) {
//							              echo " ".$product['product_size'];
//													}
												?>
                    </h2>
                    <div class="my-account-wishlist__body">
                        <div class="my-account-wishlist__stock-wrap">
                                <span class="my-account-wishlist__stock">
                                    <svg aria-hidden="true" class="my-account-wishlist__icon" viewBox="0 0 100 100">
                                        <use xlink:href="<?=$svg_sprite_url?>#icon-tick"></use>
                                    </svg>In Stock
                                </span>
                            
                                <?php
                                $product_id = $product['id'];
                                $product_promo = Promo::getProductPromos($product_id);
                                if (!empty($product_promo)) {
                                ?>                            
                                    <span class="my-account-wishlist__price">£<?= Products::getPromoPrice($product_id, $product_promo['id'])[0] ?>.<?= Products::getPromoPrice($product_id, $product_promo['id'])[1] ?></span><br />
                                    <span class="">Was <span class="selection__orig-price--numeric">£<?= Products::getPrice($product_id)[0] ?>.<span class="selection__orig-price--pence"><?= Products::getPrice($product_id)[1] ?></span></span></span>
                                <?php } else { ?>
                                    <span class="my-account-wishlist__price">£<?php echo $product['product_price']; ?></span><br />&nbsp;
                                <?php } ?>

                        </div>

                    </div><!-- body -->

                    <a href="<?= $product['product_website_url'] ?>" class="my-account__button my-account__button--block">View Product</a>

                </div><!-- my-account-wishlist__product -->
                <?php
                }
                ?>
                </section>
            </div><!-- my-account-grid-wrap -->
			<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
        </section><!-- my-account -->
    </main>

<?php include("../../_/inc/footer.inc.php"); ?>
<?php } ?>