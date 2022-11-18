<?php
// include('../../_/inc/classes/order.php');
include('../../_/inc/core.php');

if (!empty($_GET['date_range'])) {

    $date_range = $_GET['date_range'];

    $date_from = substr($date_range, 0, 10);
    $date_to = substr($date_range, -10);

    Order::adminOrdersExport($date_from, $date_to);
}
