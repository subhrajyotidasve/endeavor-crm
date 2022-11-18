<?php
$sat_del = cart::saturdayDelivery();

$sat_delivery_rate = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['sat_delivery_rate'])->fetch();
$sat_delivery_rate = $sat_delivery_rate['setting_value'];

?>
<div class="details__wrap__total-box">
    <h3 class="details__wrap__total-box__h3">Order Summary</h3>
    <?php

    foreach ($_SESSION['cart'] as $key => $value) {

        $product = Products::get($_SESSION['cart'][$key]['id']);
        // var_dump($product);
        $price = $product['product_price'] * $_SESSION['cart'][$key]['quantity'];
    ?>
        <div class="details__wrap__total-box__product">
            <div>
                <a href="<?= $product['product_website_url'] ?>">
                    <img src="<?php echo $product['product_thumbnail_image'] ?>" alt="<?php echo $product['product_name']; ?>" />
                </a>
            </div>
            <div class="details__wrap__total-box__product--padding">
                <a href="<?= $product['product_website_url'] ?>">
                    <span class="details__wrap__total-box__product--name">
                        <?php
                        //                    echo $product['product_name'] . ' (' . $product['size']. ')';
                        if (!empty($product['size'])) {
                            echo $product['product_name'] . ' (' . $product['size'] . ')';
                        }
                        if (!empty($product['color'])) {
                            echo $product['product_name'] . ' (' . $product['color'] . ')';
                        }
                        if (!empty($product['model'])) {
                            echo $product['product_name'] . ' (' . $product['model'] . ')';
                        }
                        ?>
                    </span>
                </a>
                <br />

                    <?php if ($product['product_category'] == '3') { ?>
                        Made to order, ready for despatch in 4 to 6 weeks<br />
                    <?php
                    } else {
                        // if ( ($sat_del == true) || (!empty($_SESSION['order']['delivery_date'])) ) {
                        if (  !empty($_SESSION['order']['delivery_date']) && ($_SESSION['order']['delivery_date'] != false) ) {
                            $delivery_date = $_SESSION['order']['delivery_date'];
                            echo "In stock, selected " . date('l jS F Y', strtotime($delivery_date));
                        } else {
                            echo "In stock, get it " . date("l jS F Y", strtotime(Dates::deliveryDate()));
                        }
                    ?>
                        <br />
                    <?php } ?>
                    Qty: x<?php echo $_SESSION['cart'][$key]['quantity']; ?>
            </div>
            <div class="details__wrap__total-box__product--price">£<?php echo Strings::price_format($price, 2); ?></div>
        </div>
    <?php } ?>
    <div class="details__wrap__footer-wrap--totals">
        <div class="details__wrap__footer-wrap__total-wrap">
            <div class="details__wrap__footer-wrap__total-wrap--title">Subtotal (<?php echo Cart::itemCount(); ?> items)</div>
            <div class="details__wrap__footer-wrap__total-wrap--value">£<?php echo Strings::price_format(Cart::subTotalPrice(), 2); ?></div>
        </div>
        <div class="details__wrap__footer-wrap__total-wrap">
            <div class="details__wrap__footer-wrap__total-wrap--delivery"><?php echo $sat_del ? 'Saturday delivery' : 'Delivery ';  ?></div>
            <div class="details__wrap__footer-wrap__total-wrap--delivery-right">
                <?php echo ($sat_del == false) ? 'Free Delivery' : '£' . $sat_delivery_rate ?>
            </div>
        </div>
        <?php if (!empty($_SESSION['voucher']['code'])) { ?>
            <div class="details__wrap__footer-wrap__total-wrap">
                <div class="details__wrap__footer-wrap__total-wrap--delivery">
                    Promo saving
                </div>
                <div class="details__wrap__footer-wrap__total-wrap--delivery-right">
                    £<?= Strings::price_format(Cart::discountTotal()) ?>
                </div>
            </div>
        <?php } ?>
        <div class="details__wrap__footer-wrap__total-wrap">
            <div class="details__wrap__footer-wrap__total-wrap--title">Total
                <!-- <?php if (Cart::voucher('code')) { ?>
                   <br/><span class="details__wrap__footer-wrap__total-wrap--required">Promo applied you save £<?php echo Strings::price_format(Cart::discountTotal()); ?></span>
                    <br/><span class="details__wrap__footer-wrap__total-wrap--required"><?= Cart::voucher('code') ?></span>
                <?php } ?> -->
            </div>
            <div class="details__wrap__footer-wrap__total-wrap--value">
                <?php // if (Cart::voucher('code')) { 
                ?>
                <!-- <span class="details__wrap__footer-wrap__total-wrap--was">WAS <strike>£<?php echo Strings::price_format(Cart::wasPrice(), 2); ?></strike></span><br/>£<?php echo Strings::price_format(Cart::totalPrice(), 2); ?><br/> -->
                <?php // } else { 
                ?>
                <div class="details__wrap__footer-wrap__total-wrap--value">£<?php echo Strings::price_format(Cart::totalPrice(), 2); ?></div>
                <?php // } 
                ?>
                <span class="details__wrap__footer-wrap__total-wrap--value--small">Includes VAT of £<?php echo Strings::price_format(Cart::vat(Cart::totalPrice()), 2) ?></span>
            </div>
        </div>
    </div>
</div>