<?php

$pageTitle = 'Store products';

include('../../_/inc/admin.header.inc.php');

$products = Pagination::getResults('products');
$product_categories = Products::categories();

?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Store</div>
  <div class="ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="/<?php echo ADMIN_FOLDER; ?>"><i class="bx bx-home-alt"></i></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->
<div class="card">
  <div class="card-body">
    <div class="d-lg-flex align-items-center mb-4 gap-3">
      <div class="position-relative">
        <form action="/<?php echo ADMIN_FOLDER; ?>/products/" method="post">
          <input required type="text" class="form-control ps-5 radius-30" placeholder="Search Products" name="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                                echo $_POST['search'];
                                                                                                                              } ?>"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
        </form>
      </div>
      <button class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bxs-plus-square'></i>Add Product</button>
    </div>
    <div class="table-responsive">
      <table class="table mb-0 table-striped">
        <thead>
          <tr class="table-light">
            <th scope="col">Image</th>
            <th scope="col">Code</th>
            <th scope="col">Product</th>
            <th scope="col">Size</th>
            <th scope="col">Category</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($products as $product) {
            $variants = Products::all(['parent_id' => $product['id']]);
          ?>
            <tr>
              <td scope="row"><img src="<?php echo $product['product_thumbnail_image']; ?>" width="100" /></td>
              <td scope="row"><?php echo $product['product_code']; ?></td>
              <td>
                <?php
                if (!empty($product['product_nickname'])) {
                  echo $product['product_nickname'];
                } else {
                  echo $product['product_name'];
                }
                ?>
              </td>
              <td>
                <?php
                if ($product['product_category'] == '3') {
                  echo 'As titled';
                } else if (!empty($variants)) {
                  echo 'Various';
                } else {
                  echo $product['size'];
                }
                ?>
              </td>
              <td><?php echo $product['name']; ?></td>
              <!-- <td>
                <?php
                if (!empty($variants)) {

                  echo 'View for details';
                } else if ($product['stock'] == 0) {

                  echo 'Out of stock';
                } else {

                  echo $product['stock'];
                }
                ?>
              </td> --> 
              <td>
              <?php
                if (!empty($variants)) {

                  echo "View for details";
                } else if ($product['in_stock'] == '1') {

                  echo "<span class='text-primary'>In stock</span>";
                } else {

                  echo "<span class='text-danger'>Out of stock</span>";
                }
                ?>
                </td>
              <td>&pound;<?php echo $product['product_price']; ?></td>
              <td>
                <div class="d-flex order-actions">
                  <a href="<?php echo $product['product_website_url']; ?>" class="" target="_blank"><i class='bx bxs-show'></i></a>
                  <a href="/<?php echo ADMIN_FOLDER; ?>/products/edit.php?id=<?php echo $product['id']; ?>" class="ms-3"><i class='bx bxs-edit'></i></a>
                  <a href="javascript:;" class="ms-3 delete_product" data-id="<?php echo $product['id']; ?>"><i class='bx bxs-trash'></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Enter the products name to continue.</p>
        <div class="col-12">
          <label for="product_name">Product name</label>
          <input type="text" class="form-control" id="product_name" name="product_name" value="" placeholder="Enter product name" />
        </div>
        <div class="col-12">
          <label for="product_category" class="form-label">Product Category</label>
          <select class="form-select" id="product_category" name="product_category">
            <?php foreach ($product_categories as $category) { ?>
              <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_product">Continue</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this product?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn alert-danger" id="delete_product" data-id="">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php include('../../_/inc/admin.footer.inc.php'); ?>