<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Products {

	
	public static function get($id) {

		return DB::run('SELECT * FROM products WHERE id = ? AND deleted_at IS NULL', [$id])->fetch();
	}


	public static function getPrice($id) {

		$price = DB::run('SELECT product_price FROM products WHERE id = ?', [$id])->fetch();

		$price = explode('.', $price['product_price']);

		return $price;
	}


	public static function getPromoPrice($product_id, $promo_id) {

		$full_price = DB::run('SELECT product_price FROM products WHERE id = ?', [$product_id])->fetch();
		$full_price = $full_price['product_price'];

		$promo = DB::run('SELECT * FROM vouchers WHERE id = ?', [$promo_id])->fetch();

		$discount_type = $promo['discount_type'];
		$discount_amount = $promo['discount_amount'];

		// echo $discount_type;
		// echo $discount_amount;
		
		if ($discount_type == 'amount') {
			$price = number_format( ($full_price - $discount_amount) ,2);
		}

		if ($discount_type == 'percentage') {
			// $discount = (float)$discount_amount * (float)$price;
			$price = number_format( $full_price - ( ($discount_amount * $full_price) / 100 ), 2 );
		}

		$price = explode('.', $price);

		return $price;
	}
	
	
	public static function getCategory($id) {

		return DB::run('SELECT * FROM product_categories WHERE id = ? AND deleted_at IS NULL', [$id])->fetch();
	}


	public static function getBrand($id) {

		return DB::run('SELECT * FROM product_brands WHERE product_id = ?', [$id])->fetch();
	}


	public static function where($id) {

		return DB::run('SELECT * FROM products WHERE id = ?', [$id])->fetch();
	}


	public static function categories() {

		return DB::run('SELECT * FROM product_categories')->fetchAll();
	}


	public static function brands() {

		return DB::run('SELECT * FROM product_brands ORDER BY name ASC')->fetchAll();
	}


	public static function categorySizes($sizes) {

		$ex = explode('|', $sizes);

		return $ex;
	}


	public static function categoryColors($colors) {

		$ex = explode('|', $colors);
		$array = [];
		
		foreach ($ex as $color) {

			$ex2 = explode(',', $color);

			$array[$ex2[0]] = $ex2[1];
		}

		return $array;
	}


    public static function categoryModels($models) {

        $ex = explode('|', $models);

        return $ex;
    }


	public static function all($where = []) {

		$sql = 'SELECT *, p.id AS id, pc.id AS product_category_id FROM products AS p LEFT OUTER JOIN product_categories AS pc ON p.product_category = pc.id ';

		if (!empty($where)) {

			$sql .= ' WHERE p.deleted_at IS NULL AND ';
			$sql_where = [];

			foreach ($where as $key => $value) {

				$sql .= $key.' = ? AND ';
				$sql_where[] = $value;
			}

			$sql = substr($sql, 0, -4);
			
			return DB::run($sql, $sql_where)->fetchAll();
		} else {
		
			return DB::run($sql.' WHERE p.deleted_at IS NULL')->fetchAll();
		}
	}


	public static function order() {

		$order_id = Session::get('order_id', 'order');
		if (isset($order_id) && !empty($order_id)) {

			return DB::run('SELECT * FROM products AS p JOIN products_orders AS po WHERE p.id = po.product_id AND po.order_id = ?', [$order_id])->fetchAll();
		} else {

			return false;
		}
	}

	public static function productGuarantees() {

		$customer_id = $_SESSION['customer']['id'];
		$sql = "SELECT * FROM customer_product_registrations WHERE customer_id = ? ORDER BY id DESC";

		return  DB::run($sql, [$customer_id]);
	}


	public static function registerProductAdd() {

		if (isset($_POST['submit'])) {

		    if (!is_numeric($_POST['amount'])) {

		        $amount_error = 'Amount must be a number';
		    } else {

			    $customer_id = $_SESSION['customer']['id'];
			    $firstname = $_POST['firstname'];
			    $lastname = $_POST['lastname'];
			    $customer_email = $_POST['email'];
			    $product = $_POST['product'];
                $quantity = $_POST['quantity'];
			    $retailer = $_POST['retailer'];
			    $date_of_purchase = $_POST['date'];
			    $amount_paid = $_POST['amount'];
			    $created = date("Y-m-d H:i:s");
			    $updated = date("Y-m-d H:i:s");

			    $inputData = [
			        $customer_id, 
			        $firstname, 
			        $lastname,
                    $customer_email,
			        $product,
                    $quantity,
			        $retailer, 
			        $date_of_purchase,
			        $amount_paid,
			        $created,
			        $updated
			    ];

			    $sql = "INSERT INTO customer_product_registrations (
	                customer_id, 
	                first_name, 
	                last_name, 
	                email, 
	                product,
                    quantity,
	                retailer, 
	                date_of_purchase, 
	                amount_paid, 
	                created_at,
	                updated_at
	                )
	            VALUES (
	                ?, 
	                ?, 
	                ?, 
	                ?,
	                ?,
                    ?,
	                ?,
	                ?,
	                ?,
	                ?,
	                ?
	            )";

		    	DB::run($sql, $inputData);

		    	$array = [
			        'first_name' => $firstname, 
			        'last_name' => $lastname,
			        'email' => $customer_email,
			        'product_name' => $product,
                    'quantity' => $quantity,
			        'retailer' => $retailer, 
			        'date_of_purchase' => $date_of_purchase,
			        'amount_paid' => $amount_paid
		    	];

		    	$email = Email::getTemplate(9, $array);

		    	Email::sendEmail($customer_email, $firstname.' '.$lastname, $email['subject'], $email['body']);

		    	Session::setFlash('success', 'Product Guarantee', 'Your product Guarantee has been registered.');
		    	Header('Location: /account/register-product/');
			}
		}
	}


