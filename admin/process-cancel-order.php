<?php
include "database.php";
require_once '../Paypal/Api/Refund.php';
require_once '../Paypal/Api/Sale.php';
require_once '../Paypal/Rest/ApiContext.php';
require_once '../Paypal/Auth/OAuthTokenCredential.php';
require_once '../Paypal/Exception/PayPalConnectionException.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use PayPal\Exception\PayPalConnectionException;

$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $order_id = $_GET['id'];
    $query = "UPDATE tbl_order SET order_status = 'canceled' WHERE order_id = $order_id";
    $result = $db->update($query);

    $product_query = "select * from tbl_order_items where order_id = $order_id";
    $product_result = $db->select($product_query);
    $productItems = array();
    if ($product_result) {
        while ($row = $product_result->fetch_assoc()) {
            $productItems[] = array(
                'quantity' => $row['quantity'],
                'user_id' => $row['user_id']
            );
        }
        foreach ($productItems as $item) {
            $quantity = $item['quantity'];
            $product_id = $item['user_id'];
            $select_product = "SELECT product_quantity FROM tbl_product WHERE product_id = $product_id";
            $result_product = $db->select($select_product);
            if ($result_product) {
                $row = $result_product->fetch_assoc();
                $product_quantity = $row['product_quantity'];
            }
            $update_quanity = $quantity + $product_quantity;
            $update_query = "update tbl_product set product_quantity = $update_quanity where product_id = $product_id";
            $update_result = $db->update($update_query);
        }
    }

    // $select_query = "select * from tbl_order where order_id = $order_id";
    // $select_result = $db->select($select_query);
    // if ($select_result) {
    //     // Lấy thông tin từ kết quả truy vấn
    //     $row = $select_result->fetch_assoc();
    
    //     $total = $row['total_order'];
    //     $transaction_id = $row['paypal_id'];
    // }

    // $clientID = 'AUbOEvIMIXKSLOwnIgiCu0q7iRKK2hJtW55odcvAgtYO7heyQAa2ZDIv7ziZkzD-sGM3L2rKH5SIaxad';
    // $secret = 'EPzN9O-qakGwsF-VlIGgbzwn5y-QqPQ1RBJ0Q0s6jLESZRNb8mcDGKm54IFmyoaW7RjM-4B672b1Sno-';

    // // Set up API context
    // $apiContext = new \PayPal\Rest\ApiContext(
    //     new \PayPal\Auth\OAuthTokenCredential($clientID, $secret)
    // );

    // // ID giao dịch cần hoàn
    // $transactionID = $transaction_id;

    // // Số tiền cần hoàn
    // $refundAmount = array('value' => $total, 'currency' => 'USD');

    // // Tạo yêu cầu hoàn tiền
    // $refund = new \PayPal\Api\Refund();
    // $refund->setAmount($refundAmount);

    // try {
    //     // Gửi yêu cầu hoàn tiền với Transaction ID
    //     $refundDetails = \PayPal\Api\Sale::get($transactionID, $apiContext)->refundSale($refund, $apiContext);

    //     // Hoàn tiền đã thành công
    //     // $refundDetails->getId() sẽ trả về ID của giao dịch hoàn tiền
    // } catch (\PayPal\Exception\PayPalConnectionException $ex) {
    //     // Xử lý lỗi
    //     // $ex->getData() sẽ chứa thông tin về lỗi từ PayPal
    // }
    header("Location: ../myAccount_cart_canceled.php");
}
