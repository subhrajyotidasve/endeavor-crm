<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'marketing';
$accountTitle = 'Marketing';
$pageTitle = 'Control your marketing preferences';
$metaDes = 'Control your marketing preferences';
$javascript = ['newsletter_page'];

include("../../_/inc/header.inc.php");

$newsletter = Customer::getNewsletter();

?>
    <main role="main" id="main-content" class="customer-admin">
        <section class="row my-account">
            <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
            <nav class="my-account-breadcrumb">
            <ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item">Marketing</li>
				</ul>
			</nav>
            <div class="my-account-grid-wrap">
                <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
                <section class="my-account-marketing">
                    <div class="my-account-marketing__pref">
                        <svg aria-hidden="true" class="my-account-marketing__icon" viewBox="0 0 100 100">
                            <use xlink:href="<?=$svg_sprite_url?>#icon-ca-newsletter"></use>
                        </svg>
                        <div class="my-account-marketing__body">
                            <h2 class="my-account-marketing__h2">Can we stay in touch?</h2>
                            <p class="my-account-marketing__copy">Be the first to receive priority information on relevant products and promotions. For details of how we handle your data please see our <a class="my-account-marketing__copy--link" href="/policies/privacy/">Privacy Policy.</a> Please note, you can change this preference at any time using the toggle below.</p>
                            <div class="my-account-form__input-wrap my-account-form__input-wrap--toggle my-account-form__input-wrap--marketing-prefs">
                                <label class="my-account-form__label my-account-form__label--toggle" for="marketing-opt-in">Yes, I am happy to receive email.</label>
                                <label class="my-account-form__switch">
                                    <input id="marketing-opt-in" class="my-account-form__slide-checkbox" type="checkbox" name="marketing-opt-in" <?php if($newsletter['newsletter'] == 1) { echo 'checked'; } ?>>
                                    <span class="my-account-form__slider my-account-form__slider--round"></span>
                                </label>
                            </div>
                        </div><!-- my-account-marketing__body -->
                    </div>
                </section><!-- my-account-marketing -->
            </div><!-- my-account-grid-wrap -->
			<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
        </section><!-- my-account -->
    </main>
<?php include("../../_/inc/footer.inc.php"); ?>