//    public static function adminEmailGuarantees($orderId) { // PPEDIT added 22/03/2022
//
//
//
//        if (isset($_POST['submit'])) {
//
//            if (!is_numeric($_POST['amount'])) {
//
//                $amount_error = 'Amount must be a number';
//            } else {
//
//                $customer_id = $_SESSION['customer']['id'];
//                $firstname = $_POST['firstname'];
//                $lastname = $_POST['lastname'];
//                $email = $_POST['email'];
//                $product = $_POST['product'];
//                $quantity = $_POST['quantity'];
//                $retailer = $_POST['retailer'];
//                $date_of_purchase = $_POST['date'];
//                $amount_paid = $_POST['amount'];
//                $created = date("Y-m-d H:i:s");
//                $updated = date("Y-m-d H:i:s");
//
//                $inputData = [
//                    $customer_id,
//                    $firstname,
//                    $lastname,
//                    $email,
//                    $product,
//                    $quantity,
//                    $retailer,
//                    $date_of_purchase,
//                    $amount_paid,
//                    $created,
//                    $updated
//                ];
//
//                $sql = "INSERT INTO customer_product_registrations (
//	                customer_id,
//	                first_name,
//	                last_name,
//	                email,
//	                product,
//                    quantity,
//	                retailer,
//	                date_of_purchase,
//	                amount_paid,
//	                created_at,
//	                updated_at
//	                )
//	            VALUES (
//	                ?,
//	                ?,
//	                ?,
//	                ?,
//	                ?,
//                    ?,
//	                ?,
//	                ?,
//	                ?,
//	                ?,
//	                ?
//	            )";
//
//                DB::run($sql, $inputData);
//
//                $array = [
//                    'first_name' => $firstname,
//                    'last_name' => $lastname,
//                    'email' => $email,
//                    'product_name' => $product,
//                    'quantity' => $quantity,
//                    'retailer' => $retailer,
//                    'date_of_purchase' => $date_of_purchase,
//                    'amount_paid' => $amount_paid
//                ];
//
//                $email = Email::getTemplate(9, $array);
//
//                Email::sendEmail($email, $first_name.' '.$last_name, $email['subject'], $email['body']);
//
//                Session::setFlash('success', 'Product Guarantee', 'Your product Guarantee has been registered.');
//                Header('Location: /account/register-product/');
//            }
//        }
//    }


    
	public static function downloadGuarantee() {
		
		$customer_id = $_SESSION['customer']['id'];
		$guaranteeId = $_GET['id'];
//		$sql = "SELECT * FROM customer_product_registrations WHERE id = ? AND customer_id = ?";
//		$product = DB::run($sql, [$productId, $customer_id])->fetch();

        $sql = "SELECT * FROM customer_product_registrations as pr, products as p WHERE pr.id = ? AND pr.customer_id = ?";
        $guarantee = DB::run($sql, [$guaranteeId, $customer_id])->fetch();

        $order_id = Strings::replaceAll($guarantee['order_id']);
        $order = Order::get($order_id);
        $product = Products::get($guarantee['product_id']);

		$customer_first_name = Strings::replaceAll($guarantee['first_name']);
		$customer_last_name = Strings::replaceAll($guarantee['last_name']);
		$product_name = Strings::replaceAll($guarantee['product']);

        $order_no = $sap_no = $product_code = 'N/A';
        if (!empty($product['product_code'])) { $product_code = Strings::replaceAll($product['product_code']); }
        if (!empty($order['order_no'])) { $order_no = 'JB0000'.$order['order_no']; }
        if (!empty($order['sap_no'])) { $sap_no = $order['sap_no']; }

        $date = date('Y-m-d');
		$guarantee_output_string  = $customer_first_name . '-' . $customer_last_name .  '-' . $product_name . '-guarantee-' . $date . '.pdf';

    	ob_start();

    	include $_SERVER["DOCUMENT_ROOT"] . '/account/register-product/guarantee/guarantee.php';

	    $content = ob_get_clean();
	    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(10, 10, 10, 16));
	    $html2pdf->writeHTML($content);
	    $html2pdf->output($guarantee_output_string);
	}


	public static function loadProducts() {

		$path = explode("/index.php", $_SERVER['SCRIPT_NAME']);
		$website = Settings::$website_url;
		$search1 = $website . $path[0];
		$search2 = $search1 . '/';

		$sql = "SELECT * FROM products WHERE product_website_url = ? OR product_website_url = ? AND deleted_at IS NULL"; 
		//$sql = "SELECT * FROM products AS p LEFT OUTER JOIN products AS p2 ON p.id = p2.parent_id WHERE p.product_website_url = ? OR p.product_website_url = ?"; 
		return DB::run($sql, [$search1, $search2])->fetchAll();
	}


	public static function removeGuarantee($id = false) {

		if (!$id) {

			$id = $_GET['id'];
		}

		if (Customer::loggedIn()) {

            $customer_id = $_SESSION['customer']['id'];
            
            $sql = "DELETE FROM customer_product_registrations WHERE customer_id = ? AND id = ?";
            DB::run($sql, [$customer_id, $id]);

            $sql = "SELECT id FROM customer_product_registrations WHERE customer_id = ?";
            $count = DB::run($sql, [$customer_id])->rowCount();
            
            if ($count == 0) {

            	echo json_encode(['empty' => true]);
            } else {

            	echo json_encode(['empty' => false]);
            }
        }
	}


	public static function adminProductUpdate() {

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$product = DB::run('SELECT * FROM products WHERE id = ?', [$id])->rowCount();
			if ($product == 1) {

				$product_name = $_POST['product_name'];
				$product_nickname = isset($_POST['product_nickname']) ? $_POST['product_nickname'] : '';
				$stock = !empty($_POST['stock']) ? $_POST['stock'] : 0;
				$in_stock = $_POST['in_stock'];
				$product_website_url = $_POST['product_website_url'];
				$product_code = isset($_POST['product_code']) ? $_POST['product_code'] : '';
				$product_price = isset($_POST['product_price']) ? number_format($_POST['product_price'], 2) : 0.00;
				// $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : 0.00;
				$product_was_price = isset($_POST['product_was_price']) ? number_format((float) $_POST['product_was_price'], 2) : 0.00;
				$size = isset($_POST['size']) ? $_POST['size'] : '';
				$color = isset($_POST['color']) ? $_POST['color'] : '';
                $model = isset($_POST['model']) ? $_POST['model'] : '';
                $product_brand = isset($_POST['product_brand']) ? $_POST['product_brand'] : '';
				$product_subtitle = isset($_POST['product_subtitle']) ? $_POST['product_subtitle'] : '';
				$product_description = isset($_POST['product_description']) ? $_POST['product_description'] : '';

				if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
					
					$file = Files::upload_file($_FILES['image']);
					$thumbnail_image = $file['local_name'];
					DB::run('UPDATE products SET product_thumbnail_image = ? WHERE id = ?', [
						$thumbnail_image,
						$id
					]);
				}

//				if (isset($_FILES['secondary_image']['name']) && !empty($_FILES['secondary_image']['name'])) {
//
//					$file = Files::upload_file($_FILES['secondary_image']);
//					$secondary_image = $file['local_name'];
//					DB::run('UPDATE products SET product_secondary_image = ? WHERE id = ?', [
//						$secondary_image,
//						$id
//					]);
//				}

				DB::run('UPDATE products SET product_name = ?, product_nickname = ?, product_website_url = ?, stock = ?, in_stock = ?, product_code = ?, product_price = ?, product_was_price = ?, size = ?, color = ?, model = ?, product_brand = ?, product_subtitle = ?, product_description = ?, updated_at = ? WHERE id = ?', [
					$product_name,
					$product_nickname,
					$product_website_url,
					$stock,
					$in_stock,
					$product_code,
					$product_price,
					$product_was_price,
					$size,
					$color,
                    $model,
                    $product_brand,
					$product_subtitle,
					$product_description,
					date('Y-m-d h:i:s'),
					$id
				]);

				// Handle the product variations
				if (isset($_POST['variation'])) {

					foreach ($_POST['variation'] as $key => $variation) {

						if (isset($_FILES['variation_'.$key.'_image']['name']) && !empty($_FILES['variation_'.$key.'_image']['name'])) {
					
							$file = Files::upload_file($_FILES['variation_'.$key.'_image']);
							$thumbnail_image = $file['local_name'];
							DB::run('UPDATE products SET product_thumbnail_image = ? WHERE id = ?', [
								$thumbnail_image,
								$key
							]);
						}

						if (isset($_FILES['variation_'.$key.'_secondary_image']['name']) && !empty($_FILES['variation_'.$key.'_secondary_image']['name'])) {
							
							$file = Files::upload_file($_FILES['variation_'.$key.'_secondary_image']);
							$secondary_image = $file['local_name'];
							DB::run('UPDATE products SET product_secondary_image = ? WHERE id = ?', [
								$secondary_image,
								$key
							]);
						}

						$update_array = [
							$product_name,
							$product_nickname,
							$product_website_url,
							!empty($variation['stock']) ? $variation['stock'] : 0,
							isset($variation['product_code']) ? $variation['product_code'] : '',
							isset($variation['product_price']) ? number_format((float) $variation['product_price'], 2) : $product_price,
							isset($variation['product_was_price']) ? number_format((float) $variation['product_was_price'], 2) : $product_was_price,
							isset($variation['size']) ? $variation['size'] : '',
							isset($variation['color']) ? $variation['color'] : '',
                            isset($variation['model']) ? $variation['model'] : '',
							$product_subtitle,
							$product_description,
							date('Y-m-d h:i:s'),
							$key
						];

						DB::run('UPDATE products SET product_name = ?, product_nickname = ?, product_website_url = ?, stock = ?, product_code = ?, product_price = ?, product_was_price = ?, size = ?, color = ?, model = ?, product_subtitle = ?, product_description = ?, updated_at = ? WHERE id = ?', $update_array);
					}
				}
			}
		}
	}


	public static function adminAddProductVariation() {

		if (Customer::adminLoggedIn()) {

			$product_id = $_POST['product_id'];

			$parent_product = DB::run('SELECT * FROM products WHERE id = ?', [$product_id])->fetch();
			if (isset($parent_product['product_name'])) {

				DB::run('INSERT INTO products SET product_name = ?, product_website_url = ?, parent_id = ?, product_price = ?, product_was_price = ?', [
					$parent_product['product_name'],
					$parent_product['product_website_url'],
					$parent_product['id'], 
					0, 
					0
				]);

				$last_id = DB::lastInsertId();

				$product = DB::run('SELECT * FROM products WHERE id = ?', [$last_id])->fetch();
				$category = self::getCategory($parent_product['product_category']);
				
				require('admin/products/variation.php');
			}

			exit();
		}
	}


	public static function updateStock($product_id) {

		$product = DB::run('SELECT stock FROM products WHERE id = ?', [$product_id])->fetch();
		
		// Only update if more than zero
		if ($product['stock'] > 0) {
		
			$stock = $product['stock'] - 1;

			DB::run('UPDATE products SET stock = ? WHERE id = ?', [$stock, $product_id]);
		}
	}


	public static function adminAddProduct() {

		if (Customer::adminLoggedIn()) {

			$product_name = $_POST['product_name'];
			$product_category = $_POST['product_category'];
			
			$product = DB::run('INSERT INTO products SET product_name = ?, product_category = ?, product_price = ?, product_was_price = ?', [
				$product_name,
				$product_category,
				0,
				0
			]);

			echo DB::lastInsertId();
		}
	}


	public static function adminDeleteProduct() {

		if (Customer::adminLoggedIn()) {

			$product_id = $_POST['product_id'];

			DB::run('UPDATE products SET deleted_at = ? WHERE id = ?', [
				date('Y-m-d H:i:s'), 
				$product_id
			]);

			exit();
		}
	}


	public static function adminDeleteProductVariation() {

		if (Customer::adminLoggedIn()) {

			$product_id = $_POST['product_id'];

			DB::run('UPDATE products SET deleted_at = ? WHERE id = ?', [
				date('Y-m-d H:i:s'), 
				$product_id
			]);

			exit();
		}
	}

}
