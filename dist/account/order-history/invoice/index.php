<?php
// Redirect if not logged in
//if (!isset($_SESSION['customer'])) {
//    header( "Location: /account/" );
//}
$currentPage = 'account';
$accountSection = 'order';
$accountTitle = 'Order History';
$pageTitle = 'View your delivery details';
$metaDes = 'View your delivery details';

include('../../../_/inc/core.php');

Order::downloadInvoice();
