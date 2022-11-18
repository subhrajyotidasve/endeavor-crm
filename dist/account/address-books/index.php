<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}

$currentPage = 'account';
$accountSection = 'address';
$accountTitle = 'Address Book';
$pageTitle = 'Manage your address book';
$metaDes = 'Manage your address book';
$javascript = ['address_page'];

include("../../_/inc/header.inc.php");

$addresses = Customer::addresses();

if(!$addresses) {

	include('no-addresses.php');
} else {

?>
<main role="main" id="main-content" class="customer-admin">
    <section class="row my-account">
        <?php include("../../_/inc/customer-admin/ca-header.inc.php"); ?>
        <nav class="my-account-breadcrumb">
			<ul class="my-account-breadcrumb__list">
				<li class="my-account-breadcrumb__list-item"><a class="my-account-breadcrumb__link" href="/account/dashboard">Dashboard</a></li>
				<li class="my-account-breadcrumb__list-item">Address Book</li>
			</ul>
		</nav>
        <div class="my-account-grid-wrap">
            <?php include("../../_/inc/customer-admin/ca-nav.inc.php"); ?>
            <section class="my-account-address">
			<?php if(isset($addresses) && !empty($addresses)) {
				foreach ($addresses as $address) { ?>
				<div id="address-wrap-<?= $address['id']?>" class="my-account-address__wrap <?= $address['is_primary'] ? 'my-account-address__wrap--primary' : '' ?>">
					<small id="primary-<?=$address['id']?>"<?= $address['is_primary'] ? '' : 'hidden' ?>>Primary</small>
					<p class="my-account-address__address">
						<?= $address['nickname'] ?><br>
						<?= $address['first_name'] . ' ' . $address['last_name'] ?><br>
						<?= $address['address1'] ?><br>
						<?php if($address['address2']) { ?>
						<?= $address['address2'] ?><br>
					<?php } ?>
						<?= $address['city'] ?><br>
						<?= $address['postcode'] ?>
					</p>
					<footer id="address-footer-<?= $address['id'] ?>" class="my-account-address__footer">
						<a class="my-account-address__link" href="/account/address-books/edit?id=<?= $address['id'] ?>">Edit</a>
						<a href="" class="my-account-address__link remove-address" data-id="<?= $address['id']?>">Delete</a>
						
					<?php if(count($addresses) > 1) { ?>
						<?= !$address['is_primary'] ? '<a style="cursor:pointer" id="make-primary-' . $address['id'] . '" class="my-account-address__link" onclick="makePrimary(' . $address['id'] . ')">Make Primary</a>' : '' ?>
				<?php } ?>
					</footer>
				</div>
				<?php } ?>
			<?php } ?>
				<div class="my-account-address__wrap my-account-address__wrap--new">
					<a class="my-account-address__add-new-link" href="/account/address-books/new" aria-label="Add a new address">
						<svg aria-hidden="true" class="my-account-address__icon" viewBox="0 0 100 100">
							<use xlink:href="<?=$svg_sprite_url?>#icon-ca-add"></use>
						</svg>
						Add new address
					</a>
				</div>
			</section><!-- my-account-address -->
        </div><!-- my-account-grid-wrap -->
		<?php include("../../_/inc/customer-admin/ca-footer.inc.php"); ?>
    </section><!-- my-account -->
</main>
<?php include("../../_/inc/footer.inc.php"); ?>
<?php } ?>