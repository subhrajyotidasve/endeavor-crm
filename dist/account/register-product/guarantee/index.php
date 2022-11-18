<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$currentPage = 'account';
$accountSection = 'register';
$accountTitle = 'View Product Registration';
$pageTitle = 'View your registered products';
$metaDes = 'View your registered products';

include('../../../_/inc/core.php');

Products::downloadGuarantee();


?>