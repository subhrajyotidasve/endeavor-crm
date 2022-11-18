<?php
$pageTitle = 'Add job';
include('../../../_/inc/admin.header.inc.php');

?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">CMS</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/cms/careers">Careers</a></li>
				<li class="breadcrumb-item active" aria-current="page">Add Job</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->
<form action="/" method="post" id="post_add_form" enctype="multipart/form-data">
	<div class="card">
		<div class="card-body p-4">
			<h5 class="card-title">Add Job</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="row">
					<div class="col-lg-9">
						<div class="border border-3 p-4 rounded">

							<div class="mb-4">
								<label for="post_title" class="form-label">Job Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter job title" value="" required>
							</div>

							<div class="mb-4">
								<label for="post_excerpt" class="form-label">Excerpt <span class="text-danger">*</span></label>
								<textarea class="form-control" name="post_excerpt" id="post_excerpt" rows="3"></textarea>
							</div>

							<div class="">
								<label for="editor" class="form-label">Job Description <span class="text-danger">*</span></label>
								<textarea class="form-control" id="editor" name="editor" placeholder="Enter job description"></textarea>
							</div>

						</div>
					</div>
					<div class="col-lg-3">
						<div class="border border-3 p-4 rounded">
							<div class="row g-3">

								<div class="col-12">
									<label for="post_date" class="form-label">Date Posted</label>
									<input type="date" class="form-control" id="post_date" name="post_date" value="<?= date('Y-m-d') ?>" />
								</div>

								<div class="col-12">
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Update Job</button>
                                        <input type="hidden" name="post_type" value="job" />
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>

</form>

<?php include('../../../_/inc/admin.footer.inc.php'); ?>