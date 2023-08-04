<?php
include("config.php");
include("database.php");
$database = new Database();

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];
    if (isset($_POST['quantity'][$cart_id])) {
        $new_quantity = $_POST['quantity'][$cart_id];
        $query = "UPDATE tbl_cart SET quantity = $new_quantity WHERE cart_id = $cart_id";
        $result = $database->update($query);

        if ($result) {
            $get_product_query = "SELECT product_price FROM tbl_cart WHERE cart_id = $cart_id";
            $product = $database->select($get_product_query)->fetch_assoc();
            $new_total = $new_quantity * $product['product_price'];
            $update_total_query = "UPDATE tbl_cart SET total = $new_total WHERE cart_id = $cart_id";
            $database->update($update_total_query);

            header("Location: ../cart.php");
            exit;
        } else {
            echo "Update quantity failed. Please try again.";
        }
    }
}
?>