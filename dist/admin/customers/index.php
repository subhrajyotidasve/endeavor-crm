<?php 

$pageTitle = 'Customers';

include('../../_/inc/admin.header.inc.php'); 

$customers = Pagination::getResults('customers');

?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Customers</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">
		<div class="d-lg-flex align-items-center mb-4 gap-3">
			<div class="position-relative">
				<form action="/<?php echo ADMIN_FOLDER; ?>/customers/" method="post">
					<input required type="text" class="form-control ps-5 radius-30" placeholder="Search Customers" name="search" value="<?php if (isset($_POST['search'])) { echo $_POST['search']; } ?>"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
				</form>
			</div>
			<button class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#customerModal"><i class='bx bxs-plus-square'></i>Add Customer</button>
		</div>
		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<!-- <th>ID</th> -->
						<th>Customer name</th>
						<th>Email Address</th>
						<th>Total Orders</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($customers as $customer) { ?>
					<tr>
						<!-- <td><?php echo $customer['id']; ?></td> -->
						<td><?php echo $customer['first_name']; ?> <?php echo $customer['last_name']; ?></td>
						<td><?php echo $customer['email']; ?></td>
						<td><?php echo Customer::totalOrders($customer['id']); ?></td>
						<td>
							<div class="d-flex order-actions">
								<a href="/<?php echo ADMIN_FOLDER; ?>/customers/edit.php?id=<?php echo $customer['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
								<a href="javascript:;" class="ms-3 delete_customer" data-id="<?php echo $customer['id']; ?>"><i class='bx bxs-trash'></i></a>
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

<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>An email will be sent containing the customer's new password.</p>

		<div class="mb-3">
	        <label for="first_name">First name</label>
	        <input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="Enter first name" />
	    </div>
	    <div class="mb-3">
	        <label for="last_name">last name</label>
	        <input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Enter last name" />
	    </div>
	    <div class="mb-3">
	        <label for="email">Email address</label>
	        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email address" />
	    </div>
	    <div class="mb-3">
	        <label for="tel_mobile">Phone number</label>
	        <input type="text" class="form-control" id="tel_mobile" name="tel_mobile" value="" placeholder="Enter phone nubmer" />
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_customer">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCustomer" tabindex="-1" aria-labelledby="deleteCustomerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete this customer?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn alert-danger" id="delete_customer" data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>