<?php
// Redirect if not logged in
if (!isset($_SESSION['customer'])) {
    header( "Location: /account/" );
}

$currentPage = 'account';
$accountSection = 'order';
$accountTitle = 'Order History';
$pageTitle = 'Dashboard you have to place an order';
$metaDes = 'Dashboard you have to place an order';


?>
<main role="main" id="main-content" class="customer-admin">
    <section class="row my-account">
        <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
        <ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard.php">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item">Order History</li>
			</ul>

		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <!-- my-account-nav -->
            <section>
                <p class="my-account__copy">You haven't placed any orders yet.</p>
                <a class="my-account__button" href="/">Start Shopping</a>
            </section>
        </div><!-- my-account-grid-wrap -->
		<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>