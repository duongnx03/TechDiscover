<?php
require '../TechDiscovery/admin/config.php';
include "../TechDiscovery/mail/PHPMailer.php";
include "../TechDiscovery/mail/Exception.php";
include "../TechDiscovery/mail/OAuth.php";
include "../TechDiscovery/mail/POP3.php";
include "../TechDiscovery/mail/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "website_td";

// Create a new mysqli connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$error_message = '';

if(isset($_POST["register"])){
    $email = $_POST["email"];
    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Kiểm tra email có thật
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = 'phamphudien901@gmail.com';
        $mail->Password = 'ambevlcjpjsobovr'; // sử dụng mật khẩu ứng dụng
        $mail->FromName = "TechDiscovery Registration";

        $mail->setFrom('phamphudien901@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = 'Email Validation';
        $mail->Body = 'This is a validation email from TechDiscovery Registration.';

        if (!$mail->send()) {
            $error_message = "Invalid email address";
        } else {
            // Hợp lệ và có thật, thực hiện đăng ký
            $verificationCode = rand(100000, 999999);
            $_SESSION['verification_code'] = $verificationCode;

            $query = "INSERT INTO users (email, username, password, fullname, address, phone) VALUES ('$email', '$username', '$password', '$fullname', '$address', '$phone')";
            mysqli_query($conn, $query);

            header("Location: ../TechDiscovery/mail/verify_code.php");
        }
    }
}
if(isset($_POST["register"])){
    $email = $_POST["email"];
    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Kiểm tra email có thật
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = 'phamphudien901@gmail.com';
        $mail->Password = 'ambevlcjpjsobovr'; // sử dụng mật khẩu ứng dụng
        $mail->FromName = "TechDiscovery Registration";

        $mail->setFrom('phamphudien901@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = 'Email Validation';
        $mail->Body = 'This is a validation email from TechDiscovery Registration.';

        if (!$mail->send()) {
            $error_message = "Invalid email address";
        } else {
            // Hợp lệ và có thật, thực hiện đăng ký
            $verificationCode = rand(100000, 999999);
            $_SESSION['verification_code'] = $verificationCode;

            $query = "INSERT INTO users (email, username, password, fullname, address, phone) VALUES ('$email', '$username', '$password', '$fullname', '$address', '$phone')";
            mysqli_query($conn, $query);

            header("Location: ../TechDiscovery/mail/verify_code.php");
        }
    }
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        .error-message {
            font-size: 10px;
            color: white;
            position: absolute;
            top: 0;
            right: 70px;
            padding-top: -30px;
            transition: right 0.3s ease;
        }
    </style>
    <title>REGISTER</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section>   
    <div class="">
            <form action="register.php" method="post" autocomplete="off">
                <h2>Register</h2>
                <div class="input-box input-container">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="email" id="email" required >
                    <label for="email">Email</label>
                    <span class="error-message"><?php echo $error_message; ?></span>
                </div>

                <div class="input-box input-container">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" id="username" required >
                    <label for="username">Username</label>
                    <span class="error-message"><?php echo $error_message; ?></span>
                </div>
                <div class="input-box" >
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" id="password" required >
                    <label class='password'>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="confirmpassword" id="confirmpassword" required>
                    <label class='confirmpassword'>Confirm Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="fullname" id="fullname" required>
                    <label class='fullname'>Full Name</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="map"></ion-icon>
                    </span>
                    <input type="text" name="address" id="address" required>
                    <label class='address'>Address</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call"></ion-icon>
                    </span>
                    <input type="number" name="phone" id="phone" required>
                    <label class='phone'>Phone</label>
                </div>
                <button type="submit" name="register">Register Now</button>
            </form>
        </div>
    </section>    
</body>
</html>
