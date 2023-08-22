<?php
include "database.php";
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Sử dụng phương thức POST
    $order_id = $_POST['order_id']; // Đọc dữ liệu từ POST
    $query = "UPDATE tbl_order SET order_status = 'canceled' WHERE order_id = $order_id";
    $result = $db->update($query);

    if ($result) {
        // Gửi phản hồi thành công (tùy chọn)
        echo "Hủy đơn hàng thành công.";
    } else {
        // Gửi phản hồi lỗi (tùy chọn)
        echo "Có lỗi xảy ra khi hủy đơn hàng.";
    }
}
?>