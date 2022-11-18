<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}

$currentPage = 'account';
$accountSection = 'order';
$accountTitle = 'Order History';
$pageTitle = 'View your order history';
$metaDes = 'View your order history';

include("../../_/inc/header.inc.php");

$orders = Order::get();
if (!$orders) {

	include('no-orders.php');
} else {

?>
	<main role="main" id="main-content" class="customer-admin">
		<section class="row my-account">
			<?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
			<nav class="my-account-breadcrumb">
				<ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item">Order History</li>
				</ul>
			</nav>
			<div class="my-account-grid-wrap">

				<?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>

				<section class="my-account-orders">
					<?php foreach ($orders as $order) {

						$products = Order::getProductOrder($order['id']);
						$product_count = count($products);

					?>
						<div class="my-account-orders__order">

							<?php $i = 1;
							foreach ($products as $product) { ?>
								<header class="my-account-orders__header <?php if (($i > 1) && ($product_count !== 1)) {
																														echo "my-account-orders__header--multi-prod";
																													} ?>">
									<h2 class="my-account-orders__h2"><?php echo $product['product_name']; ?></h2>
									<?php if ($i == 1) { ?>
										<span class="my-account-orders__number">Order No. <?php echo 'JB0000' . $order['order_no']; ?></span>
									<?php } ?>
								</header>
								<?php $image = Products::get($product['product_id']); ?>
								<div class="my-account-orders__body">
									<img class="my-account-orders__thumb" src="<?php echo $image['product_thumbnail_image']; ?>" alt="Supreme Micro e-Pocket Single">
									<p class="my-account-orders__specifics">
										Product code: <?php echo $product['product_code']; ?><br>
										Quantity: x<?php echo $product['quantity']; ?><br>
										<?php if ($i === $product_count) { ?>
											<br>
											Date ordered: <?php echo date('d/m/Y', strtotime($order['created_at'])); ?><br>
											Delivery due: <?php echo (!empty($order['delivery_date'])) ? date('d/m/Y', strtotime($order['delivery_date'])) : 'Not selected' ?><br>
										<?php } ?>
										<?php if ($i === $product_count) { ?>
											<span class="my-account-orders__specifics--total">
												Total order value: £<?php echo $order['total_order_amount']; ?>
											</span>
										<?php } ?>
									</p>
								</div>

								<?php if ($i === $product_count) { ?>
									<footer class="my-account-orders__footer">
										<nav class="my-account-orders__nav">
											<?php if (empty($order['sap_no'])) { ?>
												<a class="my-account-orders__footer-link my-account-orders__footer-link--disabled">Download VAT Invoice</a>
											<?php } else { ?>
												<a class="my-account-orders__footer-link" href="/account/order-history/invoice?id=<?= $order['id'] ?>" target="_blank">Download VAT Invoice</a>
											<?php } ?>
											<a class="my-account-orders__footer-link" href="/account/order-history/delivery?id=<?= $order['id'] ?>">View Delivery Details</a>
										</nav>
										<?php if ($order['order_status'] === "Processing Order") { ?>
											<span class="my-account-orders__status my-account-orders__status my-account-orders__status--ca-paid">Status: Processing Order</span>
										<?php } elseif ($order['order_status'] === "Order Complete") { ?>
											<span class="my-account-orders__status my-account-orders__status my-account-orders__status--ca-dispatched">Status: Order Complete</span>
										<?php } elseif ($order['order_status'] === "Order Failed") { ?>
											<span class="my-account-orders__status my-account-orders__status--ca-cancelled">Status: Order Failed</span>
										<?php } ?>
										<?php if (empty($order['sap_no'])) { ?>
											<p class="my-account-orders__foot-note">Invoice available once your order is complete.</p>
										<?php } ?>
									</footer>
							<?php }
								$i++;
							} ?>
						</div><!-- my-account-orders__order -->
					<?php } ?>
				</section>
			</div><!-- my-account-grid-wrap -->
			<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
		</section><!-- my-account -->
	</main>
	<?php include("../../_/inc/footer.inc.php"); ?>
<?php } ?>