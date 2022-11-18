<?php
$pageTitle = 'Manage | Email Templates';
$menuItem1 = 'manage';
$menuItem2 = 'email-templates';
require_once($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.header.inc.php");
$emails = Email::all();
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Manage</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Email Templates</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table mb-0 table-striped">
				<thead class="table-light">
					<tr>
						<th>Country</th>
						<th>Brand</th>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($emails as $email) { ?>
						<tr>
							<td class="align-middle"><?= Country::get($email['country_id'])['country_code'] ?></td>
							<td class="align-middle"><?= Brand::get($email['brand_id'])['brand_name'] ?></td>
							<td class="align-middle"><?php echo $email['name']; ?></td>
							<td class="align-middle">
								<div class="d-flex order-actions">
									<a href="/<?php echo ADMIN_FOLDER; ?>/manage/email-templates/edit.php?id=<?php echo $email['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/_/inc/admin.footer.inc.php"); ?>