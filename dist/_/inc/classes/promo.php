<?php


class Promo {
	
	public static function init() {

		// $mail = new PHPMailer();
	    
	    // return $mail;
	}


    public static function all() {

		return DB::run('SELECT * FROM vouchers');
	}


    public static function get($id) {

		return DB::run('SELECT * FROM vouchers WHERE id = ?', [$id])->fetch();
	}


    public static function getProductPromos($product_id) {
		
		$product = DB::run('SELECT * FROM products WHERE id = ?', [$product_id])->fetch();
		$product_category = $product['product_category'];
		$product_brand = $product['product_brand'];
		
		
		$promo = DB::run('SELECT * FROM vouchers WHERE product_id_1 = '.$product_id.' OR product_id_2 = '.$product_id.' OR product_id_3 = '.$product_id.' OR product_id_4 = '.$product_id.' OR product_id_5 = '.$product_id.' OR product_id_6 = '.$product_id.' OR category_id = '.$product_category.' OR brand_id = '.$product_brand)->fetch();

		if ( !empty($promo) && $promo['is_active'] == true) {
			return $promo;
		} else {
			return false;
		}

	}

	
	public static function adminPromoUpdate()
	{

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$promo = DB::run('SELECT * FROM vouchers WHERE id = ?', [$id])->rowCount();
			if ($promo == 1) {

				if (!empty($_POST['is_active'])) {
					$is_active = $_POST['is_active'];
				} else {
					$is_active = '0';
				}
				
				$promo_code = $_POST['promo_code'];
				$promo_name = $_POST['promo_name'];
				$promo_description = $_POST['promo_description'];
				$discount_type = $_POST['discount_type'];
				$discount_amount = $_POST['discount_amount'];
				$applies_to = $_POST['applies_to'];
				$category_id = $_POST['category_id'];
				$brand_id = $_POST['brand_id'];
				$product_id_1 = $_POST['product_id_1'];
				$product_id_2 = $_POST['product_id_2'];
				$product_id_3 = $_POST['product_id_3'];
				$product_id_4 = $_POST['product_id_4'];
				$product_id_5 = $_POST['product_id_5'];
				$product_id_6 = $_POST['product_id_6'];
				$tracking_code = $_POST['tracking_code'];

				DB::run('UPDATE vouchers SET code = ?, name = ?, description = ?, discount_type = ?, discount_amount = ?, applies_to = ?, category_id = ?, brand_id = ?, product_id_1 = ?, product_id_2 = ?, product_id_3 = ?, product_id_4 = ?, product_id_5 = ?, product_id_6 = ?, tracking_code = ?, is_active = ? WHERE id = ?', [
					$promo_code,
					$promo_name,
					$promo_description,
                    $discount_type,
                    $discount_amount,
                    $applies_to,
                    $category_id,
                    $brand_id,
                    $product_id_1,
                    $product_id_2,
                    $product_id_3,
                    $product_id_4,
                    $product_id_5,
                    $product_id_6,
                    $tracking_code,
                    $is_active,
					$id
				]);
			}
		}
	}



	public static function adminPromoAdd()
	{

		if (Customer::adminLoggedIn()) {

			$promo_code = $_POST['promo_code'];
			$promo_name = $_POST['promo_name'];
			$promo_description = $_POST['promo_description'];
			$discount_type = $_POST['discount_type'];
			$discount_amount = $_POST['discount_amount'];
			$applies_to = $_POST['applies_to'];
			$category_id = $_POST['category_id'];
			$brand_id = $_POST['brand_id'];
			$product_id_1 = $_POST['product_id_1'];
			$product_id_2 = $_POST['product_id_2'];
			$product_id_3 = $_POST['product_id_3'];
			$product_id_4 = $_POST['product_id_4'];
			$product_id_5 = $_POST['product_id_5'];
			$product_id_6 = $_POST['product_id_6'];
			$tracking_code = $_POST['tracking_code'];
			$is_active = $_POST['tracking_code'];

			
			$sql = "INSERT INTO vouchers SET code = ?, name = ?, description = ?, discount_type = ?, discount_amount = ?, applies_to = ?, category_id = ?, brand_id = ?, product_id_1 = ?, product_id_2 = ?, product_id_3 = ?, product_id_4 = ?, product_id_5 = ?, product_id_6 = ?, tracking_code = ?, is_active = ?";
			$insert = DB::run($sql, [
				$promo_code,
				$promo_name,
				$promo_description,
				$discount_type,
				$discount_amount,
				$applies_to,
				$category_id,
				$brand_id,
				$product_id_1,
				$product_id_2,
				$product_id_3,
				$product_id_4,
				$product_id_5,
				$product_id_6,
				$tracking_code,
				$is_active,
			]);

		}

	}



    public static function adminDeletePromo() 
	{

        if (Customer::adminLoggedIn()) {

            $promo_id = $_POST['promo_id'];

            DB::run('DELETE FROM vouchers WHERE id = ?', [
                $promo_id
            ]);

            exit();
        }
    }

	

}