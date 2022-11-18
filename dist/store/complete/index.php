<?php
$currentPage = 'cart';
$pageType = 'complete';
$corona = 'corona';
$pageTitle = 'Jay-Be&reg; Sleep Smart Products - Order complete';
$metaDes = 'Jay-Be&reg; Sleep Smart Products - Order complete';
$javascript = [];

include("../../_/inc/header.inc.php");

if (Customer::loggedIn()) {

    // $javascript[] = 'newsletter_page';
} else {

    $javascript[] = 'create_order_account';
}

$javascript[] = 'cart_complete';
?>
<main role="main" id="main-content" class="customer-admin">
    <section class="outer-wrap details">
        <div class="row row--narrow row--no-bottom-margin row--vpadding-max">
            <header class="details__header">
                <img class="details__header__image" src="/_/img/ecomm/checkout/opayo.svg" alt="Opayo" />
                <h1 class="details__header__h1">Thank you!</h1>
            </header>

            <div class="details__wrap">
                <div>
                    <div class="details__wrap__number">
                        Order Number: <?php echo 'JB0000' . $_SESSION['order']['order_number']; ?>
                    </div>
                    <div class="details__wrap__thanks">
                        Hi <?php echo $_SESSION['order']['first_name']; ?>, thank you, your order has been successfully received. Please check your email for confirmation of your order. Once your order has been delivered you will be emailed an invoice and proof of your guarantee.
                    </div>

                    <?php
                    if (!Customer::loggedIn()) {
                    ?>
                        <form class="my-account-form__form" id="createOrderAccount">
                            <div class="details__wrap__auto">
                                <div class="details__wrap__auto--text">
                                    <span class="details__wrap__auto--title">Create a Jay-Be account</span><br>
                                    Having a Jay-Be account makes it faster to checkout in the future, allows you to manage your address books, guarantees, marketing preferences and more.
                                </div>
                            </div>
                            <div class="details__wrap__register">
                                <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle my-account-form__input-wrap--marketing-prefs">
                                    <label class="my-account-form__label my-account-form__label--toggle details__wrap__terms--text" for="create_account">Yes I would like to create a Jay-Be account
                                    </label>
                                    <label class="my-account-form__switch">
                                        <input class="my-account-form__slide-checkbox" type="checkbox" name="create_account" id="create_account" />
                                        <span class="my-account-form__slider my-account-form__slider--round"></span>
                                    </label>
                                </div>
                            </div>
                            <div id="create_account_wrap">
                                <div class="my-account-form__input-wrap">
                                    <label class="my-account-form__label"><span>*</span>Create a Password:</label>
                                    <input class="my-account-form__input required" id="password" type="password" name="password" value="" />
                                </div>
                                <div class="my-account-form__input-wrap">
                                    <label class="my-account-form__label"><span>*</span>Confirm Password:</label>
                                    <input class="my-account-form__input required" type="password" name="confirm_password" id="confirm_password" value="" />
                                </div>
                                <small class="my-account__copy my-account__copy--small my-account__copy--emphasise my-account__copy--no-bottom-padding my-account__copy--margin-top" id="password-invalid" class="error" for="password">Password must have a minimum of eight characters, at least one uppercase letter, one lowercase letter and one number.</small>
                                <div class="my-account-form__input-wrap">
                                    <button class="my-account__button my-account__button--margin-top" type="submit">Create Account</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>

                </div>
            </div>
            <a href="/" class="details__return-link">Return to Home page</a>
        </div>
    </section>
</main>
<?php include("../../_/inc/footer.inc.php"); ?>