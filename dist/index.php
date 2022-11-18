<?php
$currentPage = 'home';
$pageTitle = '';
$metaDes = '';

echo $_SERVER['DOCUMENT_ROOT'];
//error_reporting(0);

include($_SERVER['DOCUMENT_ROOT'] . "/_/inc/header.inc.php");

if (!Customer::loggedIn()) {

	header("Location: /account");
}

include($_SERVER['DOCUMENT_ROOT'] . "/_/inc/footer.inc.php");
?>



