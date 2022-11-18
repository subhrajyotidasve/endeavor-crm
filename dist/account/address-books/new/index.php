<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}

$currentPage = 'account';
$accountSection = 'address';
$accountTitle = 'Address Book';
$pageTitle = 'Add a new address book';
$metaDes = 'Add a new address book';

include("../../../_/inc/header.inc.php");

?>
<main role="main" id="main-content" class="customer-admin">
    <section class="row my-account">
        <?php include("../../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
			<ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/address-book">Address Book</a></li>
                <li class="my-account-breadcrumb__list-item">Add New</li>
			</ul>
		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <section class="my-account-form">
                <form class="my-account-form__form" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>" method="post" id="profile-edit" name="profile-edit">
                    <fieldset class="my-account-form__set">
                        <legend class="my-account-form__legend">Edit your profile</legend>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">Nickname:</label>
                            <input class="my-account-form__input required" type="text" tabindex="1" name="nickname" placeholder="e.g. My House or Parents House">
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">First Name:</label>
                            <input class="my-account-form__input required" type="text" tabindex="2" name="first_name" placeholder="First Name">
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">Last Name:</label>
                            <input class="my-account-form__input required" type="text" tabindex="3" name="last_name" placeholder="Last Name">
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">Address Line 1:</label>
                            <input id="address1" class="my-account-form__input required" type="text" tabindex="4" name="address1" placeholder="Address Line 1">

                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">Address Line 2:</label>
                            <input id="address2" class="my-account-form__input" type="text" tabindex="5" name="address2" placeholder="Address Line 2">
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">County / City:</label>
                            <input id="city" class="my-account-form__input required" type="text" tabindex="6" name="city" placeholder="County / City">
                        </div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label">Postcode:</label>
                            <input id="postcode" class="my-account-form__input required" type="text" tabindex="7" name="postcode" placeholder="Postcode">
                        </div>
                    </fieldset>
                    <button name="submit" class="my-account__button my-account__button--margin-top" type="submit">Add Address</button>
                    <input type="hidden" name="action" value="addAddress" />
                </form>
            </section><!-- my-account-form -->
        </div><!-- my-account-grid-wrap -->
		<?php include("../../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../../_/inc/footer.inc.php"); ?>