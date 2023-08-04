<?php
session_start();
include("config.php");
include("database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["method-payment"])) {
        if (isset($_SESSION["id"])) {
            $user_id = $_SESSION['id'];
        }else{
            $user_id = 0;
        }
        $selectedPaymentMethod = $_POST["method-payment"];
        if ($selectedPaymentMethod === "credit-card") {
            $selectedPaymentMethod = 'credit-card';
        } elseif ($selectedPaymentMethod === "atm card") {
            $selectedPaymentMethod = 'atm-card';
        } elseif ($selectedPaymentMethod === "momo") {
            $selectedPaymentMethod = 'momo';
        } elseif ($selectedPaymentMethod === "payment-on-delivery") {
            $selectedPaymentMethod = 'payment on delivery';
        }
        $database = new Database();
        $query = "update tbl_order set payment_method = '$selectedPaymentMethod' where user_id = $user_id";
        $result = $database->update($query);
    } 
    $database = new Database();
    $query = "delete from tbl_cart where user_id = $user_id";
    $result = $database->delete($query);    
    if ($result) {
        $_SESSION["order_success"] = "Order success!";
        header("Location: ../index.php");
        exit();
    }
} 
?>