<?php 

$pageTitle = 'Edit FAQ';

include('../../_/inc/admin.header.inc.php'); 

$faq = Faqs::get($_GET['id']);
$product_categories = Products::categories();
$unserialize = unserialize($faq['categories']);

?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/faqs">FAQs</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit FAQ</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<form action="/" method="post" id="faq_form">
	<div class="card">
	  	<div class="card-body p-4">
		  	<h5 class="card-title">Edit FAQ</h5>
		  	<hr/>
	       	<div class="form-body mt-4">
		    	<div class="row">
			   		<div class="col-lg-12">
			           	<div class="border border-3 p-4 rounded">
							<div class="mb-3">
								<label for="question" class="form-label">Question <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="question" placeholder="Enter question" name="question" value="<?php echo $faq['question']; ?>" required />
							</div>
							<div class="mb-3">
								<label for="editor" class="form-label">Answer <span class="text-danger">*</span></label>
								<textarea class="form-control" id="editor" placeholder="Enter answer" name="answer" required><?php echo $faq['answer']; ?></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Product Category</label><br/>
									<?php foreach ($product_categories as $val) { ?>
										<?php if (!empty($val)) { ?>
									<input type="checkbox" name="category[]" value="<?php echo $val['id']; ?>" <?php if (!empty($unserialize) &&  in_array($val['id'], $unserialize)) { echo 'checked'; } ?> /> <?php echo $val['name']; ?><br/>
										<?php } ?>
									<?php } ?>
						  	</div>
				        </div>
				   	</div>
				   	<div class="col-lg-12 mt-4">
	              		<button type="submit" class="btn btn-primary">Save FAQ</button>
	              		<input type="hidden" name="id" value="<?php echo $faq['id']; ?>" />
					</div>
		   		</div><!--end row-->
			</div>
	  	</div>
	</div>
</form>

<?php include('../../_/inc/admin.footer.inc.php'); ?>