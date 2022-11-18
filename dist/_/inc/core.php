<?php

session_start();

define('ADMIN_FOLDER', 'admin');

require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use Dotenv\Dotenv;

// Register .env file for use
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

// Set error reporting/display (sitewide)
if ($_ENV['ENV'] != 'production') {
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

} else {

	error_reporting(0);
	ini_set('display_errors', 0);
}

// Include the database class
include('classes/database.php');

// Include Session class
include('classes/session.php');

// Include Settings class
include('classes/settings.php');

// Include Dates class
include('classes/dates.php');

// Include String class
include('classes/strings.php');

// Include Email class
include('classes/email.php');

// Include file upload class
include('classes/files.php');

// Include Product class
include('classes/products.php');

// Include Customer class
include('classes/customer.php');

// Include Country class
include('classes/country.php');

// Include Brand class
include('classes/brand.php');

// Include Cart class
include('classes/cart.php');

// Include Order class
include('classes/order.php');

// Include Lead class
include('classes/lead.php');

// Include Payment class
// include('classes/payment.php');

// Include Post class
include('classes/Post.php');

// Include Promo class
include('classes/promo.php');

// Include Faqs class
include('classes/faqs.php');

// Include Pagination class
include('classes/pagination.php');

// Include Woocommerce API
include('classes/woocommerce.php');

// Include the website actions
include('classes/actions.php');

// Include page variables
include('classes/vars.php');