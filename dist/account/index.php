<?php
$siteCat = 'customer-care';
$currentPage = 'account';
$accountSection = 'login';
$pageTitle = 'Sign in to your Jay-Be account';
$metaDes = 'Sign in to your Jay-Be account';
$javascript = ['login_page'];
include($_SERVER['DOCUMENT_ROOT'] . "/_/inc/header.inc.php"); ?>

<main role="main" id="main-content" class="">
    <section class="row my-account my-account--no-head">
        <div class="my-account-login-container">
            <div class="my-account-login">
    
                <h1 class="my-account-login__h1">Sign in to your account</h1>

                <form method="POST" action="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']); ?>" id="login_form">
                    <input type="hidden" name="_token" value="ihFBSeL1bvre2PCP92E7gbJIgR3jeylyCixm0E7N">
                    
                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left">
                        <input id="email" class="my-account-login__input " type="email" name="email" value="<?php if (isset($_COOKIE['remember'])) { echo $_COOKIE['remember']; } ?>" placeholder="email@domain.com" required autocomplete="email" autofocus>
                    </div>

                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left">
                        <input id="password" class="my-account-login__input " type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                    </div>

                    <div class="my-account-login__input-wrap">
                        <button id="submit-login" class="my-account-login__button" type="submit" name="submit">Sign In</button>
                    </div>

                    <div class="my-account-login__input-wrap my-account-login__input-wrap--left my-account-login__input-wrap--checkbox">
                        <label class="my-account-login__label">Remember me
                            <input class="my-account-login__checkbox" name="remember" type="checkbox" value="1" id="remember" />
                            <span class="my-account-login__faux-checkbox"></span>
                        </label>
                        <a class="my-account-login__link" href="/account/forgot-password">Forgot password</a>
                    </div>
                </form>

                <!-- <span class="my-account-login__register">Don't have an account with us? <a class="my-account-login__register--link" href="/account/register-account">Register</a></span> -->
            </div>
        </div>
    </section>
</main>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/_/inc/footer.inc.php"); ?> ?>