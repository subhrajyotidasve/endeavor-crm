<?php if (!empty($leads)) { ?>

	<div class="card">
		<div class="card-body">

			<div class="table-responsive">
				<table class="table mb-0 table-striped">
					<thead class="table-light">
						<tr>
							<th>Web ID</th>
							<th>Country Code</th>
							<th>Contact Method</th>
							<th>Last Activity</th>
							<th>Surname</th>
							<th>Name</th>
							<th>Email</th>
							<th>Payment Status</th>
							<th>Brand</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($leads as $lead) {

							if ($lead['order_status'] == 'processing') {

								$status_color = 'text-warning';
								$status_bg = 'bg-light-warning';
							} else if ($lead['order_status'] == 'completed') {

								$status_color = 'text-success';
								$status_bg = 'bg-light-success';
							} else {
								$status_color = 'text-danger';
								$status_bg = 'bg-light-danger';
							}

						?>
							<tr>
								<td class="align-middle">
									<?= $lead['order_no'] ?>
								</td>
								<td class="align-middle"><?= $lead['customer_country'] ?></td>
								<td class="align-middle"><?= $lead['contact_method'] ?></td>
								<td class="align-middle">&nbsp;</td>
								<td class="align-middle"><?= $lead['customer_last_name'] ?></td>
								<td class="align-middle"><?= $lead['customer_first_name'] ?></td>
								<td class="align-middle">
									<a href="mailto:<?= $lead['customer_email'] ?>"><?= $lead['customer_email'] ?></a>
								</td>
								<td class="align-middle">
									<div class="badge rounded-pill <?php echo $status_color; ?> <?php echo $status_bg; ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php echo $lead['order_status']; ?></div>
								</td>
								<td class="align-middle"><?= $lead['brand'] ?></td>
								<td class="align-middle">
									<div class="d-flex order-actions">
										<a href="/<?php echo ADMIN_FOLDER; ?>/leads/edit.php?lead_id=<?php echo $lead['id']; ?>" class=""><i class='bx bxs-edit'></i></a>
										<a href="javascript:;" class="ms-3 delete_lead" data-id="<?= $lead['id'] ?>"><i class='bx bxs-trash'></i></a>
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

	<div class="modal fade" id="deleteLead" tabindex="-1" aria-labelledby="deleteLeadLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Lead</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this lead?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
					<button type="button" class="btn alert-danger" id="delete_lead" data-id="">Yes</button>
				</div>
			</div>
		</div>
	</div>

<?php } else { ?>

	<?php require($_SERVER['DOCUMENT_ROOT'] . "/_/inc/partials/alerts/nothing-found.php"); ?>

<?php } ?>