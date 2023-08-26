<?php
include "database.php";
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $order_id = $_GET['id'];
    $query = "UPDATE tbl_order SET order_status = 'delivered', status_payment = 'Order has been paid' WHERE order_id = $order_id";
    $result = $db->update($query);
    if($result){
        header("Location: myAccount_cart_complete.php");
    }
}
?>