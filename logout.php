<?php
session_start();

if (isset($_SESSION["id"]) && isset($_SESSION["role"])) {
    $user_id = $_SESSION["id"];

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

    // Cập nhật trạng thái offline của người dùng
    $is_online = 0;
    $sql = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
    
    if (mysqli_query($conn, $sql)) {
        // Hủy phiên đăng nhập bằng cách xóa tất cả các biến phiên
        session_unset();

        // Hủy phiên
        session_destroy();

        // Nếu role là "admin", chuyển hướng người dùng đến trang đăng nhập admin
        if ($_SESSION["role"] === "admin") {
            header("Location: admin/login.php");
        } else {
            // Chuyển hướng người dùng đến trang đăng nhập bình thường
            header("Location: login.php");
        }
        exit();
    } else {
        echo "SQL error: " . mysqli_error($conn);
    }
} else {
    // Không có phiên đăng nhập hoặc các giá trị trong phiên không đúng
    header("Location: login.php");
    exit();
}

?>
