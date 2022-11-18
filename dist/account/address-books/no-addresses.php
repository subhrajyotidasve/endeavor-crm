<?php
// Redirect if not logged in
if (!isset($_SESSION['customer'])) {
    header( "Location: /account/" );
}

$currentPage = 'account';
$accountSection = 'address';
$pageTitle = 'Dashboard you have to place an order';
$metaDes = 'Dashboard you have to place an order';


?>
<main role="main" id="main-content" class="customer-admin">
    <section class="row my-account">
        <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
        <ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard.php">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item">Address Book</li>
			</ul>
		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <!-- my-account-nav -->
            <section>
                <p class="my-account__copy">You have no saved addresses. Please note any addresses added here will not affect any current orders. To amend the delivery address for an open order please call our sales team on <a class="my-account__copy--link" href="tel://01924666633">01924 666 633.</a></p>
                <a class="my-account__button" href="/account/address-books/new">Add a new Address</a>
            </section>
        </div><!-- my-account-grid-wrap -->
		<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>