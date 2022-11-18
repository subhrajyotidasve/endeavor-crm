<?php
$siteCat = 'customer-care';
$currentPage = 'account';
$accountSection = 'register';
$pageTitle = 'Create a Jay-Be account';
$metaDes = 'Create a Jay-Be account';
include("../../_/inc/header.inc.php"); 

?>
<main role="main" id="main-content" class="customer-admin">

    <section class="row my-account">

        <header class="my-account-head">
			<h1 class="my-account-head__h1">Register with us</h1>
		</header>


        <section class="my-account-form">
            <?php if (Session::getFlash('account_registered')) { ?>
                <P>Thank you for registering an account with us.</P>
                <p>Please <a href="/account">click here</a> to login to your account.</p>
            <?php } else { ?>
            <form class="my-account-form__form" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>" method="post" id="register-account" name="register-account" autocomplete="off">

                <fieldset class="my-account-form__set">

                    <legend class="my-account-form__legend">Register your details</legend>

                    <div class="my-account-form__side-by-side">
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="firstname">First Name:</label>
                            <input class="my-account-form__input required" type="text" tabindex="1" name="first_name" placeholder="First Name" value="<?php if (isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>" />
                        </div>

                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="lastname">Last Name:</label>
                            <input class="my-account-form__input required" type="text" tabindex="2" name="last_name" placeholder="Last Name" value="<?php if (isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>">
                        </div>
                    
                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="tel">Telephone No:</label>
                            <input class="my-account-form__input required" type="tel" tabindex="3" name="tel_mobile" placeholder="Telephone" value="<?php if (isset($_POST['tel_mobile'])) { echo $_POST['tel_mobile']; } ?>">
                        </div>

                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="email">Email Address:</label>
                            <input class="my-account-form__input required email" type="email" tabindex="4" name="email" placeholder="email@domain.com" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>">
                            <?php
                                if (Session::getFlash('alert_email_exists')) {?>
                                    <label id="email-error" class="error" for="email">Email already exists.</label>
                                <?php }
                            ?>
                        </div>

                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="password">Password:</label>
                            <input class="my-account-form__input required" type="password" tabindex="5" name="password">
                            <br/>
                            <small class="my-account__copy my-account__copy--small my-account__copy--emphasise my-account__copy--no-bottom-padding my-account__copy--margin-top"id="password-invalid" class="error" for="password">Password must have a minimum of eight characters, at least one uppercase letter, one lowercase letter and one number.</small>
                                
                        </div>

                        <div class="my-account-form__input-wrap">
                            <label class="my-account-form__label" for="confirm_password">Confirm Password:</label>
                            <input class="my-account-form__input required" type="password" tabindex="6" name="confirm_password">
                            <?php if (Session::getFlash('password_not_matching')) { ?>
                                <label id="password-error" class="error" for="confirm_password">Passwords do not match.</label>
                            <?php } ?>
                        </div>
                    </div>

                    <p class="my-account__copy my-account__copy--small my-account__copy--emphasise my-account__copy--no-bottom-padding my-account__copy--margin-top">All fields are required.</p>

                </fieldset>


                <fieldset class="my-account-form__set my-account-form__set--prefs">

                    <legend class="my-account-form__legend">Marketing Preferences</legend>

                        <p class="my-account-form__copy">Be the first to receive priority information on relevant products and promotions. For details of how we handle your data please see our <a class="my-account-form__copy--link" href="/policies/privacy/">Privacy Policy.</a> Please note, you can change this preference at any time.</p>

                        <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle">
                            <label class="my-account-form__label my-account-form__label--toggle" for="marketing">Yes, I would like to receive priority information on<br>relevant products and promotions from Jay-Be.</label>
                            <label class="my-account-form__switch">
                                <input class="my-account-form__slide-checkbox" type="checkbox" name="marketing" id="marrketing" onclick="$('#accept-marketing').prop('checked', $('#marketing').prop('checked'))">
                                <span class="my-account-form__slider my-account-form__slider--round"></span>
                            </label><input class="my-account-form__slide-checkbox" type="checkbox" id="accept-marketing" name="accept-marketing">
                        </div>

                        <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle">
                            <label class="my-account-form__label my-account-form__label--toggle" for="accept-terms">By creating an account you agree to the website<br><a class="my-account-form__label--link" href="/terms">terms and conditions</a> and our <a class="my-account-form__label--link" href="/policies/privacy/">privacy policy.</a></label>
                            <label class="my-account-form__switch">
                                <input class="my-account-form__slide-checkbox" type="checkbox" name="terms" id="terms" onclick="$('#accept-terms').prop('checked', $('#terms').prop('checked'))">
                                <span class="my-account-form__slider my-account-form__slider--round"></span>
                            </label><input class="my-account-form__slide-checkbox" type="checkbox" id="accept-terms" name="accept-terms" required>
                        </div>

                </fieldset>

                <button class="my-account__button" type="submit" name="submit">Register Account</button>
                <input type="hidden" name="action" value="registerAccount" />
            </form>
        <?php } ?>
        </section><!-- my-account-form -->
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>
