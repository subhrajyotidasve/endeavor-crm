<?php
$pageTitle = 'Testing';
$menuItem1 = 'testing';
$menuItem2 = 'debug';
include('../../_/inc/admin.header.inc.php');
?>

<!-- breadcrumb -->
<div class="container-fluid g-0">
	<div class="row g-0">

		<div class="col-6 page-breadcrumb d-none d-sm-flex align-items-center mb-2 text-left">
			<div class="breadcrumb-title pe-3">
				<a href="/<?= ADMIN_FOLDER ?>/testomg/">Testing</a>
			</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item active" aria-current="page">Debug</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>

</div>
<!-- end breadcrumb -->

<div class="container" style="padding-top: 80px;">
    <div class="row">

        <?php

        $customer_id = '159';

        $orders = DB::run('SELECT * FROM orders WHERE customer_id = ?', [$customer_id])->fetch();

        // echo '<p>ORDERS</p>';
        // var_dump($orders);
        // echo '<p>&nbsp</p>';

        ?>

    </div>
</div>

<?php include('../../_/inc/admin.footer.inc.php'); ?>