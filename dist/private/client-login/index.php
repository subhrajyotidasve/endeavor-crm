<?php
$currentPage = 'client';
$pageTitle = 'Client Login, download the latest Jay-Be&reg; marketing assets';
$metaDes = 'Client Login, download the latest Jay-Be&reg; marketing assets';
include("../../_/inc/header.inc.php"); ?>

    <div class="outer-wrap outer-wrap--btm-margin banner banner--client">
        <h1 class="banner__h1">Client Login</h1>
    </div>

    <main role="main" id="main-content">

        <section class="row banner-intro">
            <h2 class="banner-intro__h2">The Jay-Be<sup>&reg;</sup> Client Login</h2>
            <p class="banner-intro__copy">Welcome to the Jay-Be Client Login. Please log in to download our very latest images, videos and product specifications. If you would like to become a Jay-Be stockist please <a href="mailto:alisonfeatherston@jaybe.com?subject=I would like to become a Jay-Be stockist">contact us.</a></p>
        </section>


        <section class="row form">

            <form name="login-form" id="login-form" method="post" action="/private/admin/authenticate.php">

                <fieldset class="form__set">

                    <div class="form__legend-wrap">
                        <svg role="presentation" class="form__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-key"></use></svg>
                        <legend class="form__legend">Enter your Stockist Login</legend>
                    </div>

                    <div class="form__flex-container">

                        <div class="form__input-wrap">
                            <label class="form__label" for="username">Email:</label>
                            <input class="form__input" type="text" name="email" tabindex="1" id="email" placeholder="Your Email">
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
