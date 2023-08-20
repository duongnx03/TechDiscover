
<?php
require '../TechDiscovery/admin/config.php';
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
if (isset($_POST["submit"])) {
    $emailusername = $_POST["emailusername"];
    $password = $_POST["password"]; 
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$emailusername' OR email ='$emailusername'");
    $row = mysqli_fetch_assoc($result);
    
    
    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $row["password"])) { // Sử dụng password_verify để so sánh mật khẩu đã hash
            if ($row["is_online"] == 2) {
                echo "<script>alert('This account is banned. Please contact support for assistance.');</script>";
            } else {
                // Tiếp tục xử lý đăng nhập bình thường
                $user_id = $row["id"];
                $is_online = 1; // Online
                $sql = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
                mysqli_query($conn, $sql);
    
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
    
                if ($row["role"] == "admin") {
                    header("Location: admin/index.php");
                } else {
                    header("Location: index.php");
                }
            }
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('Username Not Registered');</script>";
    }
    
    
    
    
    
}



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
