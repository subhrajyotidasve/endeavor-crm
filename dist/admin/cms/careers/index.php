<?php 
$pageTitle = 'Careers';
include('../../../_/inc/admin.header.inc.php'); 
$jobs = Pagination::getResults('jobs');
?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">CMS</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Careers</li>
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
			<a href="/admin/cms/careers/add.php" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add Job</a>
		</div>
		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<th>Title</th>
						<th>Date</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($jobs as $job) { ?>
					<tr>
						<td><?= $job['post_title'] ?></td>
						<td><?= date('F d, Y', strtotime($job['post_date'])) ?></td>
						<td><?= $job['post_status'] ?></td>
						<td>
							<div class="d-flex order-actions">
								<a href="/<?php echo ADMIN_FOLDER; ?>/cms/careers/edit.php?id=<?php echo $job['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
								<a href="javascript:;" class="ms-3 delete_post" data-id="<?php echo $job['id']; ?>"><i class='bx bxs-trash'></i></a>
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

<div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deletePostLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete this job?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn alert-danger" id="delete_post" data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>

<?php include('../../../_/inc/admin.footer.inc.php'); ?>