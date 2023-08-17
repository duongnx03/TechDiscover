<?php
session_start();
include "database.php";
$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id"])) {
        $user_id = $_SESSION['id'];
    }
    $currentDateTime = date('Y-m-d H:i:s');
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total_order = $_POST['total_order'];
    $order_status = 'Order processing';
    $selectedPaymentMethod = $_POST['paymentMethod'];
    $selectedShippingOption = $_POST['shipping-option'];
    $user_info = $username . ' | ' . $phone . ' | ' . $email . ' | ' . $address;

    if ($selectedPaymentMethod == "Paypal") {
        echo "
        <style>
            /* CSS để căn chỉnh nút PayPal ra giữa màn hình */
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
        <script src='https://www.paypal.com/sdk/js?client-id=AUbOEvIMIXKSLOwnIgiCu0q7iRKK2hJtW55odcvAgtYO7heyQAa2ZDIv7ziZkzD-sGM3L2rKH5SIaxad&currency=USD'></script>
        <div id='paypal-button-container'></div>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: $total_order
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        if (orderData.status === 'COMPLETED') {
    
                        } else {
                            window.location.href = '../thewayshop/cart.php';
                        }
                    });
                }
            }).render('#paypal-button-container');
        </script>";
    }
    
    $insert_query = ("insert into tbl_order (user_id, order_date, payment_method, order_status, user_info, total_order) values 
        ($user_id, '$currentDateTime', '$selectedPaymentMethod', '$order_status', '$user_info', '$total_order')");
    $insert_result = $database->insert($insert_query);

    $select_query = "SELECT * FROM tbl_order where user_id = $user_id";
    $select_result = $database->select($select_query);
    if ($select_result) {
        while ($row = $select_result->fetch_assoc()) {
            $order_id = $row['order_id'];
        }
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
            }
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
}
