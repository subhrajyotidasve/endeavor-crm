<?php 

$pageTitle = 'questions';

include('../../_/inc/admin.header.inc.php'); 

$faqs = Pagination::getResults('faqs');

?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">FAQs</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">
		<div class="d-lg-flex align-items-center mb-4 gap-3">
			<div class="position-relative">
				<form action="/<?php echo ADMIN_FOLDER; ?>/faqs/" method="post">
					<input required type="text" class="form-control ps-5 radius-30" placeholder="Search faqs" name="search" value="<?php if (isset($_POST['search'])) { echo $_POST['search']; } ?>"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
				</form>
			</div>
			<button class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#faqModal"><i class='bx bxs-plus-square'></i>Add FAQ</button>
		</div>
		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<th>Question</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($faqs as $faq) { ?>
					<tr>
						<td><?php echo $faq['question']; ?></td>
						<td>
							<div class="d-flex order-actions">
								<a href="/<?php echo ADMIN_FOLDER; ?>/faqs/edit.php?id=<?php echo $faq['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
								<a href="javascript:;" class="ms-3 delete_faq" data-id="<?php echo $faq['id']; ?>"><i class='bx bxs-trash'></i></a>
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
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="faqModalTitle">Add FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Enter the faqs question to continue.</p>
        <label for="question">Question</label>
        <input type="text" class="form-control" id="question" name="question" value="" placeholder="Enter question" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_faq">Continue</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteFaq" tabindex="-1" aria-labelledby="deleteFaqLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete this faq?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn alert-danger" id="delete_faq" data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>