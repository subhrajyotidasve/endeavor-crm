<?php

class Customer
{

	public static function init()
	{
	}

	//    public static function get($customer_id = false) {
	//
	//        if (!$customer_id) {
	//            $customer_id = Customer::data('id');
	//        }
	//
	//        $sql = "SELECT * FROM customers WHERE id = ? ORDER BY id DESC";
	//        return DB::run($sql, [$customer_id])->fetchAll();
	//
	//    }

	public static function loggedIn()
	{

		if (self::data('id') && self::data('id') != 'GUEST') {
			return true;
		} else {
			return false;
		}
	}

	public static function logout()
	{

		session_destroy();

		header("location: /");
	}

	public static function login()
	{

		$email = $_POST['email'];
		$password = $_POST['password'];

		if ($customer = self::getEmail($email)) {

			if (password_verify($_POST['password'], $customer['password'])) {

				$_SESSION['customer']['id'] = $customer['id'];
				$_SESSION['customer']['first_name'] = $customer['first_name'];
				$_SESSION['customer']['last_name'] = $customer['last_name'];
				$_SESSION['customer']['email'] = $customer['email'];
				$_SESSION['customer']['tel_mobile'] = $customer['tel_mobile'];
				$_SESSION['customer']['user_avatar'] = $customer['user_avatar'];

				if (isset($_POST['remember']) && $_POST['remember'] == 'true') {

					setcookie('remember', $customer['email'], time() + 3600 * 24 * 30);
				} else {

					setcookie('remember', '');
				}

				// Cart::sync();

				if ($customer['admin'] == 1) {

					$_SESSION['admin'] = true;
					echo json_encode(['status' => true, 'redirect' => ADMIN_FOLDER . '/leads/new-requests/']);
				} else {

					echo json_encode(['status' => true, 'redirect' => false]);
				}
			} else {

				echo json_encode(['status' => false, 'message' => 'Email address or Password does not match our records.']);
			}
		} else {

			echo json_encode(['status' => false, 'message' => 'Email address or Password does not match our records.']);
		}
	}

	public static function forgotPassword()
	{

		if (isset($_POST['email'])) {

			$email = $_POST['email'];

			$customer = DB::run('SELECT email, first_name, last_name FROM customers WHERE email = ?', [$email])->fetch();

			if (isset($customer['email'])) {

				$token = bin2hex(random_bytes(18));

				DB::run('UPDATE customers SET remember_token = ? WHERE email = ?', [$token, $customer['email']]);

				$array = [
					'first_name' => $customer['first_name'],
					'last_name' => $customer['last_name'],
					'url' => $_ENV['APP_URL'] . '/account/forgot-password/reset.php?token=' . $token,
				];

				$email_id = 4;

				$email = Email::getTemplate($email_id, $array);

				Email::sendEmail($customer['email'], $customer['first_name'] . ' ' . $customer['last_name'], $email['subject'], $email['body']);

				echo json_encode(['status' => true]);
			} else {

				echo json_encode(['status' => false]);
			}
		} else {

			echo json_encode(['status' => false]);
		}
	}

	public static function data($key = '')
	{

		if (isset($_SESSION['customer'])) {

			if (isset($_SESSION['customer'][$key])) {

				return $_SESSION['customer'][$key];
			}

			return false;
		}

		return false;
	}

	public static function removeAddress()
	{

		if (Customer::loggedIn()) {

			$customer_id = $_SESSION['customer']['id'];

			$address_id = $_POST['id'];

			DB::run('DELETE FROM customer_addresses WHERE id = ? AND customer_id = ?', [$address_id, $customer_id]);

			$sql = 'SELECT count(*) FROM customer_addresses WHERE id = ?';
			$stmt = DB::prepare($sql);
			$stmt->execute([$customer_id]);

			if ($stmt->rowCount() > 0) {

				echo json_encode(['empty' => true]);
			} else {

				echo json_encode(['empty' => false]);
			}
		}
	}

