<?php
$currentPage = 'commercial';
$pageTitle = 'Commercial resources, download our latest brochure, price list and other commercial resources';
$metaDes = 'Commercial resources, download our latest brochure, price list and other commercial resources';
include("../../_/inc/header.inc.php"); ?>

    <div class="outer-wrap outer-wrap--btm-margin banner banner--commercial">
        <h1 class="banner__h1">Commercial<br>Resources</h1>
    </div>

    <main role="main" id="main-content">

        <section class="row banner-intro">
            <h2 class="banner-intro__h2">The Jay-Be<sup>&reg;</sup> Commercial <span class="banner-intro__h2--rwd-break">Resources Login</span></h2>
            <p class="banner-intro__copy">Welcome to the Jay-Be<sup>&reg;</sup> Commercial Resources Login. Please log in to download our very latest brochure, price list and other commercial resources.</p>
        </section>


        <section class="row form">

            <form name="login-form" id="login-form" method="post" action="/private/admin/authenticate.php">

                <fieldset class="form__set">

                    <div class="form__legend-wrap">
                        <svg role="presentation" class="form__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-key"></use></svg>
                        <legend class="form__legend">Enter your Commercial Login</legend>
                    </div>

                    <div class="form__flex-container">

                        <div class="form__input-wrap">
                            <label class="form__label" for="username">Username:</label>
                            <input class="form__input" type="text" name="username" tabindex="1" id="username" placeholder="Your Username">
                        </div>

                        <div class="form__input-wrap">
                            <label class="form__label" for="password">Password:</label>
                            <input class="form__input" type="password" name="password" tabindex="2" id="password" placeholder="Your Password">
                        </div>

                    </div>

                </fieldset>


                <div class="form__submission">
                    <button id="login" class="form__button" type="submit">Log Me In!</button>
                </div>

                <div id="message" class="form__errors"></div>

            </form>

        </section>

        <?php include("../../_/inc/client-login/client-info.inc.php"); ?>

    </main>

<?php include("../../_/inc/footer.inc.php"); ?>
