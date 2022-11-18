<?php //echo 'Product: '; var_dump($product); ?>

<?php if ($category['type'] == 'SIZES') { ?>

    <div class="border border-3 p-4 rounded mb-3" id="product_variation_<?php echo $product['id']; ?>">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-sm btn-danger delete_product_variation float-end" data-id="<?php echo $product['id']; ?>"><i class='bx bxs-trash'></i> Delete</button>
		</div>
        <?php // echo 'Sizes: '; var_dump(Products::categorySizes($category['sizes'])); ?>
		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Product Size </label>
				<select class="form-select" name="variation[<?php echo $product['id']; ?>][size]" required>
                    <?php foreach (Products::categorySizes($category['sizes']) as $key => $val) { ?>
					<option value="<?php echo $val; ?>" <?php if (strtolower($val) == strtolower($product['size'])) { echo 'selected'; } ?>><?php echo $val; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">Primary Image <?php if (empty($product['product_thumbnail_image'])) { ?><?php } ?> <span class="small">(W:250px x H:150px)</span></label>
				<input class="form-control" type="file" name="variation_<?php echo $product['id']; ?>_image" accept="image/*" <?php if (empty($product['product_thumbnail_image'])) { ?>required<?php } ?> />
				<?php if (!empty($product['product_thumbnail_image'])) { ?>
				<br/>
				<a href="<?php echo $product['product_thumbnail_image']; ?>" target="_blank"><img src="<?php echo $product['product_thumbnail_image']; ?>" width="100" /></a>
				<?php } ?>
			</div>
<!--			<div class="mb-3">-->
<!--				<label class="form-label">Secondary Image <span class="small">(W:250px x H:150px)</span></label>-->
<!--				<input class="form-control" type="file" name="variation_--><?php //echo $product['id']; ?><!--_secondary_image" accept="image/*" />-->
<!--				--><?php //if (!empty($product['product_secondary_image'])) { ?>
<!--				<br/>-->
<!--				<a href="--><?php //echo $product['product_secondary_image']; ?><!--" target="_blank"><img src="--><?php //echo $product['product_secondary_image']; ?><!--" width="100" /></a>-->
<!--				--><?php //} ?>
<!--			</div>	-->
		</div>
		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label class="form-label">Price </label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
					        	<div class="input-group-text">&pound;</div>
					        </div>
							<input name="variation[<?php echo $product['id']; ?>][product_price]" type="number" class="form-control" placeholder="00.00" value="<?php echo ($product['product_price']) ? $product['product_price'] : ''; ?>"  />
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Product Code</label>
						<input name="variation[<?php echo $product['id']; ?>][product_code]" type="text" class="form-control" value="<?php echo ($product['product_code']) ? $product['product_code'] : '';  ?>" placeholder="Enter product code"  />
					</div>
			  	</div>
			  	<div class="col-md-6">
<!--					<div class="mb-3">-->
<!--						<label class="form-label">Was Price </label>-->
<!--						<div class="input-group mb-2">-->
<!--							<div class="input-group-prepend">-->
<!--					        	<div class="input-group-text">&pound;</div>-->
<!--					        </div>-->
<!--							<input name="variation[--><?php //echo $product['id']; ?><!--][product_was_price]" type="number" class="form-control" placeholder="00.00" value="--><?php //echo ($product['product_was_price']) ? $product['product_was_price'] : ''; ?><!--"  />-->
<!--						</div>-->
<!--					</div>-->
					<div class="mb-3">
						<label class="form-label">Stock Level</label>
						<input name="variation[<?php echo $product['id']; ?>][stock]" type="number" class="form-control" placeholder="0" value="<?php echo ($product['stock']) ? $product['stock'] : ''; ?>"  />
					</div>
			  	</div>
			  	<div class="col-lg-12">
			  		
				</div>
			</div>
		</div>
	</div>
</div>

<?php } else if ($category['type'] == 'COLOR') { ?>

    <div class="border border-3 p-4 rounded mb-3">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-sm btn-danger delete_product_variation float-end" data-id="<?php echo $product['id']; ?>"><i class='bx bxs-trash'></i> Delete</button>
		</div>
		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Product Colour </label>
				<select class="form-select change_color" name="variation[<?php echo $product['id']; ?>][color]" >
					<?php foreach (Products::categoryColors($category['colors']) as $code => $color) { ?>
					<option data-id="<?php echo $product['id']; ?>" data-code="<?php echo $code; ?>" value="<?php echo $color; ?>" <?php if (strtolower($color) == strtolower($product['color'])) { echo 'selected'; $thisColorCode = $code; } ?>>(<?php echo $code; ?>) <?php echo $color; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">Primary Image <?php if (!isset($product['product_thumbnail_image'])) { ?><span class="small">(W:250px x H:150px)</span><?php } ?></label>
				<input class="form-control" type="file" name="variation_<?php echo $product['id']; ?>_image" accept="image/*" <?php if (!isset($product['product_thumbnail_image'])) { ?>required<?php } ?> />
				<?php if (isset($product['product_thumbnail_image'])) { ?>
				<br/>
				<a href="<?php echo $product['product_thumbnail_image']; ?>" target="_blank"><img src="<?php echo $product['product_thumbnail_image']; ?>" width="100" /></a>
				<?php } ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label class="form-label">Product Code </label>
<!--                        <input name="variation[--><?php //echo $product['id']; ?><!--][product_code]" type="text" class="form-control" id="product_code_--><?php //echo $product['id']; ?><!--" value="--><?php //echo ($parent_product['product_code']) ? $parent_product['product_code'] : ''; ?><!--"  />-->

                        <input name="variation[<?php echo $product['id']; ?>][product_code]" type="text" class="form-control" id="product_code_<?php echo $product['id']; ?>" value="<?php echo ($parent_product['product_code']) ? substr($parent_product['product_code'], 0, -2).$thisColorCode : ''; ?>"  />

					</div>
			  	</div>
			  	<div class="col-md-6">
					<div class="mb-3">
						<label class="form-label">Stock Level </label>
						<input name="variation[<?php echo $product['id']; ?>][stock]" type="number" class="form-control" placeholder="0" value="<?php echo ($product['stock']) ? $product['stock'] : ''; ?>"  />
					</div>
			  	</div>
<!--			<div class="mb-3">-->
<!--				<label class="form-label">Secondary Image <span class="small">(W:250px x H:150px)</span></label>-->
<!--				<input class="form-control" type="file" name="variation_--><?php //echo $product['id']; ?><!--_secondary_image" accept="image/*" />-->
<!--				--><?php //if (isset($product['product_secondary_image'])) { ?>
<!--				<br/>-->
<!--				<a href="--><?php //echo $product['product_secondary_image']; ?><!--" target="_blank"><img src="--><?php //echo $product['product_secondary_image']; ?><!--" width="100" /></a>-->
<!--				--><?php //} ?>
<!--			</div>-->
			</div>
		</div>
	</div>
</div>

<?php } else if ($category['type'] == 'MODEL') { ?>

    <div class="border border-3 p-4 rounded mb-3">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-danger delete_product_variation float-end" data-id="<?php echo $product['id']; ?>"><i class='bx bxs-trash'></i> Delete</button>
            </div>
            <div class="col-lg-6">

                <?php // echo 'Models: '; var_dump(Products::categoryModels($category['models'])); echo 'Selected: '.$product['model']; ?>
                <div class="mb-3">
                    <label class="form-label">Product Model </label>
                    <select class="form-select" name="variation[<?php echo $product['id']; ?>][model]" required>
                        <?php foreach (Products::categoryModels($category['models']) as $key => $val) { ?>
                            <option value="<?php echo $val; ?>" <?php if (strtolower($val) == strtolower($product['model'])) { echo 'selected'; } ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Primary Image <?php if (!isset($product['product_thumbnail_image'])) { ?><span class="small">(W:250px x H:150px)</span><?php } ?></label>
                    <input class="form-control" type="file" name="variation_<?php echo $product['id']; ?>_image" accept="image/*" <?php if (!isset($product['product_thumbnail_image'])) { ?>required<?php } ?> />
                    <?php if (isset($product['product_thumbnail_image'])) { ?>
                        <br/>
                        <a href="<?php echo $product['product_thumbnail_image']; ?>" target="_blank"><img src="<?php echo $product['product_thumbnail_image']; ?>" width="100" /></a>
                    <?php } ?>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Price </label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">&pound;</div>
                                </div>
                                <input name="variation[<?php echo $product['id']; ?>][product_price]" type="number" class="form-control" placeholder="00.00" value="<?php echo ($product['product_price']) ? $product['product_price'] : ''; ?>"  />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Code</label>
                            <input name="variation[<?php echo $product['id']; ?>][product_code]" type="text" class="form-control" value="<?php echo ($product['product_code']) ? $product['product_code'] : '';  ?>" placeholder="Enter product code"  />
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Stock Level </label>
                            <input name="variation[<?php echo $product['id']; ?>][stock]" type="number" class="form-control" placeholder="0" value="<?php echo ($product['stock']) ? $product['stock'] : ''; ?>"  />
                        </div>

                    </div>
                    <!--			<div class="mb-3">-->
                    <!--				<label class="form-label">Secondary Image <span class="small">(W:250px x H:150px)</span></label>-->
                    <!--				<input class="form-control" type="file" name="variation_--><?php //echo $product['id']; ?><!--_secondary_image" accept="image/*" />-->
                    <!--				--><?php //if (isset($product['product_secondary_image'])) { ?>
                    <!--				<br/>-->
                    <!--				<a href="--><?php //echo $product['product_secondary_image']; ?><!--" target="_blank"><img src="--><?php //echo $product['product_secondary_image']; ?><!--" width="100" /></a>-->
                    <!--				--><?php //} ?>
                    <!--			</div>-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>