	public static function checkCookie()
	{

		if (isset($_COOKIE['jaybe-remember'])) {

			$remember_token = $_COOKIE['jaybe-remember'];
			$sql = "SELECT * FROM customers WHERE remember_token = ?";
			$customer = DB::run($sql, [$remember_token])->fetch();

			if ($customer) {

				$_SESSION['customer'] = $customer;

				return true;
			}
		}

		return false;
	}

	public static function newsletter()
	{

		if (isset($_POST['order-newsletter'])) {

			$date = date("Y-m-d H:i:s");
			$customer_id = ($_SESSION['customer']['id'] == 'GUEST') ? null : $_SESSION['customer']['id'];
			$email = $_SESSION['order']['email'];

			if (Customer::loggedIn()) {

				$newsletter = 1;
				$sql = "UPDATE customers SET newsletter = ?, updated_at = ? WHERE email = ?";
				DB::run($sql, [$newsletter, $date, $email]);
			}

			$sql = "SELECT email FROM marketing WHERE email = ?";
			$stmt = DB::prepare($sql);
			$stmt->execute([$email]);

			if ($stmt->rowCount() > 0) {

				$sql = "UPDATE marketing SET customer_id = ?, active = ?, updated_at = ? WHERE email = ?";
				DB::run($sql, [$customer_id, 1, $date, $email]);
			} else {

				$sql = "INSERT INTO marketing (customer_id, email, created_at, updated_at) VALUES (?,?,?,?)";
				$inputData = [$customer_id, $email, $date, $date];
				DB::run($sql, $inputData);
			}
		}
	}

	public static function addressPrimary()
	{

		if (isset($_POST['primary'])) {

			$primary = $_POST['primary'];
			$customer_id = $_SESSION['customer']['id'];
			$addressId = $_POST['id'];
			$updated = date("Y-m-d H:i:s");

			$sql = "UPDATE customer_addresses SET is_primary = 0, updated_at = ? WHERE customer_id = ? AND active = 1 AND is_primary = 1";
			DB::run($sql, [$updated, $customer_id]);

			$sql = "UPDATE customer_addresses SET is_primary = ?, updated_at = ? WHERE id = ? AND customer_id = ? AND active = 1";
			DB::run($sql, [$primary, $updated, $addressId, $customer_id]);
		}
	}

	public static function resetPassword()
	{

		if (isset($_REQUEST['token']) && !empty($_REQUEST['token'])) {

			$token = $_REQUEST['token'];
			$customer = DB::run('SELECT email FROM customers WHERE remember_token = ?', [$token])->fetch();

			if (isset($customer['email'])) {

				if (isset($_POST['submit'])) {

					$password = $_POST['password'];
					$confirm_password = $_POST['confirm_password'];

					if ($password === $confirm_password) {

						if (Strings::validate_password($password)) {

							DB::run('UPDATE customers SET password = ?, remember_token = ? WHERE remember_token = ?', [password_hash($password, PASSWORD_DEFAULT), NULL, $token]);

							Session::setFlash('success', 'Passwords reset', 'Your password has been reset.', ['password_reset']);
						} else {

							Session::setFlash('error', 'Password not secure', 'The passwords you have entered do not follow the rules.', ['password_invalid']);
						}
					} else {

						Session::setFlash('error', 'Password not secure', 'The passwords you have entered do not follow the rules.', ['password_not_matching']);
					}
				}
			} else {

				Session::setFlash('error', 'Invalid reset password', 'The link you have clicked is invalid.', ['invalid']);
			}
		} else {

			Session::setFlash('error', 'Invalid reset password', 'The link you have clicked is invalid.', ['invalid']);
		}
	}

