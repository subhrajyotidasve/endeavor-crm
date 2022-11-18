<?php

$pageTitle = 'Edit admin';

include('../../_/inc/admin.header.inc.php');

$admin = Customer::get($_GET['id']);

?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/admins">Admins</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<form action="/" method="post" id="admin_form">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Edit Admin</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="border border-3 p-4 rounded">
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="first_name" class="form-label">First Name</label>
								<input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name" value="<?php echo $admin['first_name']; ?>" required />
							</div>
							<div class="mb-3">
								<label for="email_address" class="form-label">Email address</label>
								<input type="email" class="form-control" id="email_address" placeholder="Enter email address" name="email" value="<?php echo $admin['email']; ?>" required />
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="last_name" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name" value="<?php echo $admin['last_name']; ?>" required />
							</div>
							<div class="mb-3">
								<label for="phone_number" class="form-label">Phone number</label>
								<input type="text" class="form-control" id="phone_number" placeholder="Enter phone number" name="tel_mobile" value="<?php echo $admin['tel_mobile']; ?>" required />
							</div>
						</div>
						<fieldset class="my-account-form__set my-account-form__set--password">
							<div class="row">
								<div class="col-lg-6">
									<label class="form-label" for="password">Password:</label>
									<input class="form-control" type="password" name="password" <?php echo $admin['password'] ? '' : 'required' ?>/>
								</div>
								<div class="col-lg-6">
									<label class="form-label" for="password">Confirm Password:</label>
									<input class="form-control" type="password" name="confirm_password" <?php echo $admin['password'] ? '' : 'required' ?>/>
								</div>
								<small class="text-primary mb-3">
									Password must have a minimum of eight characters, at least one uppercase letter, one lowercase letter and one number.
								</small>
							</div>
						</fieldset>
						<div class="mb-3">
							<label for="user_avatar" class="form-label">User avatar</label>
							<input class="form-control" type="file" name="user_avatar" accept="image/*" <?php echo $admin['user_avatar'] ? '' : 'required' ?> />
							<p>
								<small class="text-primary">
									Image should be square and at least 300px height & width.
								</small>
								<?php if (isset($admin['user_avatar'])) { ?>
									<br /><br />
									<a href="<?php echo $admin['user_avatar']; ?>" target="_blank"><img src="<?php echo $admin['user_avatar']; ?>" width="100" /></a>
								<?php } ?>
							</p>
						</div>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">Save Admin</button>
							<input type="hidden" name="id" value="<?php echo $admin['id']; ?>" />
							<input type="hidden" name="admin" value="1" />
						</div>
					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</div>
</form>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>