<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'register';
$accountTitle = 'Register a Product';
$pageTitle = 'Edit your Jay-Be profile';
$metaDes = 'Edit your Jay-Be profile';

include("../../_/inc/header.inc.php");

?>
<main role="main" id="main-content" class="customer-admin">
    <section  class="row my-account">
        <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
			<ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item">Register Guarantee</li>
			</ul>
		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <section class="my-account-form">
                <form class="my-account-form__form" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>" id="register-product" method="POST">

					<fieldset class="my-account-form__set">

						<legend class="my-account-form__legend">Your details</legend>

						<div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="firstname">First Name:</label>
							<input class="my-account-form__input required" type="text" tabindex="1" name="firstname" placeholder="First Name" value="<?= isset($_SESSION['customer']['first_name']) ? $_SESSION['customer']['first_name'] : '' ?>">
						</div>
						<div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="lastname">Last Name:</label>
							<input class="my-account-form__input required" type="text" tabindex="2" name="lastname" placeholder="Last Name" value="<?= isset($_SESSION['customer']['last_name']) ? $_SESSION['customer']['last_name'] : '' ?>">
						</div>
                        <div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="email">Email Address:</label>
							<input class="my-account-form__input required email" type="email" tabindex="3" name="email" placeholder="john@google.com" value="<?= isset($_SESSION['customer']['email']) ? $_SESSION['customer']['email'] : '' ?>">
						</div>
					</fieldset>
                    <fieldset class="my-account-form__set">
						<legend class="my-account-form__legend">About your product</legend>
						<div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="product">Product:</label>
							<input class="my-account-form__input required" type="text" tabindex="4" name="product" placeholder="e.g. Jubilee e-Fibre Single">
						</div>
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="quantity">Quantity:</label>
                            <input class="my-account-form__input required" type="number" tabindex="4" name="quantity">
                        </div>
                        <div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="retailer">Retailer:</label>
							<input class="my-account-form__input required" type="text" tabindex="5" name="retailer" placeholder="e.g. Argos, Amazon, John Lewis">
						</div>
                        <div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="date">Date of Purchase:</label>
							<input class="my-account-form__input required" type="date" tabindex="6" name="date" placeholder="Please be accurate">
						</div>
                        <div class="my-account-form__input-wrap">
							<label class="my-account-form__label" for="amount">Amount Paid:</label>
							<input class="my-account-form__input required" type="text" tabindex="7" name="amount" placeholder="Please be as accurate as possible">
							<?php if(isset($amount_error)) { ?>
								<small style="color:red"> <?= $amount_error ?></small>
							<?php 
							unset($amount_error);
							} ?>
						</div>
					</fieldset>
                    <button class="my-account__button my-account__button--margin-top" type="submit" name="submit">Register Guarantee</button>
                    <p class="my-account__copy my-account__copy--small my-account__copy--shorten my-account__copy--emphasise my-account__copy--no-bottom-padding my-account__copy--lge-margin-top">Please hold on to your receipt as a legitimate proof of purchase. Not having your receipt may invalidate your guarantee.</p>

					<div id="my-account__alert" class="my-account__alert" style="display:none">
						<p class="my-account__alert-copy">Thanks for registering your product with us.<br>An email confirming this should now be in your inbox.</p>
					</div>
					<input type="hidden" name="action" value="registerProduct" />
				</form>
			</section><!-- my-account-form -->
        </div><!-- my-account-grid-wrap -->
		<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>