<?php
require '../TechDiscovery2/admin/config.php';
session_start();
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' or email = '$email'");
        if(mysqli_num_rows($duplicate) > 0){
        echo "<script> alert('Username or Email has already taken');</script>";    
    }else{
        if($password == $confirmpassword){
            $query = "INSERT INTO user VALUES('','$email','$username','$password','$fullname','$address','$phone')";
            mysqli_query($conn, $query);
            header("Location: login.php");
        }else{
            echo "<script> alert('Password is not the same');</script>";    
        }
      
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>
<body>
    <section>
    <div class="">
        <form action="" method="post" autocomplete="off">
            <h2>Register</h2>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="text" name="email" id="email" required >
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="text" name="username" id="username" required >
                <label for="username">Username</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password" id="password" required >
                <label class='password'>Password</label>
                </div>
                <div class="input-box">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="text" name="confirmpassword" id="confirmpassword" required>
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
            <button type="submit" name="submit">Register Now</button>

        </form>
    </div>
 
    </section>    
</body>
</html>