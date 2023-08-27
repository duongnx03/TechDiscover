<?php
include "database.php";
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $products_to_return = $_POST['products_to_return'];
    $return_reasons = $_POST['return_reasons'];
    $upload_directory = "../admin/uploads/";

    // Update order status
    $order_query = "UPDATE tbl_order SET order_status = 'return_order', return_status = 'processing' WHERE order_id = $order_id";
    $order_result = $db->update($order_query);

    foreach ($products_to_return as $order_item_id) {
        $return_reason = $return_reasons[$order_item_id];

        // Handle uploaded images
        if (isset($_FILES['return_images'])) {
            $uploaded_images = $_FILES['return_images'];
            $image_name = $uploaded_images['name'][$order_item_id];
            $image_tmp = $uploaded_images['tmp_name'][$order_item_id];
            $target_file = $upload_directory . basename($image_name);
            move_uploaded_file($image_tmp, $target_file);
        } else {
            $image_name = ""; 
        }

        // Update order item with return data
        $order_item_query = "UPDATE tbl_order_items SET return_reason = '$return_reason', return_img = '$image_name', is_returned = 1 WHERE order_item_id = $order_item_id";
        $order_item_result = $db->update($order_item_query); 
    }

    echo "Return request submitted successfully.";
}
?>