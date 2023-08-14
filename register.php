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

$errors = array();

if (isset($_POST["register"])) {

    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    $username = $_POST["username"];
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }
    if ($password !== $confirmpassword) {
        $errors['confirmpassword'] = "Passwords do not match";
    }

    $fullname = $_POST["fullname"];
    if (empty($fullname)) {
        $errors['fullname'] = "Full name is required";
    }

    $address = $_POST["address"];
    if (empty($address)) {
        $errors['address'] = "Address is required";
    }

    $phone = $_POST["phone"];
    if (empty($phone)) {
        $errors['phone'] = "Phone number is required";
    }

    if (count($errors) === 0) {
        $checkQuery = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Thông tin đã tồn tại, yêu cầu người dùng nhập lại
            $errors['duplicate'] = "Email hoặc username đã tồn tại.";
        } else {
            $verificationCode = rand(100000, 999999);
            $_SESSION['verification_code'] = $verificationCode;

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = 'phamphudien901@gmail.com';
            $mail->Password = 'ambevlcjpjsobovr';
            $mail->FromName = "TechDiscovery Registration";

            $mail->setFrom('phamphudien901@gmail.com');
            if (!$mail->addAddress($email)) {
                $errors['email'] = "Invalid address: " . $mail->ErrorInfo;
            } else {
                $mail->Subject = 'Email Validation';
                $mail->Body = 'This is a validation email from TechDiscovery Registration. Verification code: ' . $verificationCode;

                if (!$mail->send()) {
                    $errors['email'] = "Email không tồn tại hoặc không thể gửi được ";
                } else {
                    $currentTime = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

                    $query = "INSERT INTO users (email, username, password, fullname, address, phone, registration_time, verification_code) 
                          VALUES ('$email', '$username', '$password', '$fullname', '$address', '$phone', '$currentTime', '$verificationCode')";

                    if (mysqli_query($conn, $query)) {
                        header("Location: ../TechDiscovery/mail/verify_code.php");
                        exit();
                    } else {
                        $errors['database'] = "Lỗi khi lưu dữ liệu vào cơ sở dữ liệu. Vui lòng thử lại sau.";
                    }
                }
            }
        }
    }
}
//}






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
            font-size: 14px;
            color: red;
            position: absolute;
            top: 0;
            right: -230px;
            padding-top: 20px;
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
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="email" id="email" required value="">
                    <label for="email">Email</label>
                    <div class="error-message">
                        <?php if (isset($errors['email'])) echo $errors['email']; ?>
                    </div>
                    <div class="error-message">
                        <?php if (isset($errors['duplicate'])) echo $errors['duplicate']; ?></div>
                </div>

                <div class="input-box input-container">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" id="username" required>
                    <label for="username">Username</label>
                    <div class="error-password">
                        <?php if (isset($errors['username'])) echo $errors['username']; ?>
                    </div>

                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" id="password" required>
                    <label class='password'>Password</label>
                    <?php if (isset($errors['password'])) echo '<span class="error-message">' . $errors['password'] . '</span>'; ?>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="confirmpassword" id="confirmpassword" required>
                    <label class='confirmpassword'>Confirm Password</label>
                    <?php if (isset($errors['confirmpassword'])) echo '<span class="error-message">' . $errors['confirmpassword'] . '</span>'; ?>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="fullname" id="fullname" required>
                    <label class='fullname'>Full Name</label>
                    <?php if (isset($errors['fullname'])) echo '<span class="error-message">' . $errors['fullname'] . '</span>'; ?>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="map"></ion-icon>
                    </span>
                    <input type="text" name="address" id="address" required>
                    <label class='address'>Address</label>
                    <?php if (isset($errors['address'])) echo '<span class="error-message">' . $errors['address'] . '</span>'; ?>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call"></ion-icon>
                    </span>
                    <input type="number" name="phone" id="phone" required>
                    <label class='phone'>Phone</label>
                    <?php if (isset($errors['phone'])) echo '<span class="error-message">' . $errors['phone'] . '</span>'; ?>
                </div>
                <button type="submit" name="register">Register Now</button>
            </form>
        </div>
    </section>
</body>

</html>
