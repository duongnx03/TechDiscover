<?php

session_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'website_td';

// Create a connection to the database using MySQLi.
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful or display an error message.
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}
// Lấy ID của người dùng từ phiên đăng nhập
$user_id = $_SESSION["id"];
$is_online = 0; // Offline

// Cập nhật trạng thái offline của người dùng
$sql = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
mysqli_query($conn, $sql);

// Hủy phiên đăng nhập bằng cách xóa tất cả các biến phiên
session_unset();

// Hủy phiên
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập sau khi đã đăng xuất
header("Location: login.php");
exit();
?>
