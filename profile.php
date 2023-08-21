<?php
require 
require '../TechDiscovery/admin/config.php';
session_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'website_td';

// Tạo lại kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check nếu kết nối thành công
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if (isset($_SESSION["id"])) {
    $loggedInUserId = $_SESSION["id"];
    // Truy vấn thông tin tài khoản người dùng đã đăng nhập
    $query = "SELECT * FROM users WHERE id = $loggedInUserId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Hiển thị thông tin tài khoản
        echo "Welcome, " . $user["fullname"] . "!<br>";
        echo "Email: " . $user["email"] . "<br>";
        echo "Username: " . $user["username"] . "<br>"; 
        echo "Fullname: " . $user["fullname"] . "<br>";
        echo "Address: " . $user["address"] . "<br>";
        echo "Phone: " . $user["phone"] . "<br>";
    } else {
        echo "User not found.";
    }
} else {
    // Xử lý đăng nhập
    if (isset($_POST["submit"])) {
        // ... (code xử lý đăng nhập không thay đổi)
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!-- Tiếp tục phần HTML của trang -->
