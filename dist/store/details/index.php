<?php
// Redirect to cart if cart is empty to show notice
//if (!isset($_SESSION['cart'])) {
//    header( "Location: /store/cart/" );
//}
$currentPage = 'cart';
$pageType = 'details';
$corona = 'corona';
$pageTitle = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$metaDes = 'Jay-Be&reg; Sleep Smart Products - Shopping Cart';
$javascript = ['cart_details_global', 'cart_login_page', 'forgot_password_page'];

include("../../_/inc/header.inc.php");

if (Customer::loggedIn()) {
    $javascript[] = 'cart_details_customer';
    $javascript[] = 'newsletter_page';
} else {
    $javascript[] = 'cart_details';
}
if ( empty($_SESSION['order']['delivery_date']) || $_SESSION['order']['delivery_date'] == false) {
    $_SESSION['order']['delivery_date'] = date('d-m-Y', strtotime(Dates::deliveryDate()));
    // $_SESSION['order']['delivery_date'] = Dates::deliveryDate();
}
$sat_delivery_rate = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['sat_delivery_rate'])->fetch();
$sat_delivery_rate = $sat_delivery_rate['setting_value'];
?>
<main role="main" id="main-content" class="customer-admin">
    <section class="outer-wrap details">
        <div class="row row--narrow row--no-bottom-margin row--vpadding-max">
            <div class="steps">
                <div class="steps__steps_wrap">
                    <div>
                        <a href="/store/cart/">
                            <div class="steps__steps_wrap--essentail steps__steps_wrap--complete">1</div>
                        </a>
                    </div>
                    <div>
                        <div class="steps__steps_wrap__bar_complete"></div>
                    </div>
                    <div>
                        <a href="/store/details">
                            <div class="steps__steps_wrap--essentail steps__steps_wrap--next">2</div>
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
                    <div class="steps__steps_text__delivery steps__steps_text--complete">Delivery</div>
                    <div class="steps__steps_text__pay">Payment</div>
                </div>
            </div>

            <header class="details__header">
                <img class="details__header__image" src="/_/img/ecomm/checkout/opayo.svg" alt="Opayo">
                <h1 class="details__header__h1">Your details</h1>
            </header>

            <form action="/store/payment" method="POST" id="details-form">
                <div id="errors"></div>
                <div class="details__wrap">
                    <div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="first_name"><span class="details__wrap--required">*</span>First Name:</label>
                            <input tabindex="1" class="my-account-form__input required" type="text" name="first_name" value="<?php echo (Customer::adminLoggedIn()) ? '' : $first_name ?>" placeholder="First Name" />
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="last_name"><span class="details__wrap--required">*</span>Last Name:</label>
                            <input tabindex="2" class="my-account-form__input required" type="text" name="last_name" value="<?php echo (Customer::adminLoggedIn()) ? '' : $last_name ?>" placeholder="Last Name" />
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="email"><span class="details__wrap--required">*</span>Email Address:</label>
                            <input tabindex="3" class="my-account-form__input required" type="email" name="email" value="<?php echo (Customer::adminLoggedIn()) ? '' : $email ?>" placeholder="email@domain.com" />
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="phone"><span class="details__wrap--required">*</span>Telephone No:</label>
                            <input tabindex="4" class="my-account-form__input required" type="tel" name="phone" value="<?php echo (Customer::adminLoggedIn()) ? '' : $tel_mobile ?>" placeholder="Telephone" />
                        </div>
                        <div class="details__wrap--required">* Required fields</div>

                        <div class="details__wrap__marketing">
                            <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle my-account-form__input-wrap--marketing-prefs">
                                <label class="my-account-form__label my-account-form__label--toggle details__wrap__marketing--text" for="marketing-opt-in"><span class="details__wrap__marketing--title">Can we stay in touch?</span><br />
                                    We'd occasionally like to contact you via email with relevant information on products and promotions. Please see our <a href="/policies/terms">Terms</a> for more details of how contact you and use your data.</label>
                                <label class="my-account-form__switch">
                                    <input id="marketing-opt-in" class="my-account-form__slide-checkbox" type="checkbox" name="marketing-opt-in" <?php if ($marketing == 1) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?> />
                                    <span class="my-account-form__slider my-account-form__slider--round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="details__wrap__auto">
                            <div class="details__wrap__auto--text">
                                <span class="details__wrap__auto--title">Auto Registering your guarantee</span><br>
                                For your convenience we automatically register your guarantee, this will be emailed as a PDF once your order has been delivered. Discover more about our guarantees <a href="/support/guarantee/">here</a>, (takes you away from this page).
                                </span>
                            </div>
                        </div>
                        <h2 class="details__wrap__h2">Delivery Address <span class="details__wrap__h2--small">(UK mainland only)</span></h2>
                        <?php if (Customer::loggedIn()) { ?>
                            <div class="my-account-form__input-wrap">
                                <select class="my-account-form__input required" id="delivery_addresses" name="delivery_addresses">
                                    <option value="new">Select a saved address...</option>
                                    <?php if (!empty($addresses)) { ?>
                                        <?php foreach ($addresses as $address) { ?>
                                            <option <?php if (Order::data('delivery_addresses') == $address['id']) {
                                                        echo 'selected';
                                                    } ?> value="<?php echo $address['id']; ?>" data-address1="<?php echo $address['address1']; ?>" data-address2="<?php echo $address['address2']; ?>" data-city="<?php echo $address['city']; ?>" data-postcode="<?php echo $address['postcode']; ?>"><?php echo $address['nickname']; ?>: <?php echo $address['address1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['postcode']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    <option value="new">Use a new address</option>
                                </select>
                            </div>
                        <?php } ?>
                        <div id="delivery_address">
                            <div id="shipping_lookup" style="margin-bottom: 2rem;"></div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="address1"><span class="details__wrap--required">*</span>Address:</label>
                                <input tabindex="5" class="my-account-form__input required" type="text" id="address1" name="address1" value="<?php echo Order::data('address1'); ?>" placeholder="Address line one">
                            </div>
                            <div class="my-account-form__input-wrap">
                                <input tabindex="6" class="my-account-form__input required" type="text" id="address2" name="address2" value="<?php echo Order::data('address2'); ?>" placeholder="Address line two">
                            </div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="city"><span class="details__wrap--required">*</span>Town / City:</label>
                                <input tabindex="7" class="my-account-form__input required" type="text" id="city" name="city" value="<?php echo Order::data('city'); ?>" placeholder="Town / City">
                            </div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="postcode"><span class="details__wrap--required">*</span>Postcode:</label>
                                <input tabindex="8" class="my-account-form__input required" type="text" id="postcode" name="postcode" value="<?php echo Order::data('postcode'); ?>" placeholder="Postcode">
                            </div>

                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="instructions">Additional delivery instructions:</label>
                                <textarea tabindex="9" class="my-account-form__input my-account-form--textarea" id="instructions" name="instructions" tabindex="5" placeholder="e.g. Please use my side door."><?php echo Order::data('instructions'); ?></textarea>
                            </div>

                            <div class="details__wrap--required">* Required fields</div>
                        </div>

                        <h2 class="details__wrap__h2">Billing Address <span class="details__wrap__h2--small">(UK mainland only)</span></h2>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">
                                <input id="billing_checkbox" type="checkbox" name="use_delivery" value="1" checked>Use my delivery address
                            </label>
                        </div>
                        <div id="billing_address">
                            <?php if (Customer::loggedIn()) { ?>
                                <div class="my-account-form__input-wrap">
                                    <select class="my-account-form__input required" id="billing_addresses" name="billing_addresses">
                                        <option value="new">- Select address -</option>
                                        <?php if (!empty($addresses)) { ?>
                                            <?php foreach ($addresses as $address) { ?>
                                                <option <?php if (Order::data('billing_addresses') == $address['id']) {
                                                            echo 'selected';
                                                        } ?> value="<?php echo $address['id']; ?>" data-address1="<?php echo $address['address1']; ?>" data-address2="<?php echo $address['address2']; ?>" data-city="<?php echo $address['city']; ?>" data-postcode="<?php echo $address['postcode']; ?>"><?php echo $address['nickname']; ?>, <?php echo $address['address1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['postcode']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        <option value="new">New address</option>
                                    </select>
                                </div>
                            <?php } ?>
                            <div class="my-account-form__input-wrap" id="billing_lookup"></div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="billing-address1"><span class="details__wrap--required">*</span>Address:</label>
                                <input tabindex="10" class="my-account-form__input required" type="text" id="billing-address1" name="billing-address1" value="<?php echo Order::data('billing-address1'); ?>" placeholder="Address line one" />
                            </div>
                            <div class="my-account-form__input-wrap">
                                <input tabindex="11" class="my-account-form__input required" type="text" id="billing-address2" name="billing-address2" value="<?php echo Order::data('billing-address2'); ?>" placeholder="Address line two" />
                            </div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="billing-city"><span class="details__wrap--required">*</span>Town / City:</label>
                                <input tabindex="12" class="my-account-form__input required" type="text" id="billing-city" name="billing-city" value="<?php echo Order::data('billing-city'); ?>" placeholder="Town / City" />
                            </div>
                            <div class="my-account-form__input-wrap">
                                <label class="my-account-form__label" for="billing-postcode"><span class="details__wrap--required">*</span>Postcode:</label>
                                <input tabindex="13" class="my-account-form__input required" type="text" id="billing-postcode" name="billing-postcode" value="<?php echo Order::data('billing-postcode'); ?>" placeholder="Postcode" />
                            </div>
                            <div class="details__wrap--required">* Required fields</div>
                        </div>

                        <h2 class="details__wrap__h2">Your Delivery Options</h2>

                        <?php // if ($product['product_category'] == '3') { 
                        ?>
                        <!-- <p class="my-account-form__delivery-note">Made to order, ready for despatch in 4 to 6 weeks</p> -->

                        <?php // } else { 
                        ?>
                        <p class="my-account-form__delivery-note">Order now and get it by <?= date('l jS F', strtotime(Dates::deliveryDate())) ?> or select an alternative date below.</p>
                        <?php // } 
                        ?>

                        <p class="my-account-form__delivery-note" style="color: #f15856; font-size:1.4rem">Please note that Saturday delivery is charged at £<?= $sat_delivery_rate ?> and is only available to mainland UK postcodes. Check our <a style="color: #f15856; border: none; font-weight: 600;" href="/policies/delivery/">delivery page</a> to view which postcodes are eligible for Saturday delivery. All other delivery is free of charge.</p>

                        <div class="my-account-form__input-wrap">
                            <?php
                            if (!empty($_SESSION['order']['delivery_date'])) {
                                $delivery_date = $_SESSION['order']['delivery_date'];
                            } else {
                                $delivery_date = date('d/m/Y', strtotime(Dates::deliveryDate()));
                            }
                            ?>
                            <input class="my-account-form__input" id="date-picker" name="delivery_date" value="<?= $delivery_date ?>" placeholder="Please select a date (not required for Sofas and Sofa beds)">

                            <input type="hidden" class="my-account-form__input" id="delivery_date_copy">

                            <a id="" class="btn my-account__button my-account__button--margin-top clear_delivery_date">Select earliest available date</a>

                            <p style="font-size:11px;margin-top:10px;">Please note: Our sofas, sofa beds and footstool are made to order, so there is no need to select a date above. A member of our sales team will contact you to arrange a delivery date once your item as been manufactured. We are currently quoting 4 to 6 weeks.</p>
                        </div>


                        <script>
                            
                        </script>

                        <div class="details--button">
                            <button class="my-account__button my-account__button--margin-top">Continue to payment</button>
                        </div>
                    </div>

                    <div id="order_summary">
                        <?php include('../../_/inc/partials/summary.php'); ?>
                    </div>
                </div>
            </form>

            <a href="" class="details__return-link">Return to basket</a>
        </div>
    </section>
</main>

<?php //if (!Customer::loggedIn() && !isset($_SESSION['cart_guest'])) { 
?>
<?php if (!Customer::loggedIn()) { ?>
    <div id="login_modal" class="details_modal">

        <div class="details_modal__wrap">
            <div id="modal_default" class="details_modal__wrap__default">

                <a id="" class="details-modal__close-link close">
                    <svg class="details-modal__close-icon" aria-hidden="true" viewBox="0 0 100 100">
                        <use xlink:href="<?= $svg_sprite_url ?>#icon-close"></use>
                    </svg>
                </a>

                <h1 class="details_modal__wrap__h1">Sign In</h1>
                <label class="details_modal__wrap--label">Already have an account?</label>
                <div class="details_modal__wrap--sign_in login">Sign into Jay-Be.com</div>
                <label class="details_modal__wrap--label">New to Jay-Be.com?</label>
                <div class="details_modal__wrap--guest close">Continue as a Guest</div>
                <p class="details_modal__wrap--create">You can create an account during checkout!</p>
            </div>

            <div id="modal_login" class="details_modal__wrap__login">

                <a id="" class="details-modal__close-link close">
                    <svg class="details-modal__close-icon" aria-hidden="true" viewBox="0 0 100 100">
                        <use xlink:href="<?= $svg_sprite_url ?>#icon-close"></use>
                    </svg>
                </a>

                <form id="login_form">
                    <h1 class="details_modal__wrap__h1">Sign In</h1>
                    <label class="details_modal__wrap--label">Email Address:</label>
                    <input class="details_modal__wrap--input" type="email" id="email" name="email" placeholder="email@domain.com" value="" />
                    <label class="details_modal__wrap--label">Password:</label>
                    <input class="details_modal__wrap--input" type="password" id="password" name="password" />
                    <button class="details_modal__wrap--sign_in" type="submit">Sign into Jay-Be.com</button>
                </form>
                <div class="details_modal__wrap__password">
                    <p class="details_modal__wrap__password--link password-link">Forgotten password?</p>
                </div>
            </div>

            <div id="modal_password" class="details_modal__wrap__login">

                <a id="" class="details-modal__close-link close">
                    <svg class="details-modal__close-icon" aria-hidden="true" viewBox="0 0 100 100">
                        <use xlink:href="<?= $svg_sprite_url ?>#icon-close"></use>
                    </svg>
                </a>

                <form id="password_form">
                    <h1 class="details_modal__wrap__h1">Forgotten Password</h1>
                    <label class="details_modal__wrap--label">Email Address:</label>
                    <input class="details_modal__wrap--input" id="forgot_email" type="email" name="email" placeholder="email@domain.com" value="" />
                    <button class="details_modal__wrap--sign_in" type="submit">Reset Password</button>
                </form>
            </div>
        </div>

    </div>
<?php } ?>
<?php include("../../_/inc/footer.inc.php"); ?>