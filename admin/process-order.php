<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id"])) {
        $user_id = $_SESSION['id'];
    }else{
        $user_id = 0;
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

    $totalProducts = $totalPrice = $intoMoney = 0;
    $shippingFee = 10;
    $database = new Database();
    $query = "SELECT * FROM tbl_cart where user_id = $user_id";
    $result = $database->select($query);
    $cartItems = array();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = array(
                'product_name' => $row['product_name'],
                'product_color' => $row['product_color'],
                'product_memory_ram' => $row['product_memory_ram'],
                'product_price' => $row['product_price'],
                'quantity' => $row['quantity'],
                'total' => $row['total'],
                'product_img' => $row['product_img']
            );
            $totalProducts += $row['quantity'];
            $totalPrice += $row['total'];
        }
        $intoMoney = $totalPrice + $shippingFee;
    }
    foreach ($cartItems as $item) {
        $product_name = $item['product_name'];
        $product_color = $item['product_color'];
        $product_memory_ram = $item['product_memory_ram'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];
        $total = $item['total'];
        $product_img = $item['product_img'];
        $product_type = $product_color.' | '.$product_memory_ram;
        $query = ("insert into tbl_order (user_id, product_name, product_type, quantity, order_date, order_status, user_info) values 
        ($user_id, '$product_name', '$product_type', $quantity, '$currentDateTime', '$order_status', '$user_info')");
        $result = $database->insert($query);
    }
    header("Location: ../payment.php");
}
?>

