<?php
// Redirect to cart if cart is empty to show notice
//if (!isset($_SESSION['cart'])) {
//    header( "Location: /store/cart/" );
//}
$currentPage = 'payment';
$corona = 'corona';
$pageTitle = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$metaDes = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$javascript = ['cart_payment'];

include("../../_/inc/header.inc.php");
Order::insertOrder(); // Create order
?>
<main role="main" id="main-content" class="customer-admin">
    <section class="outer-wrap details">
        <div class="row row--narrow row--no-bottom-margin row--vpadding-max">
            <div class="steps">
                <div class="steps__steps_wrap">
                    <div>
                        <a href="/store/cart">
                            <div class="steps__steps_wrap--essentail steps__steps_wrap--complete">1</div>
                        </a>
                    </div>
                    <div>
                        <div class="steps__steps_wrap__bar_complete"></div>
                    </div>
                    <div>
                        <a href="/store/details">
                            <div class="steps__steps_wrap--essentail steps__steps_wrap--complete">2</div>
                        </a>
                    </div>
                    <div>
                        <div class="steps__steps_wrap__bar_complete"></div>
                    </div>
                    <div>
                        <a href="/store/payment">
                            <div class="steps__steps_wrap--essentail steps__steps_wrap--next">3</div>
                        </a>
                    </div>
                </div>
                <div class="steps__steps_text">
                    <div class="steps__steps_text__basket steps__steps_text--complete">Basket</div>
                    <div class="steps__steps_text__delivery steps__steps_text--complete">Delivery</div>
                    <div class="steps__steps_text__pay">Payment</div>
                </div>
            </div>

            <header class="details__header">
                <img class="details__header__image" src="/_/img/ecomm/checkout/opayo.svg" alt="Opayo">
                <h1 class="details__header__h1">Payment</h1>
            </header>

            <div class="details__wrap pay-button">
                <div class="details__wrap__payment-content" style="margin-bottom:0; border:none;">
                    <div class="details__wrap__payment">


                        <!-- CARD PAYMENT -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom:30px;">
                            <label class="details__wrap__payment--label">
                            <input type="radio" name="payment_method" id="payment_method_card" class="payment_method" value="card" checked />
                            CREDIT OR DEBIT CARD VIA OPAYO</label>
                            
                            <div class="shopping-basket__card-wrap">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-visa.svg" alt="Visa">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-mastercard.svg" alt="Mastercard">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-amex.svg" alt="Amex">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-maestro.svg" alt="Maestro">
                            </div>
                        </div>
                        

                        <div id="payment_wrapper__card" style="border: 0.1rem solid var(--ca-stroke);padding: 3rem;background: #fff; margin-bottom:30px;">
                            <form method="post" class="my-account-form__form" id="payment-form">
                                <div id="errors"></div>


                                <div class="my-account-form__input-wrap">
                                    <label class="my-account-form__label">Card Number:</label>
                                    <input class="my-account-form__input required required-field" type="text" name="card-number" data-name="Card number" placeholder="XXXX XXXX XXXX XXXX" />
                                </div>
                                <div class="my-account-form__input-wrap">
                                    <label class="my-account-form__label">Name on Card:</label>
                                    <input class="my-account-form__input required required-field" type="text" name="card-name" data-name="Cardholder's name" placeholder="Name as appears on card" />
                                </div>
                                <div class="details__wrap__payment__card-security">
                                    <div class="my-account-form__input-wrap">
                                        <label class="my-account-form__label">Expiry Date:</label>
                                        <input class="my-account-form__input required required-field details__wrap__payment__card-security--expiry" type="text" name="card-expiry-date-month" data-name="Expiry month" placeholder="MM" /> /
                                        <input class="my-account-form__input required required-field details__wrap__payment__card-security--expiry" type="text" name="card-expiry-date-year" data-name="Expiry year" placeholder="YY" />
                                    </div>

                                    <div class="my-account-form__input-wrap">
                                        <label class="my-account-form__label">CVV</label>
                                        <input class="my-account-form__input required required-field details__wrap__payment__card-security--expiry" type="text" name="card-ccv" data-name="Card security code" placeholder="123" />
                                    </div>
                                </div>


                                <div class="details__wrap__auto">
                                    <div class="details__wrap__auto--text">
                                        <span class="details__wrap__auto--title">Delivery Address</span><br />
                                        <?php echo Order::data('address1'); ?>, <?php if (Order::data('address2')) {
                                                                                    echo Order::data('address2') . ', ';
                                                                                } ?> <?php echo Order::data('city'); ?>, <?php echo Order::data('postcode'); ?>
                                        <a class="details__wrap__auto--change" href="/store/details">Change</a>
                                    </div>
                                </div>
                                <div class="details__wrap__auto">
                                    <div class="details__wrap__auto--text">
                                        <span class="details__wrap__auto--title">Billing Address</span><br />
                                        <?php if (Order::data('use_delivery')) {
                                            echo 'Same as Delivery Address';
                                        } else { ?>
                                            <?php echo Order::data('billing-address1'); ?>, <?php if (Order::data('billing-address2')) {
                                                                                                echo Order::data('billing-address2') . ', ';
                                                                                            } ?> <?php echo Order::data('billing-city'); ?>, <?php echo Order::data('billing-postcode'); ?>
                                        <?php } ?>
                                        <a class="details__wrap__auto--change" href="/store/details">Change</a>
                                    </div>
                                </div>
                                <div class="details__wrap__terms">
                                    <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle my-account-form__input-wrap--marketing-prefs">
                                        <label class="my-account-form__label my-account-form__label--toggle details__wrap__terms--text" for="terms"><span class="details__wrap__terms--title">Terms and Conditions</span><br />
                                            I agree to Jay-Be Terms and Conditions
                                        </label>
                                        <label class="my-account-form__switch">
                                            <input class="my-account-form__slide-checkbox" type="checkbox" name="terms-card" />
                                            <span class="my-account-form__slider my-account-form__slider--round"></span>
                                        </label>
                                    </div>
                                    <p class="details__wrap__terms--text">I agree to Jay-Be <a href="/terms">Terms and Conditions</a>. See <a href="/policies/privacy/">Privacy</a> and <a href="/policies/cookie/">Cookie Policy</a> for information on how we securely store and protect the data you provide to us.</p>
                                </div>

                                <div class="pay-button">
                                    <button id="btn-submit-payment" type="submit" class="my-account__button">Place your order</button>
                                </div>

                            </form>

                        </div>


                        <!-- PayPal PAYMENT -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom:30px;">
                            <label class="details__wrap__payment--label" style="margin-bottom: 20px;">
                                <input type="radio" name="payment_method" id="payment_method_paypal" class="payment_method" value="paypal" />
                                PAY VIA PAYPAL</label>

                            <div class="shopping-basket__card-wrap">
                                <img class="shopping-basket__card" src="/_/img/svg/credit-card-paypal.svg" alt="PayPal">
                            </div>

                        </div>


                        <div id="payment_wrapper__paypal" style="border: 0.1rem solid var(--ca-stroke);padding: 3rem;background: #fff; display:none;">

                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="my-account-form__form" id="payment-form-paypal">
                                <div class="details__wrap__auto">
                                    <div class="details__wrap__auto--text">
                                        <span class="details__wrap__auto--title">Delivery Address</span><br />
                                        <?php echo Order::data('address1'); ?>, <?php if (Order::data('address2')) {
                                                                                    echo Order::data('address2') . ', ';
                                                                                } ?> <?php echo Order::data('city'); ?>, <?php echo Order::data('postcode'); ?>
                                        <a class="details__wrap__auto--change" href="/store/details">Change</a>
                                    </div>
                                </div>
                                <div class="details__wrap__auto">
                                    <div class="details__wrap__auto--text">
                                        <span class="details__wrap__auto--title">Billing Address</span><br />
                                        <?php if (Order::data('use_delivery')) {
                                            echo 'Same as Delivery Address';
                                        } else { ?>
                                            <?php echo Order::data('billing-address1'); ?>, <?php if (Order::data('billing-address2')) {
                                                                                                echo Order::data('billing-address2') . ', ';
                                                                                            } ?> <?php echo Order::data('billing-city'); ?>, <?php echo Order::data('billing-postcode'); ?>
                                        <?php } ?>
                                        <a class="details__wrap__auto--change" href="/store/details">Change</a>
                                    </div>
                                </div>
                                <div class="details__wrap__terms">
                                    <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle my-account-form__input-wrap--marketing-prefs">
                                        <label class="my-account-form__label my-account-form__label--toggle details__wrap__terms--text" for="terms"><span class="details__wrap__terms--title">Terms and Conditions</span><br />
                                            I agree to Jay-Be Terms and Conditions
                                        </label>
                                        <label class="my-account-form__switch">
                                            <input class="my-account-form__slide-checkbox" type="checkbox" name="terms-paypal" />
                                            <span class="my-account-form__slider my-account-form__slider--round"></span>
                                        </label>
                                    </div>
                                    <p class="details__wrap__terms--text">I agree to Jay-Be <a href="/terms">Terms and Conditions</a>. See <a href="/policies/privacy/">Privacy</a> and <a href="/policies/cookie/">Cookie Policy</a> for information on how we securely store and protect the data you provide to us.</p>
                                </div>                                
                                
                                <!-- Paypal payment info -->
                                <input class="my-account-form__input" type='hidden' name='business' value='sb-7jspw16326293@business.example.com'>
                                <input class="my-account-form__input" type='hidden' name='item_name' value='Jay-Be Order #JB0000<?=$_SESSION['order']['order_number']?>'>
                                <input class="my-account-form__input" type='hidden' name='item_number' value='JB0000<?=$_SESSION['order']['order_number']?>'>
                                <input class="my-account-form__input" type='hidden' name='amount' value='<?=Cart::totalPrice()?>'>
                                <input class="my-account-form__input" type='hidden' name='no_shipping' value='1'>
                                <input class="my-account-form__input" type='hidden' name='currency_code' value='GBP'>

                                <!-- pre-populate Paypal's guest checkout fields -->
                                <input type="hidden" name="first_name" value="<?=$_SESSION['customer']['first_name']?>">
                                <input type="hidden" name="last_name" value="<?=$_SESSION['customer']['first_name']?>">
                                <input type="hidden" name="address1" value="<?=Order::data('address1')?>">
                                <input type="hidden" name="address2" value="<?=Order::data('address2')?>">
                                <input type="hidden" name="city" value="<?=Order::data('city')?>">
                                <input type="hidden" name="state" value="<?=Order::data('county')?>"> 
                                <input type="hidden" name="zip" value="<?=Order::data('postcode')?>">
                                <input type="hidden" name="country" value="GB">
                                <input type="hidden" name="night_phone_a" value="<?=$_SESSION['customer']['tel_mobile']?>">
                                <input type="hidden" name="email" value="<?=$_SESSION['customer']['email']?>">

                                <!-- override addresses stored in customer's Paypal account -->
                                <INPUT TYPE="hidden" name="address_override" value="1">

                                <input class="my-account-form__input" type='hidden' name='notify_url' value='https://paypal.hillsidestudio.uk/notify.php'>
                                <input class="my-account-form__input" type='hidden' name='cancel_return' value='<?=$_ENV['APP_URL']?>/store/payment/'>
                                <input class="my-account-form__input" type='hidden' name='return' value='<?=$_ENV['APP_URL']?>/store/complete/'>
                                <input class="my-account-form__input" type="hidden" name="cmd" value="_xclick">                                
                                
                                <!-- <div class="details--button"> -->
                                <div class="pay-button">
                                    <button id="btn-submit-paypal-payment" type="submit" class="my-account__button">Place your order</button>
                                </div>
                                <!-- </div> -->
                            </form>

                        </div>


                    </div>


                </div>

                <div id="order_summary" style="margin-top:45px;">
                    <?php include('../../_/inc/partials/summary.php'); ?>
                </div>

                <a href="/store/details" class="details__return-link">Return to delivery</a>

            </div>

        </div>


        </div>

    </section>
</main>
<?php include("../../_/inc/footer.inc.php"); ?>
<script>
    $('.payment_method').click(function() {
        if ($(this).val() == 'card') {
            $("form#payment-form-paypal").prop('id', 'payment-form');
            $(".required-field").addClass("required");
            $('#payment_wrapper__paypal').hide(100);
            $('#payment_wrapper__card').show(100);
        }
        if ($(this).val() == 'paypal') {
            $("form#payment-form").prop('id', 'payment-form-paypal');
            $(".required-field").removeClass("required");
            $('#payment_wrapper__card').hide(100);
            $('#payment_wrapper__paypal').show(100);
        }
    });
</script>