<?php
$pageTitle = 'Orders | Waiting Ofice Confirmation';
$menuItem1 = 'orders';
$menuItem2 = 'waiting-office-confirmation';
require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$leads = Pagination::getResults('leads', '10', [['lead_status_id', '23']]);

// $args = array();
// $args = [['lead_status_id', '19']];
// if (!empty($args)) {
// 	foreach ($args as $arg) {
// 		$search_sql = ' AND ' . $arg[0] . ' = \'%' . $arg[1] . '%\'';
// 	}
// 	echo 'SQL: '.$search_sql;
// 	var_dump($args);
// }
?>

<!-- breadcrumb -->
<div class="container-fluid g-0">
	<div class="row g-0">

		<div class="col-6 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
			<div class="breadcrumb-title pe-3">
				<a href="/<?= ADMIN_FOLDER ?>/leads/new-requests/">Orders</a>
			</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item active" aria-current="page">Waiting Ofice Confirmation</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="col-6 align-items-center mb-3">
			<div class="btn-group float-end">
				<a href="/<?= ADMIN_FOLDER ?>/orders/add.php" type="button" class="btn btn-primary"><i class="bx bx-list-plus"></i> New Order</a>
				<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
				<ul class="dropdown-menu">
					<li>
						<a class="dropdown-item" href="/<?= ADMIN_FOLDER ?>/orders/add.php">Action</a>
					</li>
				</ul>
			</div>
		</div>

	</div>

</div>
<!-- end breadcrumb -->

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/leads.php"); ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>