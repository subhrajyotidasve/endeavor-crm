<?php

$pageTitle = 'Dashboard';

include('../_/inc/admin.header.inc.php');

?>
<!-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

	<div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Total Sales (all time)</p>
						<h4 class="my-1 text-info">£<?= Order::adminTotalSales() ?></h4>
						<p class="mb-0 font-13">Launch date: 28/03/2022</p>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Sales Last Week</p>
						<h4 class="my-1 text-info">£<?= Order::adminSalesLastWeek() ?></h4>
						<p class="mb-0 font-13">From Monday to Sunday</p>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Sales This Week</p>
						<h4 class="my-1 text-info">£<?= Order::adminSalesThisWeek() ?></h4>
						<p class="mb-0 font-13">From Monday to now</p>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Sales Today</p>
						<h4 class="my-1 text-info">£<?= Order::adminSalesToday() ?></h4>
						<p class="mb-0 font-13">From 0:00am to now</p>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
end row -->

<div class="row">
	<?php
		// print_r($woocommerce->get('orders'));
		
		echo '<pre>';

		// print_r($woocommerce->get('orders/4941'));

		$order = $woocommerce->get('orders/4941');
		// print_r($order);

		// echo $order->id;

		echo '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
		echo '</pre>';

		// foreach($order as $key=>$value) {
		// 	echo $key.': '.$value.'<br>';
		// }

		// echo $customer_first_name = $order->billing->first_name;
		
		$order_no = $order->id;
		
		$customer_first_name = $order->billing->first_name;
		$customer_last_name = $order->billing->last_name;
		$customer_email = $order->billing->email;
		$customer_tel_mobile = $order->billing->phone;
		



	?>
</div>




<?php include('../_/inc/admin.footer.inc.php'); ?>