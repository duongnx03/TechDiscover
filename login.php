<?php

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
if (isset($_POST["submit"])) {
    $emailusername = $_POST["emailusername"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username ='$emailusername' OR email ='$emailusername'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            if ($row["is_online"] != 2) {
                $_SESSION["id"] = $row["id"];
                $user_id = $row["id"];
                $is_online = 1; // Trạng thái online
                $sql_update_online = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
                mysqli_query($conn, $sql_update_online);

                if ($row["role"] == "admin") {
                    header("Location: admin/index.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                echo "<script>alert('This account is banned. Please contact support for assistance.');</script>";
            }
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('Username Not Registered');</script>";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <section>
    <div class="login-box">
        <form action="" method="post" autocomplete="off">
            <h2>Login</h2>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="text" name="emailusername" id="emailusername" required >
                <label for="emailusername">Username</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>
            <button type="submit" name="submit">Login</button>
            <div class="register-link">
                <p>Don't have an account you can<a href="register.php">Register now</a></p>
            </div>  
        </form>
    </div>
    </section>
 
</body>
</html>
