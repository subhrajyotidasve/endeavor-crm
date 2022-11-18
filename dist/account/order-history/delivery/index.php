<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}

$currentPage = 'account';
$accountSection = 'order';
$accountTitle = 'Order History';
$pageTitle = 'View your delivery details';
$metaDes = 'View your delivery details';

include("../../../_/inc/header.inc.php");

$order = Order::getOrder();

?>
    <main role="main" id="main-content" class="customer-admin">
        <section class="row my-account">
            <?php include("../../../_/inc/customer-admin/ca-header.inc.php"); ?>

            <nav class="my-account-breadcrumb">

				<ul class="my-account-breadcrumb__list">
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
					<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/order-history">Order History</a></li>
                    <li class="my-account-breadcrumb__list-item">Delivery</li>
				</ul>
			</nav>

            <div class="my-account-grid-wrap">
                <?php include("../../../_/inc/customer-admin/ca-nav.inc.php"); ?>
                <section class="my-account-delivery">
                    <div class="my-account-delivery__container">
                        <div class="my-account-delivery__delivery">
                            <h2 class="my-account-delivery__h2">Your Information</h2>
                            <dl class="my-account-delivery__list">
                                <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Name:</dt>
                                <dd class="my-account-delivery__list-item"><?php echo $order['customer_first_name'] . " " . $order['customer_last_name']; ?></dd>
                            </dl>
                            <dl class="my-account-delivery__list">
                                <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Email:</dt>
                                <dd class="my-account-delivery__list-item"><?php echo $order['customer_email']; ?></dd>
                            </dl>
                            <dl class="my-account-delivery__list">
                                <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Telephone:</dt>
                                <dd class="my-account-delivery__list-item"><?php echo $order['customer_tel_mobile']; ?></dd>
                            </dl>
                            <dl class="my-account-delivery__list">
                                <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Address:</dt>
                                <dd class="my-account-delivery__list-item">
                                    <?php echo $order['customer_address1']; ?><br>
                                    <?php echo $order['customer_city']; ?><br>
                                    <?php echo $order['customer_postcode']; ?>
                                </dd>
                            </dl>
                        </div>
                        <div class="my-account-delivery__delivery">
                            <h2 class="my-account-delivery__h2">Delivery information</h2>

                            <dl class="my-account-delivery__list">
                                <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Delivery due date:</dt>
                                <dd class="my-account-delivery__list-item"><?php echo (!empty($order['delivery_date'])) ? date('d/m/Y', strtotime($order['delivery_date'])) : 'Not selected' ?></dd>
                            </dl>

                        </div>

                    </div>
                </section><!-- my-account-delivery -->

            </div><!-- my-account-grid-wrap -->
			<?php include("../../../_/inc/customer-admin/ca-footer.inc.php"); ?>
        </section><!-- my-account -->
    </main>
<?php include("../../../_/inc/footer.inc.php"); ?>