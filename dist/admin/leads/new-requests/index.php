<?php
$pageTitle = 'Leads | New Requests';
$menuItem1 = 'leads';
$menuItem2 = 'new-requests';
require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$leads = Pagination::getResults('leads', '12', [['lead_status_id', '25']]);
?>

<!-- breadcrumb -->
<div class="container-fluid g-0">
	<div class="row g-0">

		<div class="col-6 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
			<div class="breadcrumb-title pe-3">
				<a href="/<?= ADMIN_FOLDER ?>/leads/new-requests/">Leads</a>
			</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item active" aria-current="page">New Requests</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="col-6 align-items-center mb-3">
			<div class="btn-group float-end">
				<a href="/<?= ADMIN_FOLDER ?>/leads/add.php" type="button" class="btn btn-primary"><i class="bx bx-list-plus"></i> New Lead</a>
				<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
				<ul class="dropdown-menu">
					<li>
						<a class="dropdown-item" href="/<?= ADMIN_FOLDER ?>/leads/add.php">Action</a>
					</li>
				</ul>
			</div>
		</div>

	</div>

</div>
<!-- end breadcrumb -->

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/leads.php"); ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>