<?php
$pageTitle = 'Sales | Sales Figures';
$menuItem1 = 'sales';
$menuItem2 = 'sales-figures';
require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
// $leads = Pagination::getResults('leads', '10');
?>

<!-- breadcrumb -->
<div class="container-fluid g-0">
	<div class="row g-0">

		<div class="col-6 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
			<div class="breadcrumb-title pe-3">
				<a href="/<?= ADMIN_FOLDER ?>/sales/">Sales</a>
			</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item active" aria-current="page">Sales Figures</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>

</div>
<!-- end breadcrumb -->

<?php // require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/tables/leads.php"); ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>