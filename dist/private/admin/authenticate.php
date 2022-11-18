<?php
session_start();
require_once('../../common/db-connect.php');
require_once('../../common/functions.php');

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $sql = "SELECT * FROM customers WHERE email = ? LIMIT 1";
    $customer = pdo_qry_row($sql, $pdo, [$email]);
    $password = $_POST['password'];
    if(!empty($customer) && password_verify($password, $customer['password'])) {  
        $_SESSION['isLoggedIn'] = true;
        unset($_SESSION['customer']);
        $_SESSION['customer'] = $customer;
        if ($_REQUEST['is_basket']) { 
            include('../cart/cart-sync-db.php');
            header('location: /store/checkout');
            //die();
        }
        else {
            echo ("login-$username");
        }
   }
}
header('location: /login/login.php');


?>