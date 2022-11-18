<?php
$pageTitle = 'Store orders';
$menuItem1 = 'leads';
require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$orders = Pagination::getResults('orders', '10');
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Store</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Orders</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">

		<div class="d-lg-flex align-items-center mb-4 gap-3">

			<div class="position-relative col-lg-4">
				<form action="/<?php echo ADMIN_FOLDER; ?>/orders/" method="post">
					<input required type="text" class="form-control ps-5 radius-30" placeholder="Search Orders" name="search" value="<?php if (isset($_POST['search'])) {
																																			echo $_POST['search'];
																																		} ?>" style="width: 85%; display: inline-block;">
					<span class="position-absolute top-50 product-show translate-middle-y">
						<i class="bx bx-search"></i>
					</span>
					<a href="/<?php echo ADMIN_FOLDER; ?>/orders/"><i class="bx bx-x-circle" style="font-size:20px;" title="Clear search"></i></a>
					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchTips"><i class="bx bx-help-circle" style="font-size:20px;" title="Click for search tips"></i></a>
				</form>
			</div>

			<div class="position-relative col-lg-8">
				<form id="admin_orders_export" style="text-align:right;margin-right:15px;" action="/<?php echo ADMIN_FOLDER; ?>/orders/export.php" method="get" target="_blank">
					<label for="basic-date_range">Select date range:</label>
					<input class="form-control" id="date_range" name="date_range" size="25" value="<?php if (!empty($date_range)) {
																										echo $date_range;
																									} ?>" placeholder="Select date range" style="display:inline-block;width:auto;" required>
					<button type="submit" id="orders_export" class="btn btn-primary" style="margin-bottom:2px;"><i class="bx bxs-download"></i>Export data</button>
				</form>
			</div>

		</div>

		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<th>Web Order No</th>
						<th>Case Reference</th>
						<th>Name</th>
						<th>Date</th>
						<th>Value</th>
						<!-- <th>Staff Order</th> -->
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php

					foreach ($orders as $order) {

						$isStaffOrder = false;

						$sql = "SELECT admin FROM customers WHERE id = ?";
						$customer = DB::run($sql, [$order['customer_id']])->fetch();

						if (!empty($customer) && $customer['admin'] == '1') {
							$isStaffOrder = true;
						}

						if ($order['order_status'] == 'processing') {

							$status_color = 'text-warning';
							$status_bg = 'bg-light-warning';
						} else if ($order['order_status'] == 'completed') {

							$status_color = 'text-success';
							$status_bg = 'bg-light-success';
						} else {
							$status_color = 'text-danger';
							$status_bg = 'bg-light-danger';
						}
					?>
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="ms-2">
										<h6 class="mb-0 font-14"><?= $order['order_no'] ?></h6>
									</div>
								</div>
							</td>
							<td><?= $order['sap_no']; ?></td>
							<td><?= $order['customer_first_name'] ?> <?= $order['customer_last_name'] ?></td>
							<td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
							<td>&pound;<?= number_format($order['total_order_amount'], 2) ?></td>
							<!-- <td>
								<?php if ($isStaffOrder === true) { ?>
									<span class="badge bg-warning text-dark">STAFF ORDER</span>
								<?php } ?>
							</td> -->
							<td>
								<div class="badge rounded-pill <?php echo $status_color; ?> <?php echo $status_bg; ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php echo $order['order_status']; ?></div>
							</td>
							<td>
								<div class="d-flex order-actions">
									<a href="/<?php echo ADMIN_FOLDER; ?>/orders/view.php?id=<?php echo $order['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
									<!--								<a href="javascript:;" class="ms-3 delete_order" data-bs-toggle="modal" data-bs-target="#deleteOrder" data-id="--><?php //echo $order['id']; 
																																															?>
									<!--"><i class='bx bxs-trash'></i></a>-->
									<?php // if ($isStaffOrder === true) { ?>
										<a href="javascript:;" class="ms-3 delete_order" data-id="<?= $order['id'] ?>"><i class='bx bxs-trash'></i></a>
									<?php // } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php Pagination::pageLinks(); ?>
<div class="modal fade" id="deleteOrder" tabindex="-1" aria-labelledby="deleteOrderLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this order?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				<button type="button" class="btn alert-danger" id="delete_order" data-id="">Yes</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="searchTips" tabindex="-1" aria-labelledby="searchTips" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Search Tips</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<p>How to find what you're looking for:</p>

				<p><strong>Order Numbers</strong></p>
				<p>Use only the last four digits of the order number, e.g. to find order JB00002024 search '2024'</p>
				<p><strong>Order Dates</strong></p>
				<p>Search by date using the format YYYY-MM-DD, e.g. '2022-03-21' or just '2022-03'</p>
				<p><strong>SAP No</strong></p>
				<p>Use all or part of SAP Invoice Number</p>
				<p><strong>Customer</strong></p>
				<p>Use all or part of first/last name or postcode (note: postcodes may contain spaces)</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn alert-danger" id="delete_customer" data-id="">Yes</button> -->
			</div>
		</div>
	</div>
</div>



<?php include('../../_/inc/admin.footer.inc.php'); ?>

<!-- Create date picker instance (for store details page) -->
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script>
	if (document.getElementById('date_range')) { // prevents console errors on pages where not used

		var picker = new Litepicker({
			element: document.getElementById('date_range'),
			singleMode: false,
			tooltipText: {
				one: 'day',
				other: 'days'
			},
			tooltipNumber: (totalDays) => {
				return totalDays;
			},
			format: 'DD-MM-YYYY'
		});

	}
</script>