	public static function addresses()
	{

		$address = [];

		$customer_id = $_SESSION['customer']['id'];

		if (isset($_GET['id'])) {

			$addressId = $_GET['id'];
			$sql = "SELECT * FROM customer_addresses WHERE id = ? AND customer_id = ? AND active = 1";
			$address = DB::run($sql, $pdo, [$addressId, $customer_id])->fetch();
		} else {

			$sql = "SELECT * FROM customer_addresses WHERE customer_id = ? AND active = 1 ORDER BY is_primary DESC";
			$address = DB::run($sql, [$customer_id])->fetchAll();
		}

		return $address;
	}

	public static function addAddress()
	{

		$errors = [];
		$inputs = [];

		if (isset($_POST['submit'])) {

			$customer_id = $_SESSION['customer']['id'];
			$sql = "SELECT id from customer_addresses WHERE customer_id = ? AND active = 1";
			$stmt = DB::prepare($sql);
			$stmt->execute([$customer_id]);
			$count = $stmt->fetchColumn();
			if ($count) {

				$primary = 0;
			} else {

				$primary = 1;
			}

			$inputData = [
				$customer_id,
				'', // Slug 
				'DEFAULT',
				$primary,
				$_POST['nickname'],
				$_POST['first_name'],
				$_POST['last_name'],
				$_POST['address1'],
				$_POST['address2'],
				$_POST['city'],
				$_POST['postcode'],
				1,
				date("Y-m-d H:i:s"),
				date("Y-m-d H:i:s")
			];

			foreach ($inputs as $key => $value) {

				if (Strings::validateString($value, $key)) {

					$errors[$key] = Strings::validateString($value, $key);
				}
			}

			$sql = "INSERT INTO customer_addresses (
		                customer_id, 
		                slug, 
		                address_type, 
		                is_primary, 
		                nickname, 
		                first_name, 
		                last_name, 
		                address1, 
		                address2, 
		                city, 
		                postcode,
		                active,
		                created_at,
		                updated_at 
		                )
		            VALUES (
		                ?, -- customer_id 
		                ?, -- slug
		                ?, -- address_type
		                ?, -- is_primary
		                ?, -- nickname
		                ?, -- first_name
		                ?, -- last_name
		                ?, -- address1
		                ?, -- address2
		                ?, -- city
		                ?, -- postcode
		                ?, -- active
		                ?, -- created
		                ?  -- updated
		                )";
			if (count($errors) == 0) {

				if (!DB::run($sql, $inputData)) {

					$address_id = $pdo->lastInsertId();
					header("Location: /account/address-books/");
				} else {

					header("Location: /account/address-books/");
				}
			} else {
			}
		}
	}

	public static function updateProfile()
	{

		if (isset($_POST['submit'])) {

			$customer_id = $_SESSION['customer']['id'];

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$tel_mobile = $_POST['tel_mobile'];
			$date = date('Y-m-d:H:i:s');

			if (!empty($_POST['password'])) {

				$data = null;
				$password = $_POST['password'];
				$confirm_password = $_POST['confirm_password'];

				$sql = "UPDATE customers SET password = ?, updated_at = ? WHERE id = ?";
				DB::run($sql, [password_hash($password, PASSWORD_DEFAULT), $date, $customer_id]);
			}

			$sql = "UPDATE customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, updated_at = ? WHERE id = ?";
			DB::run($sql, [$first_name, $last_name, $email, $tel_mobile, $date, $customer_id]);

			$_SESSION['customer']['first_name'] = $first_name;
			$_SESSION['customer']['last_name'] = $last_name;
			$_SESSION['customer']['email'] = $email;
			$_SESSION['customer']['tel_mobile'] = $tel_mobile;

			Session::setFlash('success', 'Profile updated', 'Your profile details has been updated.');
			return true;
		} else {

			return false;
		}
	}

	public static function registerAccount()
	{

		if (isset($_POST['submit'])) {

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$tel_mobile = $_POST['tel_mobile'];
			$date = date('Y-m-d:H:i:s');
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
			$marketing = isset($_POST['marketing']) ? 1 : 0;

			$check_email = DB::run('SELECT email, id FROM customers WHERE email = ?', [$email])->fetch();

			if (isset($check_email['email'])) {

				Session::setFlash('error', 'Email already exists', 'The email address you have entered already exists.', ['alert_email_exists']);
			} else {

				if (!empty($password) && $password === $confirm_password) {

					if (empty($first_name) || empty($last_name) || empty($email) || empty($tel_mobile)) {

						Session::setFlash('error', 'All fields required', 'Please make sure you enter all the fields.');
					} else {

						if (Strings::validate_password($password)) {

							$password = password_hash($password, PASSWORD_DEFAULT);

							$sql = "INSERT INTO customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, newsletter = ?, password = ?, updated_at = ?";
							$insert = DB::run($sql, [$first_name, $last_name, $email, $tel_mobile, $marketing, $password, $date]);
							$customer_id = DB::lastInsertId();

							// check if they got the newsletter before signup
							$sql = "SELECT email FROM marketing WHERE email = ?";
							$stmt = DB::prepare($sql);
							$stmt->execute([$email]);

							if ($stmt->rowCount() > 0) {

								$sql = "UPDATE marketing SET customer_id = ?, active = ?, updated_at = ? WHERE email = ?";
								DB::run($sql, [$customer_id, $marketing, $date, $email]);
							} else {

								$sql = "INSERT INTO marketing (customer_id, email, active, created_at, updated_at) VALUES (?,?,?,?,?)";
								DB::run($sql, [$customer_id, $email, $marketing, $date, $date]);
							}

							$customer_email = $email;

							$array = [
								'first_name' => $first_name,
								'last_name' => $last_name,
								'email' => $customer_email,
								'tel_mobile' => $tel_mobile
							];

							$email = Email::getTemplate(3, $array);
							Email::sendEmail($customer_email, $first_name . ' ' . $last_name, $email['subject'], $email['body']);

							Session::setFlash('success', 'Account registered', 'Your account has been registered.', ['account_registered']);
						} else {

							Session::setFlash('error', 'Password not secure', 'The passwords you have entered do not follow the rules.', ['password_invalid']);
						}
					}
				} else {

					Session::setFlash('error', 'Passwords do not match', 'The passwords you have entered do not match.', ['password_not_matching']);
				}


				// Link existing orders
				// echo '<p>Customer ID: '. $customer_id.'</p>';
				// echo '<p>Customer EMail: '. $customer_email.'</p>';

				if (!empty($customer_id) && !empty($customer_email)) {
					$sql = "UPDATE orders SET customer_id = ? WHERE customer_email = ?";
					DB::run($sql, [$customer_id, $customer_email]);




					// Link product guarantees
					$orders = DB::run('SELECT * FROM orders WHERE customer_id = ?', [$customer_id])->fetchAll();

					//                echo '<p>ORDERS</p>';
					//                var_dump($orders);
					//                echo '<p>&nbsp</p>';

					if (!empty($orders)) {
						foreach ($orders as $order) {

							$products = DB::run('SELECT * FROM products_orders WHERE order_id = ?', [$order['id']])->fetchAll();

							//                    echo '<p>PRODUCTS</p>';
							//                    var_dump($products);
							//                    echo '<p>&nbsp</p>';

							if (!empty($products)) {
								foreach ($products as $product) {

									//                        var_dump($product);
									//                        echo '<p>&nbsp</p>';

									$sql = "INSERT INTO customer_product_registrations (
							customer_id, 
							first_name, 
							last_name, 
							email, 
							product,
							quantity,
							product_id,
							retailer,
							date_of_purchase,
							amount_paid, 
							created_at,
							updated_at,
							order_id
							)
							VALUES (
							?, -- customer_id
							?, -- first_name
							?, -- last_name
							?, -- email
							?, -- product
							?, -- quantity
							?, -- product ID
							?, -- retailer
							?, -- date_of_purchase
							?, -- amount_paid
							?, -- created_at
							?, -- updated_at,
							? -- order id
							)";

									$stmt = DB::prepare($sql);

									$stmt->execute([
										$customer_id,
										$order['customer_first_name'],
										$order['customer_last_name'],
										$order['customer_email'],
										$product['product_name'],
										$product['quantity'],
										$product['product_id'],
										'jaybe.com',
										$order['created_at'],
										$product['pos_price'],
										$date,
										$date,
										$order['id']
									]);
								} // end foreach products
							} // end if not empty products


						} // end foreach orders
					} // end if not empty orders

				}
			}
		}
	}

	public static function updateAddress()
	{

		if (isset($_POST['submit'])) {

			$customer_id = $_SESSION['customer']['id'];

			$id = $_POST['id'];
			$nickname = $_POST['nickname'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$postcode = $_POST['postcode'];
			$date = date('Y-m-d:H:i:s');

			$sql = "UPDATE customer_addresses SET nickname = ?, first_name = ?, last_name = ?, address1 = ?, address2 = ?, city = ?, postcode = ?, updated_at = ? WHERE id = ? AND customer_id = ?";
			DB::run($sql, [$nickname, $first_name, $last_name, $address1, $address2, $city, $postcode, $date, $id, $customer_id]);

			Session::setFlash('success', 'Address updated', 'Your address details has been updated.');

			return true;
		} else {

			return false;
		}
	}

	public static function getAddress()
	{

		$customer_id = $_SESSION['customer']['id'];

		if (isset($_GET['id'])) {

			$addressId = $_GET['id'];
			$sql = "SELECT * FROM customer_addresses WHERE id = ? AND customer_id = ? AND active = 1";
			return DB::run($sql, [$addressId, $customer_id])->fetch();
		} else {

			$sql = "SELECT * FROM customer_addresses WHERE customer_id = ? AND active = 1 ORDER BY is_primary DESC";
			return DB::run($sql, [$customer_id])->fetch();
		}
	}

	public static function getNewsletter()
	{

		$customer_id = $_SESSION['customer']['id'];
		$sql = "SELECT newsletter FROM customers WHERE id = ?";
		$newsletter = DB::run($sql, [$customer_id])->fetch();

		return $newsletter;
	}

	public static function updateNewsletter()
	{

		if (isset($_POST['newsletter'])) {

			$date = date("Y-m-d H:i:s");
			$customer_id = $_SESSION['customer']['id'];

			switch ($_POST['newsletter']) {

				case 'add':

					$sql = "UPDATE customers SET newsletter = ?, updated_at = ? WHERE id = ?";
					DB::run($sql, [1, $date, $customer_id]);

					$sql = "UPDATE marketing SET active = ?, updated_at = ? WHERE customer_id = ?";
					DB::run($sql, [1, $date, $customer_id]);

					break;

				case 'remove':

					$sql = "UPDATE customers SET newsletter = ?, updated_at = ? WHERE id = ?";
					DB::run($sql, [0, $date, $customer_id]);

					$sql = "UPDATE marketing SET active = ?, updated_at = ? WHERE customer_id = ?";
					DB::run($sql, [0, $date, $customer_id]);

					break;
			}
		}
	}

	public static function getProfile()
	{

		$customer_id = $_SESSION['customer']['id'];
		$sql = "SELECT * FROM customers WHERE id = ?";
		return DB::run($sql, [$customer_id])->fetch();
	}

	public static function get($id)
	{

		$sql = "SELECT * FROM customers WHERE id = ?";
		$result = DB::run($sql, [$id])->fetch();

		if ($result) {

			return $result;
		} else {

			return false;
		}
	}

	public static function getEmail($email)
	{

		$sql = "SELECT * FROM customers WHERE deleted_at IS NULL AND email = ?";
		$result = DB::run($sql, [$email])->fetch();

		if ($result) {

			return $result;
		} else {

			return false;
		}
	}

	public static function totalOrders($id)
	{

		return DB::run('SELECT id FROM orders WHERE customer_id = ?', [$id])->rowCount();
	}

	public static function all($where = [])
	{

		$sql = 'SELECT * FROM customers';

		if (!empty($where)) {

			$sql .= ' WHERE deleted_at IS NULL AND ';
			$sql_where = [];

			foreach ($where as $key => $value) {

				$sql .= $key . ' = ? AND ';
				$sql_where[] = $value;
			}

			$sql = substr($sql, 0, -4);
			return DB::run($sql, $sql_where)->fetchAll();
		} else {

			return DB::run($sql . ' WHERE deleted_at IS NULL')->fetchAll();
		}
	}

	public static function adminLoggedIn()
	{

		if (isset($_SESSION['admin'])) {

			return true;
		} else {

			return false;
		}
	}

	public static function createOrderAccount()
	{



		if (!empty($_POST['password']) && $_POST['password'] === $_POST['confirm_password']) {


			if (Strings::validate_password($_POST['password'])) {



				$order_id = $_SESSION['order']['order_id'];

				$order = Order::getOrder($order_id);

				// Insert the customer data
				$insert = DB::run('INSERT INTO customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, newsletter = ?, password = ?, created_at = ?, updated_at = ?', [
					$order['customer_first_name'],
					$order['customer_last_name'],
					$order['customer_email'],
					$order['customer_tel_mobile'],
					$_POST['marketing'],
					password_hash($_POST['password'], PASSWORD_DEFAULT),
					date('Y-m-d H:i:s'),
					date('Y-m-d H:i:s')
				]);

				$customer_id = DB::lastInsertId();

				if ($customer_id > 0) {

					// Update order with customers ID
					DB::run('UPDATE orders SET customer_id = ? WHERE id = ?', [
						$customer_id,
						$order_id
					]);

					// Add the customer address to address book
					DB::run('INSERT INTO customer_addresses (
																	customer_id,
																	slug,
																	address_type,
																	is_primary,
																	nickname,
																	first_name,
																	last_name,
																	address1,
																	address2,
																	city,
																	postcode,
																	active,
																	created_at,
																	updated_at
																) VALUES (
																	?, -- customer_id
																	?, -- slug
																	?, -- address_type
																	?, -- is_primary
																	?, -- nickname
																	?, -- first_name
																	?, -- last_name
																	?, -- address1
																	?, -- address2
																	?, -- city
																	?, -- postcode
																	?, -- active
																	?, -- created
																	?  -- updated
																)', [
						$customer_id,
						'',
						'SHIPPING',
						1,
						'',
						$order['customer_first_name'],
						$order['customer_last_name'],
						$order['customer_address1'],
						$order['customer_address2'],
						$order['customer_city'],
						$order['customer_postcode'],
						1,
						date('Y-m-d H:i:s'),
						date('Y-m-d H:i:s')
					]);

					// Add billing address if it is different
					if ($order['customer_billing_address_same'] == 0) {

						DB::run('INSERT INTO customer_addresses (
																		customer_id,
																		slug,
																		address_type,
																		is_primary,
																		nickname,
																		first_name,
																		last_name,
																		address1,
																		address2,
																		city,
																		postcode,
																		active,
																		created_at,
																		updated_at
																	) VALUES (
																		?, -- customer_id
																		?, -- slug
																		?, -- address_type
																		?, -- is_primary
																		?, -- nickname
																		?, -- first_name
																		?, -- last_name
																		?, -- address1
																		?, -- address2
																		?, -- city
																		?, -- postcode
																		?, -- active
																		?, -- created
																		?  -- updated
																	)', [
							$customer_id,
							'',
							'BILLING',
							0,
							'',
							$order['customer_first_name'],
							$order['customer_last_name'],
							$order['customer_billing_address1'],
							$order['customer_billing_address2'],
							$order['customer_billing_city'],
							$order['customer_billing_postcode'],
							1,
							date('Y-m-d H:i:s'),
							date('Y-m-d H:i:s')
						]);
					}


					// Link product guarantees
					$orders = DB::run('SELECT * FROM orders WHERE customer_id = ?', [$customer_id])->fetchAll();

					//                echo '<p>ORDERS</p>';
					//                var_dump($orders);
					//                echo '<p>&nbsp</p>';

					if (!empty($orders)) {
						foreach ($orders as $order) {

							$products = DB::run('SELECT * FROM products_orders WHERE order_id = ?', [$order['id']])->fetchAll();

							//                    echo '<p>PRODUCTS</p>';
							//                    var_dump($products);
							//                    echo '<p>&nbsp</p>';

							if (!empty($products)) {
								foreach ($products as $product) {

									//                        var_dump($product);
									//                        echo '<p>&nbsp</p>';

									$sql = "INSERT INTO customer_product_registrations (
																			customer_id, 
																			first_name, 
																			last_name, 
																			email, 
																			product,
																			quantity,
																			product_id,
																			retailer,
																			date_of_purchase,
																			amount_paid, 
																			created_at,
																			updated_at,
																			order_id
																			)
																			VALUES (
																			?, -- customer_id
																			?, -- first_name
																			?, -- last_name
																			?, -- email
																			?, -- product
																			?, -- quantity
																			?, -- product ID
																			?, -- retailer
																			?, -- date_of_purchase
																			?, -- amount_paid
																			?, -- created_at
																			?, -- updated_at,
																			? -- order id
																			)";

									$stmt = DB::prepare($sql);

									$stmt->execute([
										$customer_id,
										$order['customer_first_name'],
										$order['customer_last_name'],
										$order['customer_email'],
										$product['product_name'],
										$product['quantity'],
										$product['product_id'],
										'jaybe.com',
										$order['created_at'],
										$product['pos_price'],
										date('Y-m-d H:i:s'),
										date('Y-m-d H:i:s'),
										$order['id']
									]);
								} // end foreach products
							} // end if not empty products


						} // end foreach orders
					} // end if not empty orders


					$customer_email = $order['customer_email'];
					$first_name = $order['customer_first_name'];
					$last_name = $order['customer_last_name'];
					$tel_mobile = '';

							$array = [
								'first_name' => $first_name,
								'last_name' => $last_name,
								'email' => $customer_email,
								'tel_mobile' => $tel_mobile
							];

							$email = Email::getTemplate(3, $array);
							Email::sendEmail($customer_email, $first_name . ' ' . $last_name, $email['subject'], $email['body']);

							Session::setFlash('success', 'Account registered', 'Your account has been registered.', ['account_registered']);
					
					
					// Login the customer
					$_SESSION['customer']['id'] = $customer_id;
					$_SESSION['customer']['first_name'] = $order['customer_first_name'];
					$_SESSION['customer']['last_name'] = $order['customer_last_name'];
					$_SESSION['customer']['email'] = $order['customer_email'];
					$_SESSION['customer']['tel_mobile'] = $order['customer_tel_mobile'];

					echo json_encode(['status' => true]);
				} else {

					echo json_encode(['status' => false]);
				}
			} else {

				// Session::setFlash('error', 'Password not secure', 'The passwords you have entered do not follow the rules.', ['password_invalid']);
				echo json_encode(['error' => 'Sorry but the passwords you have entered do not follow our rules. Please see below under the password fields for more details.']);
				// echo 'Password not secure';

			}
		} else {

			// Session::setFlash('error', 'Passwords do not match', 'The passwords you have entered do not match.', ['password_not_matching']);
			echo json_encode(['error' => 'The passwords you have entered do not match']);
			// echo 'Passwords do not match';
		}
	}

	public static function adminAddCustomer()
	{

		if (Customer::adminLoggedIn()) {

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$tel_mobile = $_POST['tel_mobile'];

			$customer = DB::run('INSERT INTO customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?', [
				$first_name,
				$last_name,
				$email,
				$tel_mobile
			]);

			echo DB::lastInsertId();
		}
	}



	public static function adminAddAdmin()
	{

		if (Customer::adminLoggedIn()) {

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$tel_mobile = $_POST['tel_mobile'];

			$check_email = DB::run('SELECT email, id FROM customers WHERE email = ?', [$email])->fetch();

			if (isset($check_email['email'])) {

				// do nothing - returns null and fires alert

			} else {
			
			$customer = DB::run('INSERT INTO customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, admin = ?', [
				$first_name,
				$last_name,
				$email,
				$tel_mobile,
				1
			]);

			echo DB::lastInsertId();

			}
		}
	}



	public static function adminCustomerUpdate()
	{

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$customer = DB::run('SELECT * FROM customers WHERE id = ?', [$id])->rowCount();
			if ($customer == 1) {

				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$tel_mobile = $_POST['tel_mobile'];
				$newsletter = $_POST['newsletter'];

				DB::run('UPDATE customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, admin = ?, newsletter = ?, updated_at = ? WHERE id = ?', [
					$first_name,
					$last_name,
					$email,
					$tel_mobile,
					0,
					$newsletter,
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



	public static function adminAdminUpdate()
	{

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$customer = DB::run('SELECT * FROM customers WHERE id = ?', [$id])->rowCount();
			if ($customer == 1) {

				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$tel_mobile = $_POST['tel_mobile'];


				// update avatar image
				if (isset($_FILES['user_avatar']['name']) && !empty($_FILES['user_avatar']['name'])) {

					$file = Files::upload_file($_FILES['user_avatar']);
					$user_avatar = $file['local_name'];
					DB::run('UPDATE customers SET user_avatar = ? WHERE id = ?', [
						$user_avatar,
						$id
					]);
				}


				DB::run('UPDATE customers SET first_name = ?, last_name = ?, email = ?, tel_mobile = ?, admin = ?, updated_at = ? WHERE id = ?', [
					$first_name,
					$last_name,
					$email,
					$tel_mobile,
					1,
					date('Y-m-d h:i:s'),
					$id
				]);


				// Update password
				if ((!empty($_POST['password']))  &&  ($_POST['password'] === $_POST['confirm_password'])) {

					if (Strings::validate_password($_POST['password'])) {

						$password = $_POST['password'];

						$sql = "UPDATE customers SET password = ?, updated_at = ? WHERE id = ?";
						DB::run($sql, [password_hash($password, PASSWORD_DEFAULT), date('Y-m-d H:i:s'), $id]);
					} else {

						echo json_encode(['error' => 'The password you have entered is not secure.']);
						die();
					}	// end if password validated

				} else {

					echo json_encode(['error' => 'The passwords are empty or do not match.']);
					die();
				}
			} // end if $customer

		}

		echo json_encode(['status' => true]);
	}




	public static function adminDeleteCustomer()
	{

		if (Customer::adminLoggedIn()) {

			$customer_id = $_POST['customer_id'];

			DB::run('UPDATE customers SET deleted_at = ? WHERE id = ?', [
				date('Y-m-d H:i:s'),
				$customer_id
			]);

			exit();
		}
	}

	public static function adminEmailUpdate()
	{

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$email = DB::run('SELECT * FROM emails WHERE id = ?', [$id])->rowCount();
			if ($email == 1) {

				$subject = $_POST['subject'];
				$body = $_POST['body'];

				DB::run('UPDATE emails SET subject = ?, body = ?, updated_at = ? WHERE id = ?', [
					$subject,
					$body,
					date('Y-m-d h:i:s'),
					$id
				]);
			}
		}
	}
}

Customer::init();
