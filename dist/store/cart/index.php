<?php
$currentPage = 'cart';
$pageType = 'cart';
$corona = 'corona';
$pageTitle = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$metaDes = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$javascript = ['cart_page'];

include("../../_/inc/header.inc.php");

// var_dump($_SESSION['cart']);

$sat_del = cart::saturdayDelivery();

$sat_delivery_rate = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['sat_delivery_rate'])->fetch();
$sat_delivery_rate = $sat_delivery_rate['setting_value'];


// // $date = new DateTimeImmutable('2020-04-20 00:00:00');
// if (!empty($_SESSION['order']['delivery_date'])) {

//     // $date = new DateTime(strtotime($_SESSION['order']['delivery_date']));
//     $date = date('d/m/Y', strtotime($_SESSION['order']['delivery_date']));

//     if ($date('N') == 6) {
//         // echo "Saturday selected!";
//         $sat_del = true;
//     }
// }
?>

<main role="main" id="main-content">

    <section id="shopping-basket" class="outer-wrap shopping-basket">
        <div class="row row--narrow row--no-bottom-margin row--vpadding-max" id="cart_override">
            <?php if (Cart::itemCount() > 0) { ?>

                <div class="steps">
                    <div class="steps__steps_wrap">
                        <div>
                            <a href="/store/cart">
                                <div class="steps__steps_wrap--essentail steps__steps_wrap--next">1</div>
                            </a>
                        </div>
                        <div>
                            <div class="steps__steps_wrap__bar_default"></div>
                        </div>
                        <div>
                            <a href="/store/details">
                                <div class="steps__steps_wrap--essentail steps__steps_wrap--default">2</div>
                            </a>
                        </div>
                        <div>
                            <div class="steps__steps_wrap__bar_default"></div>
                        </div>
                        <div>
                            <a href="/store/payment">
                                <div class="steps__steps_wrap--essentail steps__steps_wrap--default">3</div>
                            </a>
                        </div>
                    </div>
                    <div class="steps__steps_text">
                        <div class="steps__steps_text__basket steps__steps_text--complete">Basket</div>
                        <div class="steps__steps_text__delivery">Delivery</div>
                        <div class="steps__steps_text__pay">Payment</div>
                    </div>
                </div>
            <?php } ?>

            <header class="shopping-basket__header">
                <img class="shopping-basket__header__image" src="/_/img/ecomm/checkout/opayo.svg" alt="Opayo" />
                <h1 class="shopping-basket__header__h1">Shopping Basket</h1>
            </header>

            <?php if (Cart::itemCount() > 0) { ?>
                <div class="shopping-basket__wrap">
                    <div class="shopping-basket__wrap--header">Product</div>
                    <div class="shopping-basket__wrap--header shopping-basket__wrap--header-center">Unit price</div>
                    <div class="shopping-basket__wrap--header shopping-basket__wrap--header-center">Quantity</div>
                    <div class="shopping-basket__wrap--header shopping-basket__wrap--header-right">Total</div>
                </div>

                <?php

                if (Cart::itemCount() > 0) {

                    //                echo '<pre>';
                    //                var_dump($_SESSION['cart']);
                    //                echo '</pre>';

                    foreach ($_SESSION['cart'] as $item) {

                        // var_dump($item);

                        $item_price = $item['quantity'] * $item['product_price'];

                ?>
                        <div id="item-card-<?= $item['id'] ?>" class="shopping-basket__wrap">
                            <div class="shopping-basket__wrap--product">
                                <a href="<?= $item['product_website_url'] ?>" target="_blank">
                                    <img class="shopping-basket__wrap--product--image" src="<?= $item['product_thumbnail_image'] ?>" />
                                    <span class="shopping-basket__wrap--product--name"><?= $item['product_name'] ?>
                                        <?php
                                        if (!empty($item['size'])) {
                                            echo ' (' . $item['size'] . ')';
                                        }
                                        if (!empty($item['color'])) {
                                            echo ' (' . $item['color'] . ')';
                                        }
                                        if (!empty($item['model'])) {
                                            echo ' (' . $item['model'] . ')';
                                        }
                                        ?>
                                    </span></a><br />
                                <?php if ($item['product_category'] == '3') { ?>
                                    Made to order, ready for despatch in 4 to 6 weeks<br />
                                <?php
                                } else {
                                    if (($sat_del == true) || (!empty($_SESSION['order']['delivery_date']))) {
                                        echo "In stock, selected " . date("l jS F", strtotime($_SESSION['order']['delivery_date']));
                                    } else {
                                        echo "In stock, get it " . date("l jS F", strtotime(Dates::deliveryDate()));
                                    }
                                ?>
                                    <br />
                                <?php } ?>
                                <br />

                                <a data-id="<?= $item['id'] ?>" class="shopping-basket__wrap--product--remove remove-item">Remove item</a>
                            </div>
                            <div id="item-price-<?= $item['id'] ?>" class="shopping-basket__wrap--price">£<?= Strings::price_format($item['product_price'], 2) ?></div>
                            <div class="shopping-basket__wrap--quantity">
                                <div class="shopping-basket__wrap__quantity-box">
                                    <div>
                                        <button class="shopping-basket__wrap__quantity-box--subtract decrease" type="button" data-id="<?= $item['id'] ?>">-</button>
                                    </div>
                                    <div>
                                        <div class="shopping-basket__wrap__quantity-box--amount" id="item-quantity-<?php echo $item['id']; ?>"><?= $item['quantity'] ?></div>
                                        <input id="product-quantity" type="hidden" value="<?= $item['quantity'] ?>">
                                    </div>
                                    <div>
                                        <button class="shopping-basket__wrap__quantity-box--add increase" type="button" data-id="<?= $item['id'] ?>">+</button>
                                    </div>
                                </div>
                            </div>
                            <div id="item-total-<?= $item['id'] ?>" class="shopping-basket__wrap--total">£<?= Strings::price_format($item_price, 2) ?></div>
                        </div>
                <?php

                    }
                }

                ?>
                <div class="shopping-basket__footer-wrap">
                    <div class="shopping-basket__footer-wrap--delivery">
                        <div class="shopping-basket__footer-wrap__border">
                            <div class="shopping-basket__footer-wrap__border__delivery">

                                <h5 class="shopping-basket__delivery-note-header">A note on deliveries</h5>
                                <span class="shopping-basket__footer-wrap__border__delivery--text">Free next delivery is available on all of our products unless otherwise stated. Saturday deliveries are charged at <span style="font-weight:600;">£<?= $sat_delivery_rate ?>.</span> We are currently shipping to UK mainland addresses only. For more information please see our <a href="/policies/delivery">delivery policy.</a></span>
                            </div>

                            <div>
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-visa.svg" alt="Visa">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-mastercard.svg" alt="Mastercard">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-amex.svg" alt="Amex">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-maestro.svg" alt="Maestro">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-paypal.svg" alt="PayPal">
                            </div>
                        </div>
                    </div>
                    <div class="shopping-basket__footer-wrap--totals">

                        <div class="shopping-basket__footer-wrap__total-wrap">
                            <div id="subtotal_cart_count" class="shopping-basket__footer-wrap__total-wrap--title">Subtotal (<?php echo Cart::itemCount(); ?> items)</div>
                            <div id="subtotal" class="shopping-basket__footer-wrap__total-wrap--value">£<?= Strings::price_format(Cart::subTotalPrice(), 2); ?></div>
                        </div>

                        <div class="shopping-basket__footer-wrap__total-wrap">
                            <div class="shopping-basket__footer-wrap__total-wrap--delivery"><?php echo $sat_del ? 'Saturday delivery' : 'Delivery ';  ?></div>
                            <div class="shopping-basket__footer-wrap__total-wrap--delivery-right">
                                <?php echo $sat_del ? '£' . $sat_delivery_rate : 'Free delivery' ?>
                            </div>
                        </div>

                        <?php if (!empty($_SESSION['voucher']['code'])) { ?>
                            <div class="shopping-basket__footer-wrap__total-wrap">
                                <div class="shopping-basket__footer-wrap__total-wrap--delivery">
                                    Promo saving
                                </div>
                                <div class="shopping-basket__footer-wrap__total-wrap--delivery-right">
                                    £<?= Strings::price_format(Cart::discountTotal()) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="shopping-basket__footer-wrap__total-wrap">
                            <div class="shopping-basket__footer-wrap__total-wrap--title">Total</div>
                            <div id="total" class="shopping-basket__footer-wrap__total-wrap--value">£<?= Strings::price_format(Cart::totalPrice(), 2) ?><br />
                                <span class="shopping-basket__footer-wrap__total-wrap--value--small"></span>
                            </div>
                        </div>

                        <small style="float:right" id="vat-total">Includes VAT of £<?= Strings::price_format(Cart::vat(Cart::totalPrice()), 2) ?></small>

                        <div class="shopping-basket__footer-wrap__promo-wrap">
                            <div class="shopping-basket__footer-wrap__promo-wrap--col">
                                <svg aria-hidden="true" class="shopping-basket__footer-wrap__promo-wrap--col--icon" viewBox="0 0 100 100">
                                    <use xlink:href="<?= $svg_sprite_url ?>#icon-promo"></use>
                                </svg>
                                <?php

                                if (Cart::voucher('code')) {

                                    // echo '<a id="promo-applied"><span style="color:#007bfc">Staff Order<br>';
                                    echo '<a id=""><span style="color:#007bfc">Promo ' . Cart::voucher('code') . ' applied<br>';
                                    echo '<span id="discount-total">You save £' . Strings::price_format(Cart::discountTotal()) . '</span><br>';
                                    // echo '<span style="cursor:pointer;" id="discount-total">(Click to remove)</a>';
                                } else {

                                    echo 'Have a promo code?<br>';
                                    echo 'Enter your code here';
                                }

                                ?>
                            </div>
                            <div class="shopping-basket__footer-wrap__promo-wrap--col">
                                <?php

                                if (isset(Cart::$voucher_error)) {

                                    echo '<small style="color: red">' . Cart::$voucher_error . '</small>';
                                }

                                ?>
                                <?php if (empty(Cart::voucher('code'))) { ?>

                                    <form action="/store/cart/" method="post">
                                        <input type="text" class="shopping-basket__footer-wrap__promo-wrap--col--input" name="promo_code" value="" />
                            </div>
                            <div class="shopping-basket__footer-wrap__promo-wrap--col">
                                <button style="cursor:pointer" type="submit" class="shopping-basket__footer-wrap__promo-wrap--button">Apply</button>
                            </div>
                            </form>

                        <?php } else { ?>
                        </div>
                        <div class="shopping-basket__footer-wrap__promo-wrap--col">
                            <button id="promo-applied" style="cursor:pointer" type="button" class="shopping-basket__footer-wrap__promo-wrap--button">Remove</button>
                        </div>
                    <?php } ?>

                    </div>
                    <div class="shopping-basket__footer-wrap__checkout">
                        <a href="/store/details" class="shopping-basket__footer-wrap__checkout--button">Checkout</a><br /><br />
                        <a href="/" class="details__return-link">Continue shopping</a>
                    </div>
                </div>
        </div>

    <?php } else { ?>
        <br /><br />
        <p style='text-align:center'>Your basket is empty.<br><a href="/">Start</a> shopping!</p>
    <?php } ?>
    </div>
    </section>

</main>
<?php include("../../_/inc/footer.inc.php"); ?>