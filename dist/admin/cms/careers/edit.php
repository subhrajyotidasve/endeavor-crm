<?php
$pageTitle = 'Edit job';
include('../../../_/inc/admin.header.inc.php');
$job = Post::get($_GET['id']);
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
				<li class="breadcrumb-item active" aria-current="page">Edit Job</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->
<form action="/" method="post" id="post_update_form" enctype="multipart/form-data">
	<div class="card">
		<div class="card-body p-4">
			<h5 class="card-title">Edit Job</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="row">
					<div class="col-lg-9">
						<div class="border border-3 p-4 rounded">

							<div class="mb-4">
								<label for="post_title" class="form-label">Job Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter job title" value="<?php echo $job['post_title']; ?>" required>
							</div>

							<div class="mb-4">
								<label for="post_excerpt" class="form-label">Excerpt <span class="text-danger">*</span></label>
								<textarea class="form-control" name="post_excerpt" id="post_excerpt" rows="3"><?=$job['post_excerpt']?></textarea>
							</div>

							<div class="">
								<label for="editor" class="form-label">Job Description <span class="text-danger">*</span></label>
								<textarea class="form-control" id="editor" name="editor" placeholder="Enter job description"><?php echo $job['post_content']; ?></textarea>
							</div>

						</div>
					</div>
					<div class="col-lg-3">
						<div class="border border-3 p-4 rounded">
							<div class="row g-3">

								<div class="col-12">
									<label for="post_date" class="form-label">Date Posted</label>
									<input type="date" class="form-control" id="post_date" name="post_date" value="<?php echo $job['post_date']; ?>" />
								</div>




								<div class="col-12">
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Update Job</button>
										<input type="hidden" name="id" value="<?php echo $job['id']; ?>" />
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