<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'dashboard';
$accountTitle = 'Dashboard';
$pageTitle = 'Manage your account';
$metaDes = 'Manage your account';

$currentPage = 'account';
$accountTitle = 'My Account';
$pageTitle = 'Welcome to the Jay-Be dashboard';
$metaDes = 'Welcome to the Jay-Be dashboard';

include("../../_/inc/header.inc.php");

?>
    <main role="main" id="main-content" class="customer-admin">
        <section class="row my-account">
            <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
            <section class="my-account-panel">

                <ul class="my-account-panel__list">

                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/edit-profile" aria-label="Edit your profile">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-profile"></use>
                            </svg>
                            Edit Profile
                        </a>
                    </li>
                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/address-books" aria-label="Edit your addresses">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-address"></use>
                            </svg>
                            Address Book
                        </a>
                    </li>
                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/order-history" aria-label="View your order history">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-order"></use>
                            </svg>
                            Order History
                        </a>
                    </li>
                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/register-product" aria-label="Register your Jay-Be product">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-register"></use>
                            </svg>
                            Register Guarantee
                        </a>
                    </li>
                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/wishlist" aria-label="Manage your wishlist">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-wishlist"></use>
                            </svg>
                            Wishlist
                        </a>
                    </li>
                    <li class="my-account-panel__list-item">
                        <a class="my-account-panel__link" href="/account/marketing" aria-label="Your marketing preferences">
                            <svg aria-hidden="true" class="my-account-panel__icon" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-ca-marketing"></use>
                            </svg>
                            Marketing
                        </a>
                    </li>
                </ul>
            </section><!-- my-account-panel -->
            <?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
        </section><!-- my-account -->
    </main>
<?php include("../../_/inc/footer.inc.php"); ?>