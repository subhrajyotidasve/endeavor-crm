<?php
$pageTitle = 'Edit customer';

include('../../_/inc/admin.header.inc.php');

$customer = Customer::get($_GET['id']);
$orders = DB::run("SELECT * FROM orders WHERE customer_id = ? ORDER BY id DESC", [$_GET['id']])->fetchAll();
// var_dump($orders);
$emails = DB::run("SELECT * FROM customer_emails WHERE customer_id = ? ORDER BY created_at DESC", [$_GET['id']])->fetchAll();
?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/customers">Customers</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->


<div class="card">
	<form action="/" method="post" id="customer_form" autoComplete="off">
		<div class="card-body p-4">
			<h5 class="card-title">Edit Customer</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="border border-3 p-4 rounded">
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="first_name" class="form-label">First Name</label>
								<input type="text" class="form-control" id="first_name" placeholder="Enter product title" name="first_name" value="<?= $customer['first_name'] ?>" required />
							</div>
							<div class="mb-3">
								<label for="email_address" class="form-label">Email address</label>
								<input type="email" class="form-control" id="email_address" placeholder="Enter sub title" name="email" value="<?= $customer['email'] ?>" required />
							</div>
							<div class="col-lg-6 mb-3">
								<label class="my-account-form__label" for="marketing">Marketing?</label>
								<input type="checkbox" name="newsletter" value="1" <?php echo $customer['newsletter'] == '1' ? 'checked' : '' ?>> Allow marketing emails?
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="last_name" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="last_name" placeholder="Enter product title" name="last_name" value="<?= $customer['last_name'] ?>" required />
							</div>
							<div class="mb-3">
								<label for="phone_number" class="form-label">Phone number</label>
								<input type="number" class="form-control" id="phone_number" placeholder="Enter sub title" name="tel_mobile" value="<?= $customer['tel_mobile'] ?>" required />
							</div>
						</div>
						<fieldset class="my-account-form__set my-account-form__set--password">
							<legend class="my-account-form__legend">Edit password</legend>
							<div class="row">
								<div class="col-lg-6 mb-3">
									<label class="my-account-form__label" for="password">New Password:</label>
									<input class="form-control" type="password" tabindex="5" name="password" autoComplete="off">
								</div>
								<div class="col-lg-6 mb-3">
									<label class="my-account-form__label" for="password">Confirm Password:</label>
									<input class="form-control" type="password" tabindex="6" name="confirm_password" autoComplete="off">
								</div>
							</div>
						</fieldset>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">Save Customer</button>
							<input type="hidden" name="id" value="<?= $customer['id'] ?>">
						</div>
					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</form>
</div>





<div class="card">

	<div class="card-body p-4 row">

		<div class="col-lg-6">
			<h5 class="card-title">Order History</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="border border-3 p-4 rounded">

					<div class="table-responsive">
						<table class="table mb-0 table-striped">
							<thead class="table-light">
								<tr>
									<th>Order No.</th>
									<th>Date</th>
									<th>Value</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php

								foreach ($orders as $order) {

									$isStaffOrder = false;

									$sql = "SELECT admin FROM customers WHERE id = ?";
									$customer = DB::run($sql, [$order['customer_id']])->fetch();

									if (!empty($customer) && $customer['admin'] == '1') {
										$isStaffOrder = true;
									}

									if ($order['order_status'] == 'Processing Order') {

										$status_color = 'text-warning';
										$status_bg = 'bg-light-warning';
									} else if ($order['order_status'] == 'Order Complete') {

										$status_color = 'text-success';
										$status_bg = 'bg-light-success';
									} else {
										$status_color = 'text-danger';
										$status_bg = 'bg-light-danger';
									}
								?>
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div class="ms-2">
													<h6 class="mb-0 font-14">
														<a href="/admin/orders/view.php?id=<?= $order['id'] ?>" target="_blank">
															<?php echo 'JB0000' . $order['order_no']; ?>
														</a>
													</h6>
												</div>
											</div>
										</td>
										<td><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
										<td>&pound;<?php echo $order['total_order_amount']; ?></td>
										<td>

											<i class='bx bxs-circle me-1 <?php echo $status_color; ?>' title="<?= $order['order_status'] ?>"></i>
										</td>

									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>



		<div class="col-lg-6">
			<h5 class="card-title">Email History</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="border border-3 p-4 rounded">


					<div class="table-responsive">
						<table class="table mb-0 table-striped">
							<thead class="table-light">
								<tr>
									<th>Date / Time</th>
									<th>Subject / Recipient</th>
									<!-- <th>Actions</th> -->
								</tr>
							</thead>
							<tbody>
								<?php

								foreach ($emails as $email) {
									$array = [
										'order_number' => $email['order_no'],
										'order_no' => $email['order_no']
									];
									$template = Email::getTemplate($email['email_id'], $array);
									$subject = $template['subject'];
									$recipient = $email['email_to'];
								?>
									<form action="/" method="POST">
										<tr>
											<td>
												<?php echo date('d/m/Y', strtotime($email['created_at'])); ?><br>
												<small><?php echo date('H:i:s', strtotime($email['created_at'])); ?></small>
											</td>
											<td>
												<?= $subject ?><br>
												<small><em><?= $recipient ?></em></small>
											</td>
											<!-- <td>
												<a href="/<?php echo ADMIN_FOLDER; ?>/customers/edit.php?id=<?php echo $customer['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
												<button class="btn btn-sm btn-primary">Resend</button>
												<a href="" class="">Resend</a>
											</td> -->
										</tr>
										<input type="hidden" name="" value="">
									</form>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>



				</div>
			</div>
		</div>

	</div>

</div>





<?php include('../../_/inc/admin.footer.inc.php'); ?>