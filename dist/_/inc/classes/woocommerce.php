<?php
require($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");
// require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
  'https://endeavordna.com',
  'ck_6f9f2e4695583eba769d2b4ae530c959c895a16e',
  'cs_2d04a2ad7e6e56178f438aa910c0368619c2ce4d',
  [
    'version' => 'wc/v3',
  ]
);