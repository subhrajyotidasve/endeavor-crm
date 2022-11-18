<?php
$currentPage = 'careers';
$isCaptcha = true;
$pageTitle = 'Work with us at Jay-Be&reg; submit your application form';
$metaDes = 'Work with us at Jay-Be&reg; submit your application form';
include("../../_/inc/header.inc.php");
?>

    <div class="outer-wrap outer-wrap--btm-margin banner banner--the-position">
        <h1 class="banner__h1">Submit your<br>application form</h1>
    </div>

    <main role="main" id="main-content">

        <section class="row banner-intro">
            <h2 class="banner-intro__h2">Send to the team</h2>
            <p class="banner-intro__copy">Use the form below to submit your completed application form to us.</p>
        </section>

        <section class="row form application">

            <form name="application-form" id="application-form" method="post" action="/_/scripts/send-application.php" enctype="multipart/form-data">

                <fieldset class="form__set form__set--no-top-margin">

                    <div class="form__legend-wrap">
                        <svg role="presentation" class="form__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-user"></use></svg>
                        <legend class="form__legend">Your details</legend>
                    </div>

                    <div class="form__flex-container">

                        <div class="form__input-wrap">
                            <label class="form__label form__label--required" for="name"><span class="form__label--star">*</span>First Name:</label>
                            <input class="form__input required" type="text" name="name" tabindex="1" value="<?= @$_SESSION['name']; ?>" placeholder="First Name">
                        </div>

                        <div class="form__input-wrap">
                            <label class="form__label form__label--required" for="surname"><span class="form__label--star">*</span>Surname:</label>
                            <input class="form__input required" type="text" name="surname" tabindex="2" value="<?= @$_SESSION['surname']; ?>" placeholder="Surname">
                        </div>

                        <div class="form__input-wrap">
                            <label class="form__label" for="tel">Telephone:</label>
                            <input class="form__input" type="tel" name="tel" tabindex="3" value="<?= @$_SESSION['tel']; ?>" placeholder="This is an optional field">
                        </div>

                        <div class="form__input-wrap">
                            <label class="form__label form__label--required" for="email"><span class="form__label--star">*</span>Email Address:</label>
                            <input class="form__input required email" type="email" name="email" tabindex="4" value="<?= @$_SESSION['email']; ?>" placeholder="email@domain.com">
                        </div>

                    </div>

                </fieldset>

                <fieldset class="form__set">

                    <div class="form__legend-wrap">
                        <svg role="presentation" class="form__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-clip"></use></svg>
                        <legend class="form__legend">Attach your application form</legend>
                    </div>

                    <div class="form__flex-container">

                        <div class="form__input-wrap">
                            <label class="form__label form__label--required" for="myFirstFile"><span class="form__label--star">*</span>Your application form:</label>

                            <div class="form__upload-wrap">
                                <input type="button" class="form__upload-button" value="Attach">
                                <input class="form__file-upload" id="myFirstFile" name="myFirstFile" type="file">
                                <span class="form__file-name form__file-name--first">Select your file&#8230;</span>
                            </div>

                            <p class="form__notice form__notice--formats">Supported: pdf, Word docx, Excel xlsx, jpg &amp; png (2mb max file size)</p>
                        </div>

                        <div class="form__input-wrap">
                            <label class="form__label" for="mySecondFile">Any supporting document:</label>

                            <div class="form__upload-wrap">
                                <input type="button" class="form__upload-button" value="Attach">
                                <input class="form__file-upload" id="mySecondFile" name="mySecondFile" type="file">
                                <span class="form__file-name form__file-name--second">Select your file&#8230;</span>
                            </div>

                            <p class="form__notice form__notice--formats">Supported: pdf, Word docx, Excel xlsx, jpg &amp; png (2mb max file size)</p>
                        </div>

                    </div>

                    <p class="form__notice"><span class="form__notice--star">*</span>Indicates Required fields</p>

                </fieldset>


                <div id="form-messages" class="form__submission">
                    <button class="form__button" type="submit">Send it our way!</button>
                    <div class="form__captcha g-recaptcha" data-sitekey="6LetOWkUAAAAAFpFowCflNQTlOj4aWUSjpweynID"></div>
                </div>

                <?php if(isset($_SESSION['_error'])): ?>
                <div class="form__errors">
                    <p class="form__error-message"><?= $_SESSION['_error'] ?></p>
                </div>
                <?php endif; unset($_SESSION['_error']); ?>

                <?php if(isset($_SESSION['_success'])): ?>
                <div class="form__success">
                    <p class="form__success-message"><?= $_SESSION['_success'] ?></p>
                </div>
                <?php endif; unset($_SESSION['_success']); ?>

            </form>

        </section>

    </main>

<?php include("../../_/inc/footer.inc.php"); ?>
