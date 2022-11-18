<?php

// Set global variables

$inc_url = $_ENV['APP_URL'] . "/_/inc";
$site_url = $_ENV['APP_URL'];
$img_url = $_ENV['APP_URL'] . "/_/img";
$svg_sprite_url = "/_/img/svg-sprite/svg-symbols.svg";


// set page variables
if (isset($currentPage)) {

	switch ($currentPage) {

		case 'products':

			if (isset($pageType) && $pageType == 'detail') {

				$products = Products::loadProducts();
				$wished = Cart::wishesCount($products[0]['id']);
				$category = Products::getCategory($products[0]['product_category']);

				$price = explode('.', $products[0]['product_price']);
				$was = explode('.', $products[0]['product_was_price']);
			}

			break;

		case 'account':

			if (isset($accountSection) && $accountSection == 'guarantee') {

				$products = Products::productGuarantees();
			}

			break;

		case 'payment':

			Order::checkOrder();

			break;

		case 'cart':

			if (isset($pageType) && $pageType == 'details') {

				if (Customer::LoggedIn()) {

					$profile = Customer::getProfile();
					$addresses = Customer::addresses();
				}

				if (empty(Order::data('first_name')) && Customer::LoggedIn()) {

					$first_name = $profile['first_name'];
				} else {

					$first_name = Order::data('first_name');
				}

				if (empty(Order::data('last_name')) && Customer::LoggedIn()) {

					$last_name = $profile['last_name'];
				} else {

					$last_name = Order::data('last_name');
				}

				if (empty(Order::data('email')) && Customer::LoggedIn()) {

					$email = $profile['email'];
				} else {

					$email = Order::data('email');
				}

				if (empty(Order::data('phone')) && Customer::LoggedIn()) {

					$tel_mobile = $profile['tel_mobile'];
				} else {

					$tel_mobile = Order::data('phone');
				}

				if (Customer::LoggedIn()) {

					$marketing = Customer::getNewsletter()['newsletter'];
				} else {

					if (isset($_POST['marketing-opt-in'])) {

						$marketing = $_POST['marketing-opt-in'];
					} else {

						$marketing = 0;
					}
				}
			} else if ($pageType == 'complete') {

				if (!empty($_SESSION['order']) && !empty($_SESSION['cart'])) {
					Order::emailOrder(); // Send order confirmation email
					Customer::newsletter(); // Add customer to newsletter (if set)
					$dummyData = array(array(1, 'Test Data')); // setup CSV placeholder data
					Order::send_csv_mail($dummyData, ""); // Send CSV to bots (2nd element is for msg body if required)
					DB::run('UPDATE orders SET order_status = ? WHERE id = ?', ['Processing Order', $_SESSION['order']['order_id']]); // mark order complete
				}

				if (Customer::LoggedIn()) {

					$marketing = Customer::getNewsletter()['newsletter'];
				} else {

					if (isset($_POST['marketing-opt-in'])) {

						$marketing = $_POST['marketing-opt-in'];
					} else {

						$marketing = 0;
					}
				}

				Order::endOrder();
			}

			break;
	}
}
