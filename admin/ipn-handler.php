<?php
$raw_post_data = file_get_contents('php://input');
$decoded_data = urldecode($raw_post_data);

// Ghi thông báo IPN vào tệp tin log
file_put_contents('ipn_log.txt', $decoded_data . "\n\n", FILE_APPEND);

// Gửi HTTP 200 OK response để thông báo cho PayPal rằng thông báo đã được nhận
http_response_code(200);
?>