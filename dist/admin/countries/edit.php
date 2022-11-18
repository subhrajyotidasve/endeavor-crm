<?php
$pageTitle = 'Edit Country';

include('../../_/inc/admin.header.inc.php'); 

$country = Country::get($_GET['id']);
?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/countries">Countries</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Country</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<form action="/" method="post" id="country_form">
	<div class="card">
	  <div class="card-body p-4">
		  <h5 class="card-title">Edit Country</h5>
		  <hr/>
	       <div class="form-body mt-4">
	          <div class="border border-3 p-4 rounded">

                    <div class="row">

			   				<div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="country_name" class="form-label">Country Name</label>
                                    <input type="text" class="form-control" id="country_name" placeholder="Enter country name" name="country_name" value="<?= $country['country_name'] ?>" required />
                                </div>

                                <div class="mb-3">
                                    <label for="country_code" class="form-label">Country Code</label>
                                    <input type="text" class="form-control" id="country_code" placeholder="Enter country code" name="country_code" value="<?= $country['country_code'] ?>" required maxlength="2" />
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="my-account-form__label" for="currency_code">Currency Code</label>
                                    <input type="text" class="form-control" id="currency_code" placeholder="Enter currency code" name="currency_code" value="<?= $country['currency_code'] ?>" required maxlength="3" />
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="my-account-form__label" for="currency_symbol">Currency Symbol</label>
                                    <input type="text" class="form-control" id="currency_symbol" placeholder="Enter currency code" name="currency_symbol" value="<?= $country['currency_symbol'] ?>" required maxlength="1" />
                                </div>

                            </div>
                    </div>
                    <div class="row">
	                    <div class="col-lg-12">
	                    <button type="submit" class="btn btn-primary">Save Country</button>
	                    <input type="hidden" name="id" value="<?php echo $country['id']; ?>">
                    </div>
			   	</div>
		   </div><!--end row-->
		</div>
	  </div>
	</form>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>