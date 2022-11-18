<?php
$currentPage = '404';
$pageTitle = '404 Error Loading Page';
$metaDes = '404 Error Loading Page';
$metaNoIndex = true;
include("_/inc/header.inc.php"); ?>

    <div class="outer-wrap outer-wrap--btm-margin banner banner--404">
        <h1 class="banner__h1">Sorry!</h1>
    </div>

    <main role="main" id="main-content">

        <section class="row banner-intro">
            <h2 class="banner-intro__h2">Oops! there has been an error</h2>
            <p class="banner-intro__copy">The page you were expecting to see is either not loading or is no longer available. If it once existed here then it may have been moved, renamed or deleted. If you typed the address (URL), be sure to check your spelling!</p>

            <p class="banner-intro__copy">If you can't find what you're looking for, please <a href="/support/contact">contact</a> our customer care team and we'll do our best to help you. Alternatively, you could try refreshing your web browser or just return to our <a href="/">home page.</a></p>
        </section>

    </main>

<?php include("_/inc/footer.inc.php"); ?>
