<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id"])) {
        $user_id = $_SESSION['id'];
    }
    $currentDateTime = date('Y-m-d H:i:s');
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $address = $_POST['address'];
    $user_info = $name.'\n'.$phone.'\n'.$address.' street, ward '.$ward.', district '.$district.', '.$city.' city.';
    $order_status = 'Order processing';
    $payment_method = $_POST["payment_method"];
    $database = new Database();
    if (isset($_POST['code']) && !empty($_POST['code'])) { 
        if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied'] == true) {
            $discount_code = $_POST['code'];
            $discount_query = "INSERT INTO user_discounts (user_id, discount_code) VALUES ($user_id, '$discount_code')";
            $discount_result = $database->insert($discount_query);
        }
        unset($_SESSION['discount_applied']);
    }
    if (isset($_POST['code']) && !empty($_POST['code'])) { 
        $total_order = $_POST['total_price'];
    }else{
        $totalPrice = $intoMoney = 0;
        $shippingFee = 10;
        $cart_query = "SELECT * FROM tbl_cart where user_id = $user_id";
        $cart_result = $database->select($cart_query);
        if ($cart_result) {
            while ($row = $cart_result->fetch_assoc()) {
                $totalPrice += $row['total'];
            }
            $total_order = $totalPrice + $shippingFee;
        }
    }
    $insert_query = ("insert into tbl_order (user_id, order_date, payment_method, order_status, user_info, total_order) values 
        ($user_id, '$currentDateTime', '$payment_method', '$order_status', '$user_info', '$total_order')");
        $insert_result = $database->insert($insert_query);

    $select_query = "SELECT * FROM tbl_order where user_id = $user_id";
    $select_result = $database->select($select_query);
    if ($select_result) {
        while ($row = $select_result->fetch_assoc()) {
            $order_id = $row['order_id'];
        }
        $totalProducts = $totalPrice = $intoMoney = 0;
        $shippingFee = 10;
        $cart_query = "SELECT * FROM tbl_cart where user_id = $user_id";
        $cart_result = $database->select($cart_query);
        $cartItems = array();
        if ($cart_result) {
            while ($row = $cart_result->fetch_assoc()) {
                $cartItems[] = array(
                    'product_name' => $row['product_name'],
                    'product_price' => $row['product_price'],
                    'product_color' => $row['product_color'],
                    'product_memory_ram' => $row['product_memory_ram'],
                    'quantity' => $row['quantity'],
                    'product_img' => $row['product_img']
                );
                $totalPrice += $row['total'];
            }
            $intoMoney = $totalPrice + $shippingFee;
        }
        foreach ($cartItems as $item) {
            $product_name = $item['product_name'];
            $product_color = $item['product_color'];
            $product_memory_ram = $item['product_memory_ram'];
            $quantity = $item['quantity'];
            $product_img = $item['product_img'];
            $order_query = ("insert into tbl_order_items (order_id, product_img, product_name, product_color, product_memory_ram, quantity) values 
            ($order_id, '$product_img', '$product_name', '$product_color', '$product_memory_ram', $quantity)");
            $order_result = $database->insert($order_query);
        }
    }
   
    $database = new Database();
    $delete_query = "delete from tbl_cart where user_id = $user_id";
    $delete_result = $database->delete($delete_query);
    if ($delete_result) {
        $_SESSION["order_success"] = "Order success!";
        header("Location: ../index.php");
        exit();
    }
}
