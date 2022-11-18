<?php 

$pageTitle = 'View order';

include('../../_/inc/admin.header.inc.php'); 

$order = Order::get($_GET['id']);
$customer = Customer::get($order['customer_id']);

$isStaffOrder = false;
if (!empty($customer) && $customer['admin'] == '1') {
    $isStaffOrder = true;
}

$products = Order::getProductOrder($order['id']);
$product_count = count($products);

$orderComplete = false;
if ( ($order['order_status'] == 'Order Complete') && (!empty($order['sap_no'])) ) {
    $orderComplete = true;
}

?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Store</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/orders/">Orders</a></li>
				<li class="breadcrumb-item active" aria-current="page">View Order</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->

<div class="card">
	<div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="card-title">Order No. <?php echo 'JB0000'.$order['order_no']; ?></h5>
            </div>
            <div class="col-lg-6">
                <?php if ( $isStaffOrder === true) { ?>
                    <span class="badge bg-warning text-dark" style="float:right;margin-bottom:5px;">Staff Order</span>
                <?php } ?>
            </div>
            <hr/>
        <div class="form-body mt-4">
            <div class="row">
                <div class="col-lg-7">

                    <?php 

                    foreach ($products as $product) { 
                        
//                        var_dump($product);

                        $image = Products::get($product['product_id']);

                    ?>
                    <div class="border border-3 p-4 rounded mb-4">
                        <div class="g-3">
                            <h5 class="my-account-orders__h2"><?php echo $product['product_name']; ?></h5>

                            <img src="<?php echo $image['product_thumbnail_image']; ?>" width="200" alt="Supreme Micro e-Pocket Single">
                            <p class="my-account-orders__specifics">
                                <strong>Product Code:</strong> <?php echo $product['product_code']; ?><br>

                                <?php if ( !empty($product['size']) ) { ?>
                                    <strong>Product Size:</strong> <?php echo $product['size']; ?><br>

                                <? } if ( !empty($product['fabric_style']) ) { ?>
                                    <strong>Product Colour:</strong> <?php echo $product['fabric_style']; ?><br>

                                <? } if ( !empty($product['model']) ) { ?>
                                    <strong>Product Model:</strong> <?php echo $product['model']; ?><br>

                                <?php } ?>
                                <strong>Quantity:</strong> x<?php echo $product['quantity']; ?><br>
                                <br>
                                <strong>Date Ordered:</strong> <?php echo date('d/m/Y', strtotime($order['created_at'])); ?><br>
                            
                                <span class="my-account-orders__specifics--total">
                                    <strong>Total Order Value:</strong> £<?php echo $order['total_order_amount']; ?>
                                </span>
                            </p>

                        </div>
                    </div>
                    <?php } ?>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="border border-3 p-4 rounded">
                                <div class="g-3">
                                    <h5 class="my-account-delivery__h2">Delivery Information</h5>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Name:</dt>
                                        <dd class="my-account-delivery__list-item"><?php echo $order['customer_first_name'] . " " . $order['customer_last_name']; ?></dd>
                                    </dl>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Email:</dt>
                                        <dd class="my-account-delivery__list-item"><?php echo $order['customer_email']; ?></dd>
                                    </dl>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Telephone:</dt>
                                        <dd class="my-account-delivery__list-item"><?php echo $order['customer_tel_mobile']; ?></dd>
                                    </dl>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Address:</dt>
                                        <dd class="my-account-delivery__list-item">
                                            <?php echo $order['customer_address1']; ?><br>
                                            <?php echo $order['customer_city']; ?><br>
                                            <?php echo $order['customer_postcode']; ?>
                                        </dd>
                                    </dl>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Anticipated Delivery Date:</dt>
                                        <dd class="my-account-delivery__list-item">
                                            <?= $order['delivery_date'] ?>
                                        </dd>
                                    </dl>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Comments:</dt>
                                        <dd class="my-account-delivery__list-item">
                                            <?= $order['instructions'] ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border border-3 p-4 rounded">
                                <div class="g-3">
                                    <h5 class="my-account-delivery__h2">Billing Information</h5>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Address:</dt>
                                        <dd class="my-account-delivery__list-item">
                                            <?php echo $order['customer_billing_address1']; ?><br>
                                            <?php echo $order['customer_billing_city']; ?><br>
                                            <?php echo $order['customer_billing_postcode']; ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="border border-3 p-4 rounded mt-4 mb-3">
                                <div class="g-3">
                                    <h5 class="my-account-delivery__h2">Marketing Preferences</h5>
                                    <dl class="my-account-delivery__list">
                                        <dt class="my-account-delivery__list-item my-account-delivery__list-item--head">Newsletter signup:</dt>
                                        <dd class="my-account-delivery__list-item">
                                            <?php
                                                if (  (!empty($customer)) &&  ($customer['newsletter'] == 1)  ) {
                                                    echo 'Yes';
                                                    } else {
                                                    echo 'No';
                                                }
                                            ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                    </div>
    
                </div>

                <div class="col-lg-5">
                    <div class="border border-3 p-4 rounded">
                        <div class="row g-3">

                            <?php
                                if ($orderComplete) {
                                    $guarantee = DB::run('SELECT * FROM customer_product_registrations WHERE order_id = '.$order['id'])->fetch();
                                    ?>
                            <nav class="my-account-orders__nav">
                                <div class="row">


                                    <div class="col-md-6 mb-3 d-grid">
                                        <a class="btn btn-primary btn-block" href="/account/order-history/invoice/?id=<?= $order['id'] ?>" target="_blank">Download Invoice</a>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <form action="/" method="post" id="email_invoice" enctype="multipart/form-data" class="d-grid">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" />
                                            <button type="submit" class="btn btn-primary btn-block">Email Invoice</button>
                                        </form>
                                    </div>


                                    <div class="col-md-6 mb-3 d-grid">
                                        <a class="btn btn-primary" href="/account/register-product/guarantee/?id=<?= $guarantee['id'] ?>" target="_blank">Download Guarantee(s)</a>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <form action="/" method="post" id="email_guarantee" enctype="multipart/form-data" class="d-grid">
                                            <input type="hidden" name="guarantee_id" value="<?php echo $guarantee['id']; ?>" />
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" />
                                            <button type="submit" class="btn btn-primary">Email Guarantee(s)</button>
                                        </form>
                                    </div>


                                    <div class="col-md-12 mb-3">
                                        <form action="/" method="post" id="email_invoice_guarantee" enctype="multipart/form-data" class="d-grid">
                                            <input type="hidden" name="guarantee_id" value="<?php echo $guarantee['id']; ?>" />
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" />
                                            <button type="submit" class="btn btn-success">Email Invoice & Guarantee(s)</button>
                                        </form>
                                    </div>


                                </div>
                            </nav>
                            <?php } // end if order complete ?>

                            <form action="/" method="post" id="sap_form" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <label for="sap_no" class="form-label">SAP Invoice No:</label>
                                    <input type="text" class="form-control" name="sap_no" value="<?php echo $order['sap_no']; ?>" />
                                </div>
                                <div class="col-12 pt-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Update Invoice No.</button>
                                        <input type="hidden" name="id" value="<?php echo $order['id']; ?>" />
                                    </div>
                                </div>
                            </form>

                            <form action="/" method="post" id="status_form" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <label for="order_status" class="form-label">Order Status:</label>
                                    <select name="order_status" class="form-control">
                                        <option value="Processing Order" <?php if ($order['order_status'] == 'Processing Order') { echo 'selected'; } ?>>Processing Order</option>
                                        <option value="Order Complete" <?php if ($order['order_status'] == 'Order Complete') { echo 'selected'; } ?>>Order Complete</option>
                                        <option value="Order Failed" <?php if ($order['order_status'] == 'Order Failed') { echo 'selected'; } ?>>Order Failed</option>
                                    </select>
                                </div>
                                <div class="col-12 pt-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Update Order Status</button>
                                        <input type="hidden" name="id" value="<?php echo $order['id']; ?>" />
                                    </div>
                                </div>
                            </form>

<!--                            <form action="/" method="post" id="tracking_form" enctype="multipart/form-data">-->
<!--                                <div class="col-md-12">-->
<!--                                    <label for="trackingcode" class="form-label">Tracking number:</label>-->
<!--                                    <input type="text" class="form-control" name="tracking_code" value="--><?php //echo $order['tracking_code']; ?><!--" />-->
<!--                                </div>-->
<!--                                <div class="col-12 pt-4">-->
<!--                                    <div class="d-grid">-->
<!--                                        <button type="submit" class="btn btn-primary">Update tracking</button>-->
<!--                                        <input type="hidden" name="id" value="--><?php //echo $order['id']; ?><!--" />-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
                        </div> 
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>