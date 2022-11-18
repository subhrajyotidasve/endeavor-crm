<?php

class Country {
	
	public static function init() {

	}

    public static function get($id) {

        $sql = "SELECT * FROM countries WHERE id = ?";
        $result = DB::run($sql, [$id])->fetch();

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }

    public static function adminAddCountry() {

        if (Customer::adminLoggedIn()) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];

            $customer = DB::run('INSERT INTO customers SET first_name = ?, last_name = ?, email = ?', [
                $first_name,
                $last_name,
                $email
            ]);

            echo DB::lastInsertId();
        }
    }


	public static function adminCountryUpdate() {

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$customer = DB::run('SELECT * FROM customers WHERE id = ?', [$id])->rowCount();
			if ($customer == 1) {

				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$stock = $_POST['stock'];
				$tel_mobile = $_POST['tel_mobile'];
				
				if (isset($_POST['admin']) && !empty($_POST['admin'])) {

					$admin = 1;
				} else {

					$admin = 0;
				}

				DB::run('UPDATE customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, admin = ?, updated_at = ? WHERE id = ?', [
					$first_name,
					$last_name,
					$email,
					$tel_mobile,
					$admin,
					date('Y-m-d h:i:s'),
					$id
				]);

				// Update password
				if (!empty($_POST['password'])) {

			        $password = $_POST['password'];

			        $sql = "UPDATE customers SET password = ?, updated_at = ? WHERE id = ?";
		        	DB::run($sql, [password_hash($password, PASSWORD_DEFAULT), date('Y-m-d H:i:s'), $id]);
			    }
			}
		}
	}

	public static function adminDeleteCountry() {

		if (Customer::adminLoggedIn()) {

			$customer_id = $_POST['customer_id'];

			DB::run('UPDATE customers SET deleted_at = ? WHERE id = ?', [
				date('Y-m-d H:i:s'), 
				$customer_id
			]);

			exit();
		}
	}

}

Country::init();
