
<?php
require 'config.php';
session_start();
if(isset($_POST["submit"])){
    $emailusername = $_POST["emailusername"];
    $password = $_POST["password"]; 
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$emailusername' OR email ='$emailusername'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){  
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: home.php");
        }else{
            echo "<script>Wrong Password</scrpit>";
        }
    }else{
        echo"<script>Username Not Registered</script>";
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