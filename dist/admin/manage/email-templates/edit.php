<?php 
$pageTitle = 'Manage | Edit email';
$menuItem1 = 'manage';
$menuItem2 = 'email-templates';
include('../../../_/inc/admin.header.inc.php'); 

$email = Email::get($_GET['id']);

?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/manage/email-templates/">Email Templates</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Email</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->
<form action="/" method="post" id="email_form">
	<div class="card">
	  	<div class="card-body">
		  	<h5 class="card-title">Edit Email</h5>
		  	<hr/>
	       	<div class="form-body mt-4">
		    	<div class="row">
			   		<div class="col-lg-12">
			           	<div class="border border-3 p-4 rounded">
							<div class="mb-3">
								<label for="name" class="form-label">Name</label><br/>
								<strong><?php echo $email['name']; ?></strong>
							</div>
							<div class="mb-3">
								<label for="subject" class="form-label">Email subject</label>
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter name" value="<?php echo $email['subject']; ?>" required>
							</div>
							<div class="mb-3">
								<label for="editor" class="form-label">Email body</label>
								<textarea class="form-control" id="editor" name="body" placeholder="Enter content" required><?php echo $email['body']; ?></textarea>
							</div>
				        </div>
				   	</div>
				   	<div class="col-lg-12 mt-4">
	              		<button type="submit" class="btn btn-primary">Save email</button>
	              		<input type="hidden" name="id" value="<?php echo $email['id']; ?>" />
					</div>
		   		</div><!--end row-->
			</div>
	  	</div>
	</div>
</form>

<?php include('../../../_/inc/admin.footer.inc.php'); ?>