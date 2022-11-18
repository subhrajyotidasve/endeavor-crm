<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/common/functions.php");
require($_SERVER['DOCUMENT_ROOT'] . "/common/db-connect.php");
if(
    Customer::loggedIn() &&
    // isset($_POST['nickname']) && $_POST['nickname']!="" &&
    isset($_POST['line1']) && $_POST['line1']!="" &&
    isset($_POST['town']) && $_POST['town']!="" &&
    isset($_POST['postcode'])  && $_POST['postcode']!=""
    ) {    
        $date = date('Y-m-d:H:i:s');
        $customerId = $_SESSION['customer']['id'];
        if (isset($_POST['addresses']) && $_POST['addresses']!=="") { //check if the address already exists
            $id = $_POST['addresses'];
            $sql = "SELECT * FROM customer_addresses WHERE id = ? AND customer_id = ? AND active = 1 LIMIT 1";
            $address = pdo_qry_all($sql, $pdo, [$id, $customerId]);
            if (count($address)>0) {
                $slug_id = rand ( 1 , 999 );
                $first_name = $_POST['first_name']; 
                $last_name = $_POST['last_name']; 
                $line1 = $_POST['line1'];
                $line2 = $_POST['line2'] ?? null;
                $city = $_POST['town'];
                $postcode = $_POST['postcode'];
                $active = 1;
                $slug = replaceAll($line1 . ' ' . $city . ' ' . $slug_id);
                $sql = "UPDATE customer_addresses SET
                    customer_id = ?,
                    slug = ?,
                    address1 = ?,
                    first_name = ?,
                    last_name = ?,
                    ".((isset($line2) && $line2!="")  ? "address2 = ?," : "")."
                    city = ?,
                    postcode = ?,
                    updated_at = ?,
                    active = ?
                    WHERE id = ? AND customer_id = ?";
                if(isset($line2) && $line2!="") {
                    pdo_qry($sql, $pdo, [$customerId, $slug, $line1, $first_name, $last_name, $line2, $city, $postcode, $date, $active, $id, $customerId]);
                } else {
                    pdo_qry($sql, $pdo, [$customerId,  $slug, $line1, $first_name, $last_name, $city, $postcode, $date, $active, $id, $customerId]);
                }
            }
        } else {

        $sql = "INSERT INTO customer_addresses (customer_id, slug, first_name, last_name, address1, address2, city, country, postcode, active, created_at, updated_at)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $slug_id = rand ( 1 , 999 );
        $first_name = $_POST['first_name']; 
        $last_name = $_POST['last_name']; 
        $line1 = $_POST['line1'];
        $line2 = $_POST['line2'] ?? null;
        $city = $_POST['town'];
        $postcode = $_POST['postcode'];
        $active = 1;
        $slug = replaceAll($line1 . ' ' . $city . ' ' . $slug_id);
        if(isset($line2) && $line2!="") {
            pdo_qry($sql, $pdo, [$customerId, $slug, $first_name, $last_name, $line1, $line2, $city, null, $postcode, $active, $date, $date]);
        } else {
            pdo_qry($sql, $pdo, [$customerId, $slug, $first_name, $last_name, $line1, null, $city, null, $postcode, $active, $date, $date]);
        }
        // pdo_qry($sql, $pdo, [$customerId]);
        }
}
?>