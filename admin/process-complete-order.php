<?php
include "database.php";
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Sử dụng phương thức POST
    $order_id = $_POST['order_id']; // Đọc dữ liệu từ POST
    $query = "UPDATE tbl_order SET order_status = 'delivered', status_payment = 'Order has been paid' WHERE order_id = $order_id";
    $result = $db->update($query);
}
?>