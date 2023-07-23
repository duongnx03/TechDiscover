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
        <form action="inputcodeforgotpassword.php" method="post" autocomplete="off">
            <h2>Forgot Pasword</h2>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="text" name="emailforgot" id="emailforgot" required >
                <label for="emailforgot">Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="passwordforget" name="passwordforget" id="passwordforget" required>
                <label for="passwordforget">Reset Password</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="passwordforget" name="passwordforget" id="passwordforget" required>
                <label class='passwordforget'>Confirm Password</label>
            </div>
   
                <button type="submit" name="submit">Confirm</button>


            
           

        </form>
    </div>
    </section>
    
</body>
</html>