<?php include('core.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Jay-Be&reg; UK - <?php echo($pageTitle); ?></title>
	<meta name="description" content="Jay-Be&reg; UK - <?php echo($metaDes); ?>">
	<meta name="author" content="Richard Dale">
    <meta name="copyright" content="Jay-Be Limited">
    <meta name="theme-color" content="#202020">
    <meta name="referrer" content="origin">
    <meta name="robots" content="<?php if (isset($metaNoIndex)) { echo "noindex, nofollow"; }  else { echo "index, follow"; } ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- <meta name="p:domain_verify" content="e1de645cfd1c4fe18b5c970753176613">
    <meta name="geo.region" content="GB">
    <meta name="geo.position" content="53.67496;-1.66682">
    <meta name="ICBM" content="53.67496, -1.66682">
    <meta property="og:title" content="Edndeavor CRM">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://endeavor.crm">
    <meta property="og:image" content="/_/img/global/social-default.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:locale" content="en_GB">

    <link rel="apple-touch-icon" href="/_/img/global/apple-touch-icon.png"> -->

  	<link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;900&display=swap">
    <link rel="stylesheet" href="/_/css/site-global.css?v=100">

    <script>var postcode_api = '<?php echo Settings::$postcode_api; ?>';</script>

    <?php
    	// Output Google Tracking Code for Promo if applied
    	if ( !empty($_SESSION['voucher']) && (!empty($pageType) && $pageType == 'complete') ) { ?>

    <!-- Global site tag -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-123456789"></script>
    <?php
        $voucher_id = $_SESSION['voucher']['id'];
        $tracking_code = DB::run('SELECT * FROM vouchers WHERE id = ?', [$voucher_id])->fetch();
        echo $tracking_code['tracking_code'];;
    }
	?>

</head>


<body id="top-of-page">

	<a class="skip-link" href="#main-content" tabindex="0" aria-hidden="true">Skip to main content</a>

	<!-- Message alert system -->
	<div class="alert-wrap" id="alert" style="display: none;">
        <div class="alert-container">
            <div id="alert-title"></div>
            <div id="alert-message"></div>
        </div>
    </div>

	<header role="banner" class="site-head">

		<div class="site-head__wrap row row--ultra-wide" style="float:right;">

			<nav class="commerce-nav">

				<?php
	                if ((!empty($_SESSION['admin'])) && ($_SESSION['admin'] == true)) {
	                    $username_link = '/admin';
	                } else {
	                    $username_link = '/account';
	                }
                ?>

				<div class="commerce-nav__wrap">
					<a class="commerce-nav__link commerce-nav__link--signin" href="<?=$username_link?>" aria-label="Login / view your account">
						<span class="commerce-nav__name">
							<?= isset($_SESSION['customer']['first_name']) ? 'Hello ' . $_SESSION['customer']['first_name'] : 'Sign In'?>
						</span>
						<svg class="commerce-nav__icon commerce-nav__icon--signin" aria-hidden="true" viewBox="0 0 100 100">
			                <use xlink:href="<?=$svg_sprite_url?>#icon-user-account"></use>
			            </svg>
					</a>
				</div>

				<?php 
                    if (Customer::loggedIn()) {
						$wishlist_link = '/account/wishlist';
                    } else {
                    	$wishlist_link = '';
                    }
                ?>

				<div class="commerce-nav__wrap">
					<a class="commerce-nav__link commerce-nav__link--wishlist" id="header-wishlist" aria-label="View your wishlist">
						<span class="commerce-nav__counter" id="total_wishes" <?php if (!isset($_SESSION['wishlist_count'])) { echo 'style="display:none;"'; } ?>>
							<?php echo $_SESSION['wishlist_count']; ?>
						</span>
						<!-- <svg class="commerce-nav__icon" aria-hidden="true" viewBox="0 0 100 90">
			                <use xlink:href="<?=$svg_sprite_url?>#icon-wishlist"></use>
			            </svg> -->
					</a>
				</div>

			
			</nav><!-- End commerce-nav -->

		</div><!-- End site-head__wrap -->

	</header>