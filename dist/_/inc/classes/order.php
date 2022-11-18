<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Order
{

    public static function adminSatDeliveryUpdate()
    {

        $sat_delivery_rate = $_POST['sat_delivery_rate'];

        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$sat_delivery_rate, 'sat_delivery_rate']);
    }


    public static function adminSaturdayCutoffUpdate()
    {

        $saturday_cutoff_time = $_POST['saturday_cutoff_time'];

        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$saturday_cutoff_time, 'saturday_cutoff_time']);
    }


    public static function adminWeekdayCutoffUpdate()
    {

        $weekday_cutoff_time = $_POST['weekday_cutoff_time'];

        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$weekday_cutoff_time, 'weekday_cutoff_time']);
    }


    public static function adminPublicHolidayUpdate()
    {

        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_1'], 'public_holiday_1']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_2'], 'public_holiday_2']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_3'], 'public_holiday_3']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_4'], 'public_holiday_4']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_5'], 'public_holiday_5']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_6'], 'public_holiday_6']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_7'], 'public_holiday_7']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_8'], 'public_holiday_8']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_9'], 'public_holiday_9']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_10'], 'public_holiday_10']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_11'], 'public_holiday_11']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_12'], 'public_holiday_12']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_13'], 'public_holiday_13']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_14'], 'public_holiday_14']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_15'], 'public_holiday_15']);
        DB::run('UPDATE settings SET setting_value = ? WHERE setting_name = ?', [$_POST['public_holiday_16'], 'public_holiday_16']);
    }


    public static function checkoutDetails()
    {

        $array = [
            'first_name' => 'Please enter your First name',
            'last_name' => 'Please enter your Last name',
            'email' => 'Please enter your Email address',
            'phone' => 'Please enter your Phone number',
            'address1' => 'Please enter your Delivery Address line one',
            'city' => 'Please enter your Delivery City',
            'postcode' => 'Please enter your Delivery Postcode'
        ];

        if (empty($_POST['use_delivery'])) {

            $array['billing-address1'] = 'Please enter your Billing Address line one';
            $array['billing-city'] = 'Please enter your Billing City';
            $array['billing-postcode'] = 'Please enter your Billing Postcode';

            Session::set('use_delivery', 0, 'order');

            if (isset($_POST['billing-address2'])) {

                Session::set('billing-address2', $_POST['billing-address2'], 'order');
            } else {

                Session::delete('billing-address2', 'order');
            }

            if (Customer::loggedIn()) {

                Session::set('delivery_address', $_POST['delivery_addresses'], 'order');
                Session::set('billing_address', $_POST['billing_addresses'], 'order');
            }
        } else {

            Session::set('use_delivery', 1, 'order');

            if (isset($_POST['address2'])) {

                Session::set('address2', $_POST['address2'], 'order');
            } else {

                Session::delete('address2', 'order');
            }

            if (isset($_POST['instructions'])) {

                Session::set('instructions', $_POST['instructions'], 'order');
            } else {

                Session::delete('instructions', 'order');
            }

            if (isset($_POST['delivery_date'])) {

                Session::set('delivery_date', $_POST['delivery_date'], 'order');
            } else {

                Session::delete('delivery_date', 'order');
            }

            if (Customer::loggedIn()) {

                Session::set('delivery_address', $_POST['delivery_addresses'], 'order');
            }
        }

        $errors = self::setData($array);

        if (!empty($errors)) {

            $json = [
                'status' => false,
                'errors' => $errors
            ];
        } else {

            $json = [
                'status' => true,
                'errors' => null
            ];
        }

        echo json_encode($json);
    }


    private static function setData($keys)
    {

        $errors = [];

        foreach ($keys as $key => $value) {

            if (isset($_POST[$key]) && !empty($_POST[$key])) {

                // Check email doesn't exists and not logged in.
                if ($key == 'email' && !Customer::loggedIn()) {

                    $check_email = DB::run('SELECT * FROM customers WHERE email = ?', [$_POST[$key]])->fetch();

                    if (!empty($check_email)) {

                        $errors[$key] = 'Email already exists, please enter a different one or login.';
                    } else {

                        Session::set($key, $_POST[$key], 'order');
                    }
                } else {

                    Session::set($key, $_POST[$key], 'order');
                }
            } else {

                unset($_SESSION[$key]);
                $errors[$key] = $value;
            }
        }

        return $errors;
    }


    public static function insertOrder()
    {

        $totalOrderAmount = Cart::totalPrice();

        $customer_id = null;
        if (Customer::loggedIn()) {

            $customer_id = $_SESSION['customer']['id'];
        }

        $firstname = self::data('first_name');
        $lastname = self::data('last_name');
        $email = self::data('email');
        $tel_mobile = self::data('phone');
        $address1 = self::data('address1');
        $address2 = self::data('address2');
        $city = self::data('city');
        $postcode = self::data('postcode');
        $instructions = self::data('instructions');
        $delivery_date = self::data('delivery_date');
        $slug_id = rand(1, 999);

        $slug = Strings::replaceAll($firstname . ' ' . $lastname . ' ' . $city . ' ' . $slug_id);
        $date = date('Y-m-d H:i:s');

        if (self::data('use_delivery')) {

            $billingAddress1 = $address1;
            $billingAddress2 = $address2;
            $billingCity = $city;
            $billingPostcode = $postcode;
        } else {

            $billingAddress1 = self::data('billing-address1');
            $billingAddress2 = self::data('billing-address2');
            $billingCity = self::data('billing-city');
            $billingPostcode = self::data('billing-postcode');
            $slug = Strings::replaceAll($firstname . ' ' . $lastname . ' ' . $billingCity . ' ' . $slug_id);
        }

        if (!empty($_SESSION['voucher'])) {
            $voucherCode = $_SESSION['voucher']['code'];
        } else {
            $voucherCode = '';
        }

        // Set order number
        $lastOrderNumber = DB::run('SELECT order_no FROM orders ORDER BY id DESC LIMIT 1')->fetch();
        if (!empty($lastOrderNumber)) {
            $orderNumber = $int_value = intval($lastOrderNumber['order_no']) + 1;
        } else {
            $orderNumber = 2022; // establish starting point if orders table empty
        }


        Session::set('order_number', $orderNumber, 'order');

        // Setup order data
        $inputData = [
            $orderNumber,
            $customer_id,
            $slug,
            $firstname,
            $lastname,
            $email,
            $tel_mobile,
            $address1,
            $address2,
            $city,
            $postcode,
            $instructions,
            $delivery_date,
            self::data('use_delivery'),
            $billingAddress1,
            $billingAddress2,
            $billingCity,
            $billingPostcode,
            $date,
            $date,
            $voucherApplied ?? 0,
            $voucherId ?? null,
            $voucherCode,
            $voucherName ?? null,
            $voucherAmount ??  0,
            $discountAmount ?? 0,
            $totalOrderAmount,
            $date,
            $date
        ];

        $sql = "INSERT INTO orders (
            order_no,
            customer_id, 
            slug, 
            customer_first_name, 
            customer_last_name, 
            customer_email, 
            customer_tel_mobile, 
            customer_address1, 
            customer_address2, 
            customer_city, 
            customer_postcode,
            instructions,
            delivery_date,
            customer_billing_address_same,
            customer_billing_address1,
            customer_billing_address2,
            customer_billing_city,
            customer_billing_postcode,
            invoice_generated,
            invoice_sent,
            voucher_applied,
            voucher_id,
            voucher_code,
            voucher_name,
            voucher_amount,
            discount_amount,
            total_order_amount,
            created_at,
            updated_at
            )
        VALUES (
            ?, -- order_no
            ?, -- customer_id 
            ?, -- slug
            ?, -- first_name
            ?, -- last_name
            ?, -- email
            ?, -- tel_mobile
            ?, -- address1
            ?, -- address2
            ?, -- city
            ?, -- postcode
            ?, -- instructions
            ?, -- delivery_date
            ?, -- same address
            ?, -- billing address1
            ?, -- billing address2
            ?, -- billing city
            ?, -- billing postcode
            ?, -- invoice genterated
            ?, -- invoice sent
            ?, -- voucher_applied
            ?, -- voucher_id
            ?, -- voucher_code
            ?, -- voucher_name
            ?, -- voucher_amount
            ?, -- discount_amount
            ?, -- total_order_amount
            ?, -- created_at
            ?  -- updated_at
            )";

        DB::run($sql, $inputData);


        // Save Order ID to Session
        Session::set('order_id', DB::lastInsertId(), 'order');

        // Save product orders
        $sql = "INSERT INTO products_orders (
            product_id, 
            order_id, 
            pos_price, 
            product_name, 
            product_code, 
            quantity,
            category,
            fabric_style,
            size,
            model,
            delivery_notes,
            additional_notes
            )
        VALUES (
            ?, -- product_id
            ?, -- order_id
            ?, -- pos_price
            ?, -- product_name
            ?, -- product_code
            ?, -- quantity
            ?, -- category
            ?, -- fabric_style (color)
            ?, -- size
            ?, -- model
            ?, -- delivery_notes
            ?  -- additional_notes
            )";

        $stmt = DB::prepare($sql);
        foreach ($_SESSION['cart'] as $key => $value) {

            $product_id = $_SESSION['cart'][$key]['id'];
            $product = Products::get($product_id);

            $stmt->execute([
                $_SESSION['cart'][$key]['id'],
                self::data('order_id'),
                $product['product_price'],
                $product['product_name'],
                $product['product_code'],
                $_SESSION['cart'][$key]['quantity'],
                $product['product_category'] ?? null,
                $product['color'] ?? null,
                $product['size'] ?? null,
                $product['model'] ?? null,
                '',
                ''
            ]);

            Products::updateStock($product_id);
        }


        // Update product registrations
        if (Customer::loggedIn()) {

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
            foreach ($_SESSION['cart'] as $key => $value) {

                $stmt->execute([
                    $customer_id,
                    $firstname,
                    $lastname,
                    $email,
                    $_SESSION['cart'][$key]['product_name'],
                    $_SESSION['cart'][$key]['quantity'],
                    $_SESSION['cart'][$key]['id'],
                    'jaybe.com',
                    $date,
                    $_SESSION['cart'][$key]['product_price'],
                    $date,
                    $date,
                    self::data('order_id')
                ]);
            }
        }


        // Save new customer address
        if (Customer::loggedIn()) {

            $postcode = self::data('postcode');
            $existing_addresses = DB::run('SELECT * FROM customer_addresses WHERE postcode = ?', [$postcode])->fetchAll();

            if (empty($existing_addresses)) {

                $inputData = [
                    $_SESSION['customer']['id'], // customer_id
                    '', // slug
                    '', // address_type
                    '0', // is_primary
                    'Untitled', // nickname
                    self::data('first_name'), // first_name
                    self::data('last_name'), // last_name
                    self::data('address1'), // address1
                    self::data('address2'), // address2
                    self::data('city'), // city
                    self::data('postcode'), // postcode
                    '1', // active
                    date("Y-m-d H:i:s"), // created_at
                    date("Y-m-d H:i:s") // updated_at
                ];

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

                DB::run($sql, $inputData);
            } // end if no matching address found
        } // end if logged in

    }


    public static function emailOrder()
    {

        $order_ident = 'ORDER_SUCCESSFUL';
        $sql = "SELECT * FROM emails WHERE identifier = ?";
        $email = DB::run($sql, [$order_ident])->fetch();

        $customer_name = $_SESSION['order']['first_name'] . ' ' . $_SESSION['order']['last_name'];


        // $shipping_address = "Address 1: " . self::data('address1') . " <br />"; // (remove labels from conf email)
        $shipping_address = self::data('address1') . " <br />";

        if (!empty(self::data('address2'))) {

            // $shipping_address .= "Address 2: " . self::data('address2') . " <br />";
            $shipping_address .= self::data('address2') . " <br />";
        }

        // $shipping_address .= "City: " . self::data('city') . " <br />";
        $shipping_address .= self::data('city') . " <br />";

        // $shipping_address .= "Postcode: " . self::data('postcode') . " <br />";
        $shipping_address .= self::data('postcode') . " <br />";


        if (self::data('use_delivery')) {

            $billing_address = "Same as Shipping Address<br />";
        } else {

            // $billing_address = "Billing Address 1: " . self::data('billing-address1') . " <br />";
            $billing_address = self::data('billing-address1') . " <br />";

            if (!empty(self::data('billing-address2'))) {

                // $billing_address = "Billing Address 2: " . self::data('billing-address2') . " <br />";
                $billing_address = self::data('billing-address2') . " <br />";
            }

            // $billing_address .= "Billing City: " . self::data('billing-city') . " <br />";
            // $billing_address .= "Billing Postcode: " . self::data('billing-postcode') . " <br />";
            $billing_address .= self::data('billing-city') . " <br />";
            $billing_address .= self::data('billing-postcode') . " <br />";
        }

        $i = 1;

        $products = '';
        // if (!empty($_SESSION['cart'])) {
        //     foreach ($_SESSION['cart'] as $key => $value) {

        //         $products .= "<h3>Product #{$i}</h3>";
        //         $products .= "Product Name: {$_SESSION['cart'][$key]['product_name']} <br />";

        //         if (!empty($_SESSION['cart'][$key]['size'])) {
        //             $products .= "Product Size: {$_SESSION['cart'][$key]['size']} <br />";
        //         }

        //         if (!empty($_SESSION['cart'][$key]['color'])) {
        //             $products .= "Product Colour: {$_SESSION['cart'][$key]['color']} <br />";
        //         }

        //         if (!empty($_SESSION['cart'][$key]['quantity'])) {
        //             $products .= "Quantity: {$_SESSION['cart'][$key]['quantity']} <br />";
        //         }

        //         $products .= "Product Code: {$_SESSION['cart'][$key]['product_code']} <br />";
        //         $products .= "Product Price: {$_SESSION['cart'][$key]['product_price']} <br />";

        //         $i++;
        //     }
        // }
        
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {

                $products .= "<tr align='center'>";

                $products .= "<td valign='top' align='left' style='font-size: 14px; font-weight: 300; padding-left: 40px;'>";
                $products .= $_SESSION['cart'][$key]['quantity'];
                $products .= "</td>";

                $products .= "<td valign='top' align='left' style='font-size: 14px; font-weight: 300;'>";
                $products .= $_SESSION['cart'][$key]['product_name'];
                $products .= "</td>";

                $products .= "<td valign='top' align='right' style='font-size: 14px; font-weight: 300; padding-right: 40px;'>";
                $products .= $_SESSION['cart'][$key]['product_price'];
                $products .= "</td>";

                $products .= "</tr>";

                $i++;
            }
        }

        // $total = Cart::totalPrice();
        $total_price = number_format(Cart::totalPrice(), 2);

        //        Voucher info removed from emails for now - March 2022
        //
        //        if (isset($_SESSION['voucher'])) {
        //
        //            $total_price = "Voucher {$_SESSION['voucher']['code']} applied. <br>";
        //            $total_price .= "Total with discount: {$total} <br>";
        //        } else {

        // $total_price = "<p><strong>Order Total: &pound;{$total} <br></strong></p>";
        //        }

        // $filename = self::saveInvoice(); // PPEDIT PDF removed 16/03/22

        $sat_del = false;
        $sat_del = cart::saturdayDelivery();
        $sat_delivery_rate = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['sat_delivery_rate'])->fetch();
        $sat_delivery_rate = $sat_delivery_rate['setting_value'];
        $delivery_total = 'Free';
        if ($sat_del == true) {
            $delivery_total = '&pound;'.$sat_delivery_rate;
        }

        $array = [
            'order_number' => $_SESSION['order']['order_number'],
            'first_name' => self::data('first_name'),
            'last_name' => self::data('last_name'),
            'email' => self::data('email'),
            'tel_mobile' => self::data('phone'),
            'shipping_address' => $shipping_address,
            'billing_address' => $billing_address,
            'products' => $products,
            'order_date' => date('d/m/Y'),
            'delivery_date' => date('d/m/Y', strtotime(self::data('delivery_date'))),
            'total_price' => $total_price,
            'total_vat' => Strings::price_format(Cart::vat(Cart::totalPrice()), 2),
            'promo_saving' => Strings::price_format(Cart::discountTotal()),
            'delivery_total' => $delivery_total
        ];

        // send email to customer
        $email_id = 5;
        $email = Email::getTemplate($email_id, $array);
        Email::sendEmail(self::data('email'), self::data('first_name') . ' ' . self::data('last_name'), $email['subject'], $email['body']);

        // log email if customer logged in & not admin
        if (!empty($_SESSION['customer']) && (!Customer::adminLoggedIn())) {
            Email::logEmail(
                $_SESSION['customer']['id'], // customer_id
                $email_id, // email_id
                $_SESSION['order']['order_number'], // order_id
                self::data('email') // email_to
            );
        }
    }


    public static function endOrder()
    {

        unset($_SESSION['cart']);
        unset($_SESSION['voucher']); // Unset voucher here not on empty cart

        unset($_SESSION['final_price']);
        // unset($_SESSION['order']);

        Cart::emptyCart();
    }


    public static function data($key = null)
    {

        if (isset($_SESSION['order'])) {

            if (isset($_SESSION['order'][$key])) {

                return $_SESSION['order'][$key];
            }

            return true;
        }

        return false;
    }


    public static function checkOrder()
    {

        if (!self::data('order_id')) {

            header('Location: /store/cart');
        }
    }


    public static function get($order_id = false)
    {

        if ($order_id) {

            return DB::run("SELECT * FROM orders WHERE id = ? LIMIT 1", [$order_id])->fetch();
        } else {
            $customer_id = Customer::data('id');

            $sql = "SELECT * FROM orders WHERE customer_id = ? ORDER BY id DESC";
            return DB::run($sql, [$customer_id])->fetchAll();
        }
    }


    public static function all()
    {

        return DB::run('SELECT * FROM orders')->fetchAll();
    }


    public static function getProductOrder($order_id)
    {

        $sql = "SELECT * FROM products_orders WHERE order_id = ?";
        $stmt = DB::prepare($sql);
        $stmt->execute([$order_id]);
        $products = $stmt->fetchAll();

        return $products;
    }

    public static function getOrder($order_id = false)
    {

        if (!$order_id) {

            $order_id = $_REQUEST['id'];
        }

        if (!Customer::adminLoggedIn() && Customer::loggedIn()) {

            $customer_id = $_SESSION['customer']['id'];

            $sql = "SELECT * FROM orders WHERE id = ? AND customer_id = ?";
            return DB::run($sql, [$order_id, $customer_id])->fetch();
        } else if (Customer::adminLoggedIn()) {

            $sql = "SELECT * FROM orders WHERE id = ?";
            return DB::run($sql, [$order_id])->fetch();
        } else {

            $sql = "SELECT * FROM orders WHERE id = ?";
            return DB::run($sql, [$order_id])->fetch();
        }
    }


    public static function getProducts($order_id)
    {

        if (!Customer::adminLoggedIn()) {

            $sql = "SELECT * FROM products_orders WHERE order_id = ?";

            return DB::run($sql, [$order_id])->fetchAll();

            //            $customer_id = $_SESSION['customer']['id'];
            //            $sql = "SELECT * FROM products_orders AS po JOIN orders AS o ON po.order_id = o.id WHERE po.order_id = ? AND o.customer_id = ?";

            //            return DB::run($sql, [$order_id, $customer_id])->fetchAll();

        } else {

            $sql = "SELECT * FROM products_orders WHERE order_id = ?";

            return DB::run($sql, [$order_id])->fetchAll();
        }
    }


    public static function downloadInvoice()
    {

        ob_start();

        $order = self::getOrder();
        $products = self::getProducts($order['id']);

        include($_SERVER['DOCUMENT_ROOT'] . '/account/order-history/invoice/invoice.php');

        $content = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'en');
        $html2pdf->writeHTML($content);

        $filename = 'Invoice-' . $order['id'] . '-' . $order['customer_first_name'] . '-' . $order['customer_last_name'] . '.pdf';
        $html2pdf->output($filename);
    }


    public static function saveInvoice($order_id)
    {

        ob_start();

        if (empty($order_id)) {
            $order = self::getOrder(self::data('order_id'));
        } else {
            $order = self::getOrder($order_id);
        }

        $products = self::getProducts($order['id']);

        include($_SERVER['DOCUMENT_ROOT'] . '/account/order-history/invoice/invoice.php');

        $content = ob_get_clean();
        $html2pdf = new Html2Pdf('L', 'A4', 'en');
        $html2pdf->writeHTML($content);

        $filename = '/tmp/Invoice-JB0000' . $order['order_no'] . '-' . $order['customer_first_name'] . '-' . $order['customer_last_name'] . '.pdf';
        $html2pdf->output($filename, 'F');

        return $filename;
    }


    public static function saveGuarantee($guarantee_id, $order_id)
    {

        ob_start();

        $order = Order::get($order_id);
        $customer_id = $order['customer_id'];

        $sql = "SELECT * FROM customer_product_registrations as pr, products as p WHERE pr.id = ? AND pr.customer_id = ?";
        $guarantee = DB::run($sql, [$guarantee_id, $customer_id])->fetch();

        $order_id = Strings::replaceAll($guarantee['order_id']);
        $order = Order::get($order_id);
        $product = Products::get($guarantee['product_id']);

        $customer_first_name = Strings::replaceAll($guarantee['first_name']);
        $customer_last_name = Strings::replaceAll($guarantee['last_name']);
        $product_name = Strings::replaceAll($guarantee['product']);

        $order_no = $sap_no = $product_code = 'N/A';
        if (!empty($product['product_code'])) {
            $product_code = Strings::replaceAll($product['product_code']);
        }
        if (!empty($order['order_no'])) {
            $order_no = 'JB0000' . $order['order_no'];
        }
        if (!empty($order['sap_no'])) {
            $sap_no = $order['sap_no'];
        }

        include($_SERVER['DOCUMENT_ROOT'] . '/account/register-product/guarantee/guarantee.php');

        $content = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'en');
        $html2pdf->writeHTML($content);

        $filename = '/tmp/Guarantee-' . $guarantee_id . '-' . $customer_first_name . '-' . $customer_last_name . '.pdf';
        $html2pdf->output($filename, 'F');

        return $filename;
    }


    public static function adminEmailInvoice()
    {

        if (Customer::adminLoggedIn()) {

            $order_id = $_POST['order_id'];

            $order = Order::get($order_id);
            var_dump($order);
            $customer_first_name = $order['customer_first_name'];
            $customer_last_name = $order['customer_last_name'];
            $customer_email = $order['customer_email'];
            $customer_id = $order['customer_id'];
            $filename = self::saveInvoice($order_id);

            $email_id = 12;
            $email = Email::getTemplate($email_id);

            Email::sendEmail($customer_email, $customer_first_name . ' ' . $customer_last_name, $email['subject'], $email['body'], [$filename]);

            // log email if customer logged in
            if (!empty($_SESSION['customer'])) {
                Email::logEmail(
                    $customer_id, // customer_id
                    $email_id, // email_id
                    '', // order_id
                    $customer_email // email_to
                );
            }
        }
    }


    public static function adminEmailGuarantee()
    {

        if (Customer::adminLoggedIn()) {

            $order_id = $_POST['order_id'];
            $guarantee_id = $_POST['guarantee_id'];

            $guarantee = DB::run('SELECT * FROM customer_product_registrations WHERE id = ' . $guarantee_id)->fetch();
            var_dump($guarantee);
            $customer_first_name = $guarantee['first_name'];
            $customer_last_name = $guarantee['last_name'];
            $customer_email = $guarantee['email'];
            $customer_id = $guarantee['customer_id'];
            $filename = self::saveGuarantee($guarantee_id, $order_id);

            $email_id = 13;
            $email = Email::getTemplate($email_id);

            Email::sendEmail($customer_email, $customer_first_name . ' ' . $customer_last_name, $email['subject'], $email['body'], [$filename]);

            // log email if customer logged in
            if (!empty($_SESSION['customer'])) {
                Email::logEmail(
                    $customer_id, // customer_id
                    $email_id, // email_id
                    '', // order_id
                    $customer_email // email_to
                );
            }
        }
    }


    public static function adminSendInvoiceAndGuarantee($order_id, $guarantee_id)
    {

        if (Customer::adminLoggedIn()) {

            if (!empty($_POST['order_id'])) {
                $order_id = $_POST['order_id'];
                $guarantee_id = $_POST['guarantee_id'];
            }

            // echo 'Order ID: ' . $order_id . '<br>';
            // echo 'Guarantee ID: ' . $guarantee_id . '<br><br>';

            $order = Order::get($order_id);
            $order_no = $order['order_no'];
            // var_dump($order); // output via console.log

            $guarantee = DB::run('SELECT * FROM customer_product_registrations WHERE id = ' . $guarantee_id)->fetch();
            // var_dump($guarantee); // output via console.log

            $customer_first_name = $order['customer_first_name'];
            $customer_last_name = $order['customer_last_name'];
            $customer_email = $order['customer_email'];
            $customer_id = $order['customer_id'];

            $filename_invoice = self::saveInvoice($order_id);
            $filename_guarantee = self::saveGuarantee($guarantee_id, $order_id);

            // send email
            $email_id = 14;
            $email = Email::getTemplate($email_id);
            Email::sendEmail($customer_email, $customer_first_name . ' ' . $customer_last_name, $email['subject'], $email['body'], [$filename_invoice, $filename_guarantee]);

            // log email
            Email::logEmail(
                $customer_id, // customer_id
                $email_id, // email_id
                $order_no, // order_no
                $customer_email // email_to
            );
        }
    }



    public static function adminDeleteOrder()
    {

        if (Customer::adminLoggedIn()) {

            $order_id = $_POST['order_id'];

            DB::run('DELETE FROM orders WHERE id = ?', [$order_id]);

            // DB::run('UPDATE orders SET deleted_at = ? WHERE id = ?', [
            //     date('Y-m-d H:i:s'),
            //     $order_id
            // ]);

            exit();
        }
    }


    public static function adminProductOrderTracking()
    {

        $order_id = $_POST['id'];
        $tracking_code = $_POST['tracking_code'];

        $order = DB::run('SELECT * FROM orders WHERE id = ?', [$order_id])->fetch();
        if (isset($order['id'])) {

            DB::run('UPDATE orders SET tracking_code = ? WHERE id = ?', [$tracking_code, $order_id]);

            $array = [
                'order_id' => $order['id'],
                'first_name' => $order['customer_first_name'],
                'last_name' => $order['customer_last_name'],
                'email' => $order['customer_email'],
                'tel_mobile' => $order['customer_tel_mobile'],
                'tracking_code' => $tracking_code
            ];

            // send email to customer
            $email = Email::getTemplate(10, $array);

            Email::sendEmail($order['customer_email'], $order['customer_first_name'] . ' ' . $order['customer_last_name'], $email['subject'], $email['body']);
        }
    }


    public static function adminProductOrderStatus()
    {

        $order_id = $_POST['id'];
        $status = $_POST['order_status'];

        $order = DB::run('SELECT * FROM orders WHERE id = ?', [$order_id])->fetch();
        if (isset($order['id'])) {

            DB::run('UPDATE orders SET order_status = ? WHERE id = ?', [$status, $order_id]);

            switch ($status) {

                case 'Processing Order':

                    //                    $array = [
                    //                        'order_id' => $order['id'],
                    //                        'first_name' => $order['customer_first_name'],
                    //                        'last_name' => $order['customer_last_name'],
                    //                        'email' => $order['customer_email'],
                    //                        'tel_mobile' => $order['customer_tel_mobile'],
                    //                        'status' => $status
                    //                    ];
                    //
                    //                    // send email to customer
                    //                    $email = Email::getTemplate(5, $array);
                    //
                    //                    Email::sendEmail($order['customer_email'], $order['customer_first_name'].' '.$order['customer_last_name'], $email['subject'], $email['body']);

                    break;

                case 'Order Complete':

                    // Updated refunded date
                    // DB::run('UPDATE orders SET refunded_date = ? WHERE id = ?', [date('Y-m-d H:i:s'), $order_id]);

                    $order_products = self::getProductOrder($order_id);

                    // var_dump($order_products);

                    $products = '';
                    $i = 1;
                    foreach ($order_products as $order_product) {

                        $products .= "<h3>Product #{$i}</h3>";
                        $products .= "Product Name: {$order_product['product_name']} <br />";

                        if (!empty($order_product['size'])) {
                            $products .= "Product Size: {$order_product['size']} <br />";
                        }

                        if (!empty($order_product['color'])) {
                            $products .= "Product Colour: {$order_product['color']} <br />";
                        }

                        if (!empty($order_product['model'])) {
                            $products .= "Product Model: {$order_product['model']} <br />";
                        }

                        if (!empty($order_product['quantity'])) {
                            $products .= "Quantity: {$order_product['quantity']} <br />";
                        }

                        $products .= "Product Code: {$order_product['product_code']} <br />";
                        $products .= "Product Price: {$order_product['pos_price']} <br />";

                        $i++;
                    }

                    $array = [
                        'order_id' => $order['id'],
                        'order_no' => $order['order_no'],
                        'sap_no' => $order['sap_no'],
                        'products' => $products,
                        'order_date' => date('d/m/Y', strtotime($order['created_at'])),
                        'first_name' => $order['customer_first_name'],
                        'last_name' => $order['customer_last_name'],
                        'email' => $order['customer_email'],
                        'tel_mobile' => $order['customer_tel_mobile'],
                        'status' => $status
                    ];

                    // send email to customer
                    $email_id = 11;
                    $email = Email::getTemplate($email_id, $array);

                    Email::sendEmail($order['customer_email'], $order['customer_first_name'] . ' ' . $order['customer_last_name'], $email['subject'], $email['body']);

                    // log email if customer logged in
                    if (!empty($_SESSION['customer'])) {
                        Email::logEmail(
                            $order['customer_id'], // customer_id
                            $email_id, // email_id
                            $order['order_number'], // order_id
                            $order['customer_email'] // email_to
                        );
                    }

                    break;

                case 'REFUNDED': // PPEDIT status no longer exists @ 16/03/22

                    //                    // Updated refunded date
                    //                    DB::run('UPDATE orders SET refunded_date = ? WHERE id = ?', [date('Y-m-d H:i:s'), $order_id]);
                    //
                    //                    $array = [
                    //                        'order_id' => $order['order_number'],
                    //                        'first_name' => $order['customer_first_name'],
                    //                        'last_name' => $order['customer_last_name'],
                    //                        'email' => $order['customer_email'],
                    //                        'tel_mobile' => $order['customer_tel_mobile'],
                    //                        'status' => $status
                    //                    ];
                    //
                    //                    // send email to customer
                    //                    $email = Email::getTemplate(7, $array);
                    //
                    //                    Email::sendEmail($order['customer_email'], $order['customer_first_name'].' '.$order['customer_last_name'], $email['subject'], $email['body']);

                    break;
            }
        }
    }



    public static function adminProductSapUpdate()
    {

        $order_id = $_POST['id'];
        $sap_no = $_POST['sap_no'];

        DB::run('UPDATE orders SET sap_no = ? WHERE id = ?', [$sap_no, $order_id]);
    }


    // Create CSV
    public static function create_csv_string($data)
    {

        $order = Order::getOrder(self::data('order_id'));
        $products = Order::getProducts($order['id']);

        // Open temp file pointer
        if (!$fp = fopen('php://temp', 'w+')) return FALSE;

        fputcsv($fp, array(
            'order_number',
            'product_sku',
            'product_name',
            'quantity',
            'order_total',
            'order_tax',
            'order_total_incl_tax',
            'order_date',
            'customer_email',
            'customer_firstname',
            'customer_lastname',
            'shipping_firstname',
            'shipping_lastname',
            'shipping_street',
            'shipping_city',
            'shipping_postcode',
            'supplier_manufacturer_code',
            'estimated_delivery_date',
            'jaybe_number',
            'customer_mobile number',
            'Result',
            'Sales Order',
            'Posted Date'
        ));

        // Loop data and write to file pointer
        foreach ($products as $product) {
            $data = array(
                'JB0000' . $order['order_no'], // order_number
                $product['product_code'], // product_sku
                $product['product_name'], // product_name
                $product['quantity'], // quantity
                '', // order_total
                '', // order_tax
                '', // order_total_incl_tax
                date('d/m/Y'), // order_date
                $order['customer_email'], // customer_email
                $order['customer_first_name'], // customer_firstname
                $order['customer_last_name'], // customer_lastname
                $order['customer_first_name'], // shipping_firstname
                $order['customer_last_name'], // shipping_lastname
                $order['customer_address1'], // shipping_street
                $order['customer_city'], // shipping_city
                $order['customer_postcode'], // shipping_postcode
                '', // supplier_manufacturer_code
                $order['delivery_date'], // estimated_delivery_date
                'JAY51', // jaybe_number
                $order['customer_tel_mobile'], // customer_mobile number
                '', // Result
                '', // Sales Order
                '', // Posted Date
            );
            fputcsv($fp, $data);
        }

        // Place stream pointer at beginning
        rewind($fp);

        // Return the data
        return stream_get_contents($fp);
    }


    // Send CSV by Email
    public static function send_csv_mail($csvData, $body, $to = 'richard@jaybe.com', $subject = 'Sales Order', $from = 'noreply@jaybe.com')
    {

        // Entropy
        $multipartSep = '-----' . md5(time()) . '-----';

        $headers = array(
            "From: $from",
            "Reply-To: $from",
            "Content-Type: multipart/mixed; boundary=$multipartSep"
        );

        $attachment = chunk_split(base64_encode(self::create_csv_string($csvData)));

        $body = "--$multipartSep\r\n"
            . "Content-Type: text/plain; charset=ISO-8859-1; format=flowed\r\n"
            . "Content-Transfer-Encoding: 7bit\r\n"
            . "\r\n"
            . "$body\r\n"
            . "--$multipartSep\r\n"
            . "Content-Type: text/csv\r\n"
            . "Content-Transfer-Encoding: base64\r\n"
            . "Content-Disposition: attachment; filename=JAY51_Sales_Order.csv\r\n"
            . "\r\n"
            . "$attachment\r\n"
            . "--$multipartSep--";

        // Send email, return result
        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }


    public static function adminOrdersExport($date_from, $date_to)
    {
        $date_from = strtotime($date_from);
        $date_from = date('Y-m-d', $date_from);

        $date_to = strtotime($date_to);
        $date_to = date('Y-m-d', $date_to);

        $orders = DB::run("SELECT * FROM orders WHERE created_at BETWEEN ('" . $date_from . "')AND ('" . $date_to . "')")->fetchAll();

        // Headings and rows
        $headings = array('id', 'customer_id', 'slug', 'order_no', 'sap_no', 'customer_title', 'customer_first_name', 'customer_last_name', 'customer_email', 'customer_tel_mobile', 'customer_tel_daytime', 'customer_address1', 'customer_address2', 'customer_city', 'customer_county', 'customer_country', 'customer_postcode', 'instructions', 'delivery_date', 'customer_billing_address_same', 'customer_billing_address1', 'customer_billing_address2', 'customer_billing_city', 'customer_billing_county', 'customer_billing_country', 'customer_billing_postcode', 'customer_delivery_instructions', 'delivery_dispatched', 'items_dispatched_together', 'courier_name', 'delivery_type', 'tracking_code', 'tracking_code_added', 'delivery_cost', 'delivery_admin_notes', 'payment_method', 'payment_terms', 'reference_type', 'order_total', 'invoice_location', 'invoice_generated', 'invoice_sent', 'discount_applied', 'delivery_total', 'order_status', 'refunded_date', 'cancelled_date', 'order_payment_method', 'order_payment_terms', 'order_payment_type', 'order_invoice_location', 'order_invoice_generated', 'voucher_applied', 'voucher_id', 'voucher_code', 'voucher_name', 'voucher_amount', 'is_fixed', 'discount_amount', 'total_order_amount', 'created_at', 'updated_at', 'deleted_at');
        $array = array();
        foreach ($orders as $order) {
            array_push($array, [$order['id'], $order['customer_id'], $order['slug'], 'JB0000' . $order['order_no'], $order['sap_no'], $order['customer_title'], $order['customer_first_name'], $order['customer_last_name'], $order['customer_email'], $order['customer_tel_mobile'], $order['customer_tel_daytime'], $order['customer_address1'], $order['customer_address2'], $order['customer_city'], $order['customer_county'], $order['customer_country'], $order['customer_postcode'], $order['instructions'], $order['delivery_date'], $order['customer_billing_address_same'], $order['customer_billing_address1'], $order['customer_billing_address2'], $order['customer_billing_city'], $order['customer_billing_county'], $order['customer_billing_country'], $order['customer_billing_postcode'], $order['customer_delivery_instructions'], $order['delivery_dispatched'], $order['items_dispatched_together'], $order['courier_name'], $order['delivery_type'], $order['tracking_code'], $order['tracking_code_added'], $order['delivery_cost'], $order['delivery_admin_notes'], $order['payment_method'], $order['payment_terms'], $order['reference_type'], $order['order_total'], $order['invoice_location'], $order['invoice_generated'], $order['invoice_sent'], $order['discount_applied'], $order['delivery_total'], $order['order_status'], $order['refunded_date'], $order['cancelled_date'], $order['order_payment_method'], $order['order_payment_terms'], $order['order_payment_type'], $order['order_invoice_location'], $order['order_invoice_generated'], $order['voucher_applied'], $order['voucher_id'], $order['voucher_code'], $order['voucher_name'], $order['voucher_amount'], $order['is_fixed'], $order['discount_amount'], $order['total_order_amount'], $order['created_at'], $order['updated_at'], $order['deleted_at']]);
        }


        // Open the output stream
        $fh = fopen('php://output', 'w');

        // Start output buffering (to capture stream contents)
        ob_start();

        fputcsv($fh, $headings);

        // Loop over the * to export
        if (!empty($array)) {
            foreach ($array as $item) {
                fputcsv($fh, $item);
            }
        }

        // Get the contents of the output buffer
        $string = ob_get_clean();

        $filename = 'csv_' . date('Ymd') . '_' . date('His');

        // Output CSV-specific headers to render CSV to browser (forces download)
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename.csv\";");
        header("Content-Transfer-Encoding: binary");

        exit($string);
    }



    public static function adminTotalSales()
    {

        // Total Sales (all time)
        $orders = DB::run('SELECT total_order_amount FROM orders')->fetchAll();
        //        var_dump($orders);
        $totalSales = 0;
        foreach ($orders as $order) {
            $totalSales += $order['total_order_amount'];
        }

        return number_format($totalSales, 2);
    }


    public static function adminSalesLastWeek()
    {

        // Sales Last Week
        $lastWeek = array();

        $prevMon = abs(strtotime("previous monday"));
        $currentDate = abs(strtotime("today"));
        $seconds = 86400; //86400 seconds in a day

        $dayDiff = ceil(($currentDate - $prevMon) / $seconds);

        if ($dayDiff < 7) {
            $dayDiff += 1; //if it's monday the difference will be 0, thus add 1 to it
            $prevMon = strtotime("previous monday", strtotime("-$dayDiff day"));
        }

        $prevMon = date("Y-m-d", $prevMon);
        $prevSun = date("Y-m-d", (strtotime($prevMon . " + 6 day")));

        $orders = DB::run("SELECT * FROM orders WHERE created_at BETWEEN ('" . $prevMon . "')AND ('" . $prevSun . "')")->fetchAll();
        // var_dump($orders);
        $salesLastWeek = 0;
        foreach ($orders as $order) {
            $salesLastWeek += $order['total_order_amount'];
        }

        return number_format($salesLastWeek, 2);
    }


    public static function adminSalesThisWeek()
    {

        // Find start of the week
        $i = 0;
        while (true) {
            $tmp_date = mktime(0, 0, 0, date('n'), date('j') - $i, date('Y'));
            if (date('w', $tmp_date) == 0) { // Sunday
                $start_date = date('Y/m/d', $tmp_date);
                break;
            }
            $i++;
        }

        // Find end of the week
        $i = 0;
        while (true) {
            $tmp_date = mktime(0, 0, 0, date('n'), date('j') + $i, date('Y'));
            if (date('w', $tmp_date) == 6) { // Saturday
                $end_date = date('Y/m/d', $tmp_date);
                break;
            }
            $i++;
        }

        $orders = DB::run("SELECT * FROM orders WHERE created_at BETWEEN ('" . $start_date . "') AND ('" . $end_date . "')")->fetchAll();

        $salesThisWeek = 0;
        foreach ($orders as $order) {
            $salesThisWeek += $order['total_order_amount'];
        }

        return number_format($salesThisWeek, 2);
    }


    public static function adminSalesToday()
    {

        $orders = DB::run("SELECT * FROM orders WHERE created_at >= DATE(NOW())")->fetchAll();

        $salesToday = 0;
        foreach ($orders as $order) {
            $salesToday += $order['total_order_amount'];
        }

        return number_format($salesToday, 2);
    }
}
