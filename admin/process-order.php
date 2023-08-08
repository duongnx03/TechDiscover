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
    $query = ("insert into tbl_order (user_id, order_date, payment_method, order_status, user_info) values 
        ($user_id, '$currentDateTime', '$payment_method', '$order_status', '$user_info')");
        $result = $database->insert($query);

    $query = "SELECT * FROM tbl_order where user_id = $user_id";
    $result = $database->select($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
        }
    }
}
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
            'quantity' => $row['quantity'],
            'product_img' => $row['product_img']
        );
    }
}
foreach ($cartItems as $item) {
    $product_name = $item['product_name'];
    $product_color = $item['product_color'];
    $product_memory_ram = $item['product_memory_ram'];
    $quantity = $item['quantity'];
    $product_img = $item['product_img'];
    $query = ("insert into tbl_order_items (order_id, product_img, product_name, product_color, product_memory_ram, quantity) values 
    ($order_id, '$product_img', '$product_name', '$product_color', '$product_memory_ram', $quantity)");
    $result = $database->insert($query);
 }
 $database = new Database();
    $query = "delete from tbl_cart where user_id = $user_id";
    $result = $database->delete($query);  
 if ($result) {
    $_SESSION["order_success"] = "Order success!";
    header("Location: ../index.php");
    exit();
}
?>

