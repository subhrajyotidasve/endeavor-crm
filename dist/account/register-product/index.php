<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'guarantee';
$accountTitle = 'Your Guarantees';
$pageTitle = 'View and register your Jay-Be guarantees';
$metaDes = 'View and register your Jay-Be guarantees';
$javascript = ['product_guarantee_page'];

include("../../_/inc/header.inc.php"); 

?>
    <main role="main" id="main-content" class="customer-admin">

        <section class="row my-account">


            <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>


            <nav class="my-account-breadcrumb">

				<ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item">Your Guarantees</li>
				</ul>

			</nav>
        
            <div class="my-account-grid-wrap">

                <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>

                <section class="my-account-gurantee">

                    <?php // var_dump($products); ?>

                    <?php if(!$products) { ?>

					<p class="my-account-gurantee__copy">For your convenience guarantees for all products purchased on this website are automatically registered, you can view these below. If you purchased a Jay-Be product from an alternative source, please use the link below to register your guarantee.</p>
                <?php } else { ?>

					<?php
                        foreach ($products as $product) {
                            if (!empty($product['order_id'])) {
                                $order = Order::get($product['order_id']);
                                // var_dump($order);
                            }
                            ?>

					<!-- <div class="my-account-gurantee__container"> -->
					
						<div class="my-account-gurantee__wrap"  id="guarantee-item-<?= $product['id']?>">
                            <?php if (!isset($product['order_id'])) { ?>
                            <svg id="guarantee-remove-item-<?= $product['id'] ?>" style="cursor:pointer" aria-hidden="true" class="my-account-wishlist__close" viewBox="0 0 100 100">
                                <use xlink:href="<?=$svg_sprite_url?>#icon-close"></use>
                            </svg>
                            <?php } ?>
                            <?php if($product['retailer'] == 'jaybe.com') { ?>
                                    <svg aria-hidden="true" class="" viewBox="0 0 100 15">
                                        <use xlink:href="<?=$svg_sprite_url?>#icon-logo"></use>
                                    </svg>
                        <?php } ?>
							<h4 class="my-account-gurantee__title"><?= $product['product'] ?><span class="my-account-gurantee__title--secondary"></span></h4>
							<p class="my-account-gurantee__details">Purchase date: <time datetime="05-25-2021"><?= date('d-m-Y', strtotime($product['date_of_purchase'])) ?></time><br>
							<!-- Expires: Lifetime (Frame)<br> -->
<!--							Expires: <time datetime="05-25-2022">--><?php //echo date('d-m-Y', strtotime($product['date_of_purchase']. ' +5 years')) ?><!-- </time><br>-->
							Purchased from: <?= $product['retailer'] ?></p>
							<p class="my-account-gurantee__details my-account-gurantee__details--quantity"><br>
							<?php if($product['retailer'] != 'jaybe.com') { echo '<span class="guarantee-text">Please retain your receipt as legitimate proof of purchase. Not doing so may invalidate your guarantee.</span>'; } ?></p>
							</p>

                        <!-- Enable guarantee download button if Order Complete -->
                        <?php
                            if (!empty($order)) {
                                if ( ($order['order_status'] != 'Order Complete') || (empty($order['sap_no'])) ) { ?>
							    <a class="my-account__button my-account__button--margin-top my-account__button--inner">Order still in process</a>
                        <?php
                                } else { ?>
                                    <a class="my-account__button my-account__button--margin-top my-account__button--inner" href="/account/register-product/guarantee?id=<?= $product['id'] ?>" target="_blank">Download as a PDF</a>
                        <?php   }
                            } else { ?>
                                <a class="my-account__button my-account__button--margin-top my-account__button--inner" href="/account/register-product/guarantee?id=<?= $product['id'] ?>" target="_blank">Download as a PDF</a>
                        <?php
                            }
                        ?>

                        </div>
                        <?php } ?>


                <?php } ?>
						<div class="my-account-gurantee__wrap my-account-gurantee__wrap--new">
							<a class="my-account-gurantee__add-new-link" href="/account/register-product/register.php" aria-label="Register a guarantee">
								<svg aria-hidden="true" class="my-account-gurantee__icon" viewBox="0 0 100 100">
									<use xlink:href="<?=$svg_sprite_url?>#icon-ca-add"></use>
								</svg>
								Register your Guarantee<br>
								<span class="my-account-gurantee__link-text guarantee-text">For products not ordered on jaybe.com</span>
							</a>
						</div>

						<!-- <div class="my-account-gurantee__wrap">
							<h4 class="my-account-gurantee__title">COREKIDS&trade; IR-Energy E2<span class="my-account-gurantee__title--secondary">Children's Mattress</span></h4>
							<p class="my-account-gurantee__details">Purchase date: <time datetime="2021-07-14">14-07-2021</time><br>
							Expires: <time datetime="2026-07-14">14-07-2026</time><br>
							Purchased from: Argos</p>
							<p class="my-account-gurantee__details my-account-gurantee__details--quantity">Quantity: x1<br>
							Please retain your receipt as legitimate proof of purchase. Not doing so may invalidate your guarantee.</p>

							<a class="my-account__button my-account__button--margin-top my-account__button--inner" href="#">Download Guarantee as a PDF</a>
						</div> -->

					<!-- </div>my-account-container		 -->
					
				</section><!-- my-account-gurantee -->


            </div><!-- my-account-grid-wrap -->


			<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
            

        </section><!-- my-account -->
  

    </main>

<?php include("../../_/inc/footer.inc.php"); ?>