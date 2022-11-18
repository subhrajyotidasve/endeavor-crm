<?php
$product = $products[0];
$product_code = $product['product_code'];
$show_product_code = false;

// echo 'Product ID: '.$product['id'].'<br />';
// echo 'Parent product ID: '.$product['parent_id'].'<br />';
// echo 'Category ID: '.$product['product_category'].'<br />';

$variants = Products::all(['parent_id' => $product['id']]);
if (empty($variants)) { $show_product_code = true; }
if ( !empty($variants) && ($product['product_category'] == '3')) { $show_product_code = true; }

// echo 'Variants: ';
// var_dump($variants);

$product_promo = Promo::getProductPromos($product['id']);
// var_dump($product_promo);
?>

<div class="viewer__info-box">

    <!-- PRODUCT info -->
    <?php echo $show_product_code ? "<h3 class='viewer__code'>Product Code: " . $product['product_code'] . "</h3>" : "" ?>

    <h1 class="viewer__h1"><?= $product['product_name'] ?>

        <div id="wishlist-icon" class="<?php echo ($wished == 1) ? 'wishlist-on' : 'wishlist-link' ?>" href="#" aria-label="Add to your Wishlist!" onclick="toggleWishList()">
            <svg class="wishlist-link__wishlist-icon" aria-hidden="true" viewBox="0 0 100 100">
                <use xlink:href="<?= $svg_sprite_url ?>#icon-wishlist"></use>
            </svg>
        </div>
    </h1>

    <h2 class="viewer__h2"><?= $product['product_subtitle'] ?></h2>

</div>

<div class="viewer__info-box">

    <!-- WAS price -->
    <?php if (!empty($product_promo)) { ?>
        <div class="viewer__info-box__discount-price" id="product_was_price_change">
            Was 
            <span class="viewer__info-box__discount-price--strike-thru">&pound;<?= Products::getPrice($product['id'])[0] ?>.<span class="viewer__info-box__discount-price--pence"><?= Products::getPrice($product['id'])[1] ?></span></span>
        </div>
    <?php } ?>

    <!-- CURRENT Price -->
    <div class="viewer__info-box__price-box">
        <div class="viewer__info-box__price" id="product_price_change">
        <?php if (!empty($product_promo)) { ?>
                &pound;<?= Products::getPromoPrice($product['id'], $product_promo['id'])[0] ?>.<span class="viewer__info-box__price--pence"><?= Products::getPromoPrice($product['id'], $product_promo['id'])[1] ?></span>
            <?php } else { ?>
                &pound;<?= Products::getPrice($product['id'])[0] ?>.<span class="viewer__info-box__price--pence"><?= Products::getPrice($product['id'])[1] ?></span>
            <?php } ?>
        </div>

        <div class="viewer__info-box__delivery-wrap">

            <svg class="viewer__info-box__circle-tick" aria-hidden="true" viewBox="0 0 100 100">
                <use xlink:href="<?= $svg_sprite_url ?>#icon-circled-tick"></use>
            </svg>

            <span class="viewer__info-box__free-delivery">Free delivery</span>
        </div>
    </div>

    <!-- PROMO code -->
    <?php if (!empty($product_promo)) { ?>
    <div class="viewer__info-box__promo">
        <span class="viewer__info-box__promo--blue">Use Promo code <span class="viewer__info-box__promo--strong"><?= $product_promo['code'] ?></span></span> - <?= $product_promo['description'] ?>
    </div>
    <?php } ?>

</div>