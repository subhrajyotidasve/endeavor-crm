<?php

$pageTitle = 'Countries';

include('../../_/inc/admin.header.inc.php');

$countries = Pagination::getResults('countries');

?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Countries</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">
		<div class="d-lg-flex align-items-center mb-4">
			<div class="position-relative">
<!--				<form action="/--><?php //echo ADMIN_FOLDER; ?><!--/countries/" method="post">-->
<!--					<input required type="text" class="form-control ps-5 radius-30" placeholder="Search Countries" name="search" value="--><?php //if (isset($_REQUEST['search'])) { echo $_REQUEST['search']; } ?><!--"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>-->
<!--				</form>-->
			</div>
			<button class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#countryModal"><i class='bx bxs-plus-square'></i>Add Country</button>
		</div>
		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<th>ID</th>
						<th>Country Name</th>
						<th>Country Code</th>
						<th>Currency Code</th>
						<th>Currency Symbol</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($countries as $country) { ?>
					<tr>
						<td><?= $country['id'] ?></td>
						<td><?= $country['country_name'] ?></td>
						<td><?= $country['country_code'] ?></td>
                        <td><?= $country['currency_code'] ?></td>
                        <td><?= $country['currency_symbol'] ?></td>
						<td>
							<div class="d-flex order-actions">
								<a href="/<?php echo ADMIN_FOLDER; ?>/countries/edit.php?id=<?php echo $country['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
								<a href="javascript:;" class="ms-3 delete_country" data-id="<?php echo $country['id']; ?>"><i class='bx bxs-trash'></i></a>
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

<div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="countryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

		<div class="mb-3">
	        <label for="first_name">Country name</label>
	        <input type="text" class="form-control" id="country_name" name="country_name" value="" placeholder="Enter country name" />
	    </div>

	    <div class="mb-3">
	        <label for="last_name">Country Code</label>
	        <input type="text" class="form-control" id="country_code" name="country_code" value="" placeholder="Enter country code" maxlength="2" />
	    </div>

	    <div class="mb-3">
	        <label for="email">Currency Code</label>
	        <input type="email" class="form-control" id="currency_code" name="currency_code" value="" placeholder="Enter currency code" maxlength="3" />
	    </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_country">Save</button>
      </div>

    </div>

  </div>
</div>

<div class="modal fade" id="deleteCountry" tabindex="-1" aria-labelledby="deleteCountryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Country</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete this country?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn alert-danger" id="delete_country" data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>