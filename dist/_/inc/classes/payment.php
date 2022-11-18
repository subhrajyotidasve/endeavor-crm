<?php

class Payment {
	
	private static $key = '';
	private static $vendorName = '';
	private static $transactionUrl = '';
	private static $merchantUrl = '';

	public static function paymentKey() {

		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_URL             => self::$merchantUrl,
		    CURLOPT_RETURNTRANSFER  => true,
		    CURLOPT_SSL_VERIFYPEER  => false,
		    CURLOPT_SSL_VERIFYHOST  => false,
		    CURLOPT_CUSTOMREQUEST   => "POST",
		    CURLOPT_HTTPHEADER      => array(
		        "Authorization: Basic ".self::$key,
		        "Cache-Control: no-cache",
		        "Content-Type: application/json"
		    ),
		    CURLOPT_POSTFIELDS      => '{' .
		        '"vendorName": "'.self::$vendorName.'"' .
		        '}'
		));

		$response   = curl_exec($curl);
		$result     = json_decode($response);
		$err        = curl_error($curl);

		curl_close($curl);

		$key = $result->merchantSessionKey;

		Session::set('merchantSessionKey', $key);

		echo json_encode(['key' => $key]);
	}

	public static function processPayment() {

		$curl = curl_init();
		$post = [
			'transactionType' => 'Payment',
			'customerFirstName' => Order::data('first_name'),
			'customerLastName' => Order::data('last_name'),
			'paymentMethod' => [
				'card' => [
					'merchantSessionKey' => $_SESSION['merchantSessionKey'],
					'cardIdentifier' => $_POST['card_identifier']
				]
			],
			'vendorTxCode' => "order-from-website-".time(),
			'amount' => (int)str_replace(['.', ','], '', Cart::totalPrice()),
			'currency' => 'GBP',
			'description' => Order::data('first_name') . ' ' . Order::data('last_name') . ' - New order',
			'apply3DSecure' => 'Disable',
			'applyAvsCvcCheck' => 'Disable',
			'billingAddress' => [
				'address1' => (Order::data('use_delivery')) ? Order::data('address1') : Order::data('billing-address1'),
				'city' => (Order::data('use_delivery')) ? Order::data('city') : Order::data('billing-city'),
				'postalCode' => (Order::data('use_delivery')) ? Order::data('postcode') : Order::data('billing-postcode'),
				'country' => 'GB'
			],
			'shippingAddress' => [
				'address1' => Order::data('address1'),
				'city' => Order::data('city'),
				'postalCode' => Order::data('postcode'),
				'country' => 'GB'
			],
			'entryMethod' => 'Ecommerce'
		];

		curl_setopt_array($curl, array(
		    CURLOPT_URL             => self::$transactionUrl,
		    CURLOPT_RETURNTRANSFER  => true,
		    CURLOPT_SSL_VERIFYPEER  => false,
		    CURLOPT_SSL_VERIFYHOST  => false,
		    CURLOPT_CUSTOMREQUEST   => "POST",
		    CURLOPT_HTTPHEADER      => array(
		        "Authorization: Basic ".self::$key,
		        "Cache-Control: no-cache",
		        "Content-Type: application/json"
		    ),
		    CURLOPT_POSTFIELDS => json_encode($post)
		));

		$response   = curl_exec($curl);
		$result     = json_decode($response);
		$err        = curl_error($curl);

		curl_close($curl);

		if ($result->statusCode === '0000') {

		    // Order::insertOrder(); // Create order
		    // Order::emailOrder(); // Send order confirmation email
            // Customer::newsletter(); // Add customer to newsletter (if set)
            // $dummyData = array(array(1,'Test Data')); // setup CSV placeholder data
            // Order::send_csv_mail($dummyData, ""); // Send CSV to bots (2nd element is for msg body if required)

			// Above moved to /store/complete/ page, now processed after payment

            $json = [
		    	'status' => true
		    ];
		} else {

			$json = [
				'status' => false,
				'error' => $err,
				'result' => $result,
				'post' => $post
			];
		}

		echo json_encode($json);
	}

	public static function init() {

		if ($_ENV['SAGEPAY_TEST'] === true) {

			self::$key = $_ENV['SAGEPAY_TEST_KEY'];
			self::$vendorName = $_ENV['SAGEPAY_TEST_VENDORNAME'];
			self::$transactionUrl = $_ENV['SAGEPAY_TEST_TRANSACTION_URL'];
			self::$merchantUrl = $_ENV['SAGEPAY_TEST_MERCHANT_URL'];
		} else {

			self::$key = $_ENV['SAGEPAY_KEY'];
			self::$vendorName = $_ENV['SAGEPAY_VENDORNAME'];
			self::$transactionUrl = $_ENV['SAGEPAY_TRANSACTION_URL'];
			self::$merchantUrl = $_ENV['SAGEPAY_MERCHANT_URL'];
		}
	}
}

Payment::init();