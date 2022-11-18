<?php

$currentPage = 'account';
$accountSection = 'login';
$pageTitle = 'Forgot Password';
$metaDes = 'Forgot Password';
$javascript = ['forgot_password_page'];

include("../../_/inc/header.inc.php");

?>
<main role="main" id="main-content" class="">
    <section class="row my-account my-account--no-head">
        <div class="my-account-login-container">
            <div class="my-account-login">
                <h1 class="my-account-login__h1">Forgot Password</h1>
                <form method="POST" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>" id="password_form">
                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left">
                        <input id="forgot_email" class="my-account-login__input " type="email" name="email" value="" placeholder="email@domain.com" required autocomplete="email" autofocus />
                    </div>

                    <div class="my-account-login__input-wrap">
                        <button id="submit-login" class="my-account-login__button" type="submit" name="submit">Submit</button>
                    </div>
                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left my-account-login__input-wrap--checkbox">
                    </div>
                    <input type="hidden" name="action" value="forgotPassword" />
                </form>
            </div><!-- my-account-login -->
            <!-- <span class="my-account-login__copyright">&copy;<?php echo date('Y'); ?>  Jay-Be Limited</span> -->
        </div><!-- login-container -->
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>

