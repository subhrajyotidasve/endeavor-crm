<?php
$pageTitle = 'Edit product';

include('../../_/inc/admin.header.inc.php');

$parent_product = Products::get($_GET['id']);
// var_dump($parent_product);
$category = Products::getCategory($parent_product['product_category']);
// var_dump($category);
?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Store</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo ADMIN_FOLDER; ?>/products">Products</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Product</li>
			</ol>
		</nav>
	</div>
</div>
<!--end breadcrumb-->
<form action="/" method="post" id="product_form" enctype="multipart/form-data">
	<div class="card">
		<div class="card-body p-4">
			<h5 class="card-title">Edit Product</h5>
			<hr />
			<div class="form-body mt-4">
				<div class="row">
					<div class="col-lg-8">
						<div class="border border-3 p-4 rounded">

							<div class="mb-3">
								<label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product title" value="<?php echo $parent_product['product_name']; ?>" required>
							</div>

							<div class="mb-3">
								<label for="nickname" class="form-label">Nickname</label>
								<input type="text" class="form-control" id="nickname" name="product_nickname" placeholder="Optional nickname" value="<?php echo $parent_product['product_nickname']; ?>" />
							</div>

							<div class="mb-3">
								<label for="product_subtitle" class="form-label">Sub Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="product_subtitle" name="product_subtitle" placeholder="Enter sub title" value="<?php echo $parent_product['product_subtitle']; ?>" required>
							</div>

							<div class="mb-3">
								<label for="product_website_url" class="form-label">Product URL <span class="text-danger">*</span> <a href="<?php echo $parent_product['product_website_url']; ?>" target="_blank">(visit)</a></label>
								<input type="text" class="form-control" id="product_website_url" name="product_website_url" placeholder="Enter full product URL" value="<?php echo $parent_product['product_website_url']; ?>" required>
							</div>

							<div class="mb-3">
								<label for="product_description" class="form-label">Description <span class="text-danger">*</span></label>
								<textarea class="form-control" name="product_description" id="product_description" rows="3"></textarea>
							</div>

							<?php //if ($category['type'] != 'COLOR') { 
							?>

							<div class="mb-3">
								<label class="form-label">Primary Image <?php if (!isset($parent_product['product_thumbnail_image'])) { ?><span class="text-danger">*</span><?php } ?> <span class="small">(W:450px x H:300px)</span></label>
								<input class="form-control" type="file" name="image" accept="image/*" <?php if (!isset($parent_product['product_thumbnail_image'])) { ?>required<?php } ?> />
								<?php if (isset($parent_product['product_thumbnail_image'])) { ?>
									<br />
									<a href="<?php echo $parent_product['product_thumbnail_image']; ?>" target="_blank"><img src="<?php echo $parent_product['product_thumbnail_image']; ?>" width="100" /></a>
								<?php } ?>
							</div>

							<!--							<div class="mb-3">-->
							<!--								<label class="form-label">Secondary Image <span class="small">(W:450px x H:300px)</span></label>-->
							<!--								<input class="form-control" type="file" name="secondary_image" accept="image/*" />-->
							<!--								--><?php //if (isset($parent_product['product_secondary_image'])) { 
																	?>
							<!--								<br/>-->
							<!--								<a href="--><?php //echo $parent_product['product_secondary_image']; 
																			?>
							<!--" target="_blank"><img src="--><?php //echo $parent_product['product_secondary_image']; 
																?>
							<!--" width="100" /></a>-->
							<!--								--><?php //} 
																	?>
							<!--							</div>-->
							<?php //} 
							?>

						</div>
					</div>
					<div class="col-lg-4">
						<div class="border border-3 p-4 rounded">
							<div class="row g-3">

								<div class="col-md-6">
									<label for="product_price" class="form-label">Price <span class="text-danger">*</span></label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">&pound;</div>
										</div>
										<input type="number" class="form-control" id="product_price" name="product_price" placeholder="00.00" value="<?php echo $parent_product['product_price']; ?>" min="1" step="any" required />
									</div>
								</div>

								<!--							  	<div class="col-md-6">-->
								<!--									<label for="was_price" class="form-label">Was Price <span class="text-danger">*</span></label>-->
								<!--									<div class="input-group mb-2">-->
								<!--										<div class="input-group-prepend">-->
								<!--								        	<div class="input-group-text">&pound;</div>-->
								<!--								        </div>-->
								<!--										<input type="number" class="form-control" id="was_price" name="product_was_price" placeholder="00.00" value="--><?php //echo $parent_product['product_was_price']; 
																																															?>
								<!--" min="1" step="any" required />-->
								<!--									</div>-->
								<!--							  	</div>-->

								<?php if ($category['type'] == 'COLOR') { ?>
									<div class="col-md-6">
										<label for="product_color" class="form-label">Fabric</label>
										<select class="form-select" id="product_color" name="color">
											<?php foreach (Products::categoryColors($category['colors']) as $code => $color) { ?>
												<option data-id="<?php echo $parent_product['id']; ?>" data-code="<?php echo $code; ?>" value="<?php echo $color; ?>" <?php if (strtolower($color) == strtolower($parent_product['color'])) {
																																											echo 'selected';
																																										} ?>>(<?php echo $code; ?>) <?php echo $color; ?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>

								<div class="col-md-6">
									<label for="product_code" class="form-label">Product Code <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter code" value="<?php echo $parent_product['product_code']; ?>" required />
								</div>

								<?php // if ($category['type'] != 'COLOR') { 
								?>
								<!-- <div class="col-md-6">
									<label for="product_stock" class="form-label">Stock Level <span class="text-danger">*</span></label>
									<input type="number" class="form-control" id="product_stock" name="stock" placeholder="0" value="<?php echo $parent_product['stock']; ?>" required />
								</div> -->

								<!-- <div class="col-md-6">
									<label for="product_stock" class="form-check-label">In stock?</label><br>
									<input type="checkbox" class="form-check-input" id="in_stock" name="in_stock" placeholder="1" value="1" 
										<?php if ($parent_product['in_stock'] == '1') {
											echo 'checked';
										}; ?> style="width:2.6em;height:2.6em;margin-top:0.6em;" />
								</div> -->


								<div class="col-md-6">
									<span class="stock-control-header">Stock control</span>
									<div class="form-check form-switch stock-controls">
										<div class="out-of-stock">Out of stock</div>
										<input class="form-check-input" type="checkbox" id="in_stock" name="in_stock" placeholder="1" value="1" <?php if ($parent_product['in_stock'] == '1') {
																																					echo 'checked';
																																				}; ?>>
										<label class="form-check-label" for="in_stock">In stock</label>
									</div>
								</div>



								<?php // } 
								?>

								<?php if ($category['type'] == 'SIZES') { ?>
									<div class="col-12">
										<label class="form-label" for="sizes">Product Size</label>
										<select class="form-select" id="sizes" name="size">
											<?php foreach (Products::categorySizes($category['sizes']) as $size) { ?>
												<option value="<?php echo $size; ?>" <?php if ($size == $parent_product['size']) {
																							echo 'selected';
																						} ?>><?php echo $size; ?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>

								<?php if ($category['type'] == 'MODEL') { ?>
									<div class="col-12">
										<label class="form-label" for="models">Product Model</label>
										<select class="form-select" id="model" name="model">
											<?php foreach (Products::categorySizes($category['models']) as $model) { ?>
												<option value="<?php echo $model; ?>" <?php if ($model == $parent_product['model']) {
																							echo 'selected';
																						} ?>><?php echo $model; ?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>

								<div class="col-12">
									<label class="form-label" for="product_brand">Product Brand</label>
									<select class="form-select" id="product_brand" name="product_brand">
										<option value="0" selected="">Please select...</option>
										<?php foreach (Products::brands() as $brand) { ?>
											<option value="<?= $brand['id'] ?>" <?php if ($brand['id'] == $parent_product['product_brand']) { echo 'selected'; } ?>><?= $brand['name'] ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="col-12">
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Save Product</button>
										<input type="hidden" name="id" value="<?php echo $parent_product['id']; ?>" />
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>

	<?php if ($category['variations'] == 1) { ?>
		<div class="card">
			<div class="card-body p-4">
				<div class="d-lg-flex align-items-center mb-4 gap-3">
					<div class="position-relative">

						<h5 class="card-title">Variations</h5>
					</div>
					<div class="ms-auto"><a id="add_variation" data-product-id="<?php echo $parent_product['id']; ?>" href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add Variation</a></div>
				</div>
				<hr />
				<div id="variations">
					<?php

					$products = Products::all(['parent_id' => $parent_product['id']]);
					unset($product);
					if (!empty($products)) {

						foreach ($products as $product) {

							include('variation.php');
						}
					}

					?>
				</div>
			</div>
		</div>
	<?php } ?>
</form>
<div class="modal fade" id="deleteProductVariation" tabindex="-1" aria-labelledby="deleteProductVariationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete product variation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this product variation?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				<button type="button" class="btn alert-danger" id="delete_product_variation" data-id="">Yes</button>
			</div>
		</div>
	</div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>