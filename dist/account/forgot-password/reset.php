<?php

$currentPage = 'account';
$accountSection = 'reset';
$pageTitle = 'Reset your Jay-Be password';
$metaDes = 'Reset your Jay-Be password';

include("../../_/inc/header.inc.php");

Customer::resetPassword();

?>
<main role="main" id="main-content" class="customer-admin">

    <section class="row my-account my-account--no-head">
        <div class="my-account-login-container">
            <div class="my-account-login">

                <svg aria-hidden="true" class="my-account-login__logo" viewBox="0 0 100 45">
                    <title>Jay-Be Limited</title>
                    <use xlink:href="<?=$svg_sprite_url?>#icon-logo"></use>
                </svg>
    
                <?php if (Session::getFlash('invalid')) { ?>
                    <p>The link you have clicked is invalid.</p>
                <?php } else if (Session::getFlash('password_reset')) { ?>
                    <p>You have successfully reset your password. <a href="/account">Click here</a> to login.</p>
                <?php } else { ?>
                <h1 class="my-account-login__h1">Reset your password</h1>

                <form method="POST" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>">
                    
                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left">
                        <input id="password" class="my-account-login__input " type="password" name="password" placeholder="Enter password" required autofocus>
                    </div>

                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left">
                        <input id="confirm_password" class="my-account-login__input " type="password" name="confirm_password" placeholder="Confirm password" required>
                    </div>


                    <div class="my-account-login__input-wrap">
                        <small class="my-account__copy my-account__copy--small my-account__copy--emphasise my-account__copy--no-bottom-padding my-account__copy--margin-top"id="password-invalid" class="error" for="password">Password must have a minimum of eight characters, at least one uppercase letter, one lowercase letter and one number.</small>
                    </div>

                    <div class="my-account-login__input-wrap">

                        <?php if (Session::getFlash('password_not_matching')) { ?>
                            <label style="float:left;font-style:italic;color:#007bfc">Passwords do not match</label>
                        <?php } ?>

                        <button class="my-account-login__button" type="submit" name="submit">Reset password</button>
                    </div>

                    <input type="hidden" name="token" value="<?php echo $_REQUEST['token']; ?>" />
                </form>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php include("../../_/inc/footer.inc.php"); ?>
