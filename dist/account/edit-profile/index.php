<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

$currentPage = 'account';
$accountSection = 'profile';
$accountTitle = 'Edit Profile';
$pageTitle = 'Edit your Jay-Be profile';
$metaDes = 'Edit your Jay-Be profile';


if(isset($_SESSION['update_code'])) {
	if($_SESSION['update_code'] == '200') {

		$success_msg = $_SESSION['update_response'];
	} elseif($_SESSION['update_code'] == '400') {
		$error_msg = $_SESSION['update_response'];

	}
	unset($_SESSION['update_code']);
	unset($_SESSION['update_response']);
}

include("../../_/inc/header.inc.php");

$profile = Customer::getProfile();

?>
    <main role="main" id="main-content" class="customer-admin">
        <section class="row my-account">
            <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
            <nav class="my-account-breadcrumb">
				<ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item">Edit Profile</li>
				</ul>
			</nav>
            <div class="my-account-grid-wrap">
                <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
                <section class="my-account-form">
					<form class="my-account-form__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<fieldset class="my-account-form__set">
							<legend class="my-account-form__legend">Edit your profile</legend>
							<div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="firstname">First Name:</label>
								<input class="my-account-form__input" type="text" tabindex="1" name="first_name" value="<?php echo $profile['first_name'] ?>">
							</div>
							<div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="lastname">Last Name:</label>
								<input class="my-account-form__input" type="text" tabindex="2" name="last_name" value="<?php echo $profile['last_name'] ?>">
							</div>
                            <div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="tel">Telephone No:</label>
								<input class="my-account-form__input" type="tel" tabindex="3" name="tel_mobile" value="<?php echo $profile['tel_mobile'] ?>">
							</div>
                            <div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="email">Email Address:</label>
								<input class="my-account-form__input" type="email" tabindex="4" name="email" value="<?php echo $profile['email'] ?>">
							</div>
                            <a class="my-account-form__reveal-link">Change Password?</a>
						</fieldset>
                        <fieldset class="my-account-form__set my-account-form__set--password">
                            <legend class="my-account-form__legend">Edit your password</legend>
                            <div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="password">New Password:</label>
								<input class="my-account-form__input" type="password" tabindex="5" name="password">
							</div>
                            <div class="my-account-form__input-wrap">
								<label class="my-account-form__label" for="password">Confirm Password:</label>
								<input class="my-account-form__input" type="password" tabindex="6" name="confirm_password">
							</div>
                        </fieldset>
						<?php if(isset($success_msg)) { ?>
							<label style="font-style:italic;color:#007bfc"><?= $success_msg ?></label>
							<?php unset($success_msg) ?>
							<?php unset($error_msg) ?>
						<?php } elseif(isset($error_msg)) { ?>
							<label style="font-style:italic;color:#007bfc"><?= $error_msg ?></label>
							<?php unset($error_msg) ?>
							<?php unset($success_msg) ?>
						<?php } ?>
                        <button class="my-account__button my-account__button--margin-top" type="submit" name="submit">Save Changes</button>
                        <input type="hidden" name="action" value="updateProfile" />
					</form>
				</section><!-- my-account-form -->
            </div><!-- my-account-grid-wrap -->
			<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
        </section><!-- my-account -->
    </main>
<?php include("../../_/inc/footer.inc.php"); ?>