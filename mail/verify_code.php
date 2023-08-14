<?php
define("APPPATH", "./");

include APPPATH . "PHPMailer.php";
include APPPATH . "Exception.php";
include APPPATH . "OAuth.php";
include APPPATH . "POP3.php";
include APPPATH . "SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();

if(isset($_POST['verification_code'])) {
    $verificationCode = $_POST['verification_code'];

    if ($verificationCode == $_SESSION['verification_code']) {
        
        echo "Verification successful! You can now complete the registration process.";
        header("Location: ../login.php");
    } else {
        // Mã xác nhận không chính xác
        echo "Incorrect verification code. Please try again.";
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<section>
<div class="login-box">
            <form action="" method="post" autocomplete="off">
                <h2>Code</h2>
            <div class="input-box">
                    <span class="icon">
                        <ion-icon name="key"></ion-icon>
                    </span>
                    <input type="text" name="verification_code" id="verification_code" placeholder="" required >
                    <label for="verification_code">Verification Code</label>
                    </div>
                <button type="submit">Verify</button>
          
            </form>
</div>
</section>
 
</body>
</html>
