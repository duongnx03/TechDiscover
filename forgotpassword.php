<?php
session_start();
$error[] = array();
if(!$conn = mysqli_connect("localhost", "root", "" , "login")){
    die("couldn't not connect");
}
$error = array();
$mode = "enter_email";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}
if (count($_POST) > 0) {
    switch ($mode) {
        case 'enter_email':
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error[] = "Please enter a valid email";
            }elseif(!valid_email($email)){
                $error[] = "That email was not found";
            }else{
            $_SESSION['email'] = $email;
            send_email($email); 
            header("Location: forgotpassword.php?mode=enter_code");
            die;
            }
            break;

        case 'enter_code':
            $code = $_POST['code'];
            $result = is_code_correct($code);
            if($result == "the code is correct"){
                header("Location: forgotpassword.php?mode=enter_password");
                die;
            }else{
                $error[] = $result;
            }
           
            break;

        case 'enter_password':
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if($password !== $password2 ){
                $error[] = "Passwords do not match";
            }else{
                save_password($password);
                header("Location: login.php");
                die;
            }
            break;

        default:
            break;
    }
}

function send_email($email){
    global $conn;
    if (!$conn) {
        die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $expire = time() + (60 * 1);
    $code = rand(100000, 999999);
    $email = addslashes($email);
    $query = "INSERT INTO codes (email, code, expire) VALUES ('$email', '$code', '$expire')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return "The code sent your email";
    } else {
        $error[] = "Có lỗi khi gửi code. Vui lòng thử lại sau!";
    }
}
function save_password($password){
    global $conn;
    if (!$conn) {
        die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }

    $password2 = addslashes($_POST['password2']);
    if ($password !== $password2) {
        $error[] = "Mật khẩu không khớp. Vui lòng nhập lại!";
        return;
    }

    //$password = password_hash($password, PASSWORD_DEFAULT);
    $email = addslashes($_SESSION['email']);
    $query = "UPDATE user SET password = '$password' WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Thành công, bạn có thể làm gì đó nếu cần
    } else {
        $error[] = "Có lỗi khi cập nhật mật khẩu. Vui lòng thử lại sau!";
    }
}

function valid_email($email){
    global $conn;
    if (!$conn) {
        die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }
    $email = addslashes($email);
    $query = "select * from user where email = '$email' limit 1";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            return true;
        }
    }
    return false;

}
function is_code_correct($code){
    global $conn;
    if (!$conn) {
        die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
    }
    $code = addslashes($code);
    $expire = time();
    $email = addslashes($_SESSION['email']);
    $query = "select * from codes where code = '$code' && email = '$email' && expire > '$expire' order by id desc limit 1";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['expire'] > $expire){
                return "the code is correct";
            }else{
                return "the code is expired";
            }
        }else{
            return "the code is incorrect";
        }
    }
    return "the code is incorrect";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    
<?php
switch($mode){
    case 'enter_email':
     ?>
       <form action="forgotpassword.php?mode=enter_email" method="post">
          <h2>Enter your email below</h2>
          <span style="font-size: 12px; color:red;">
          <?php
          foreach($error as $err){
            echo $err . "<br>";
          }
          ?>
          </span>
          <input type="email" name="email" placeholder="Email"><br>
          <br style="clear:both;">
          <input type="submit" value="Next">
          <br><br>
          <div><a href="login.php">Login</a></div>
    </form>
    <?php
    break;
    case 'enter_code':
     ?>
        <form action="forgotpassword.php?mode=enter_code" method="post">
          <h2>Enter your the code sent your email</h2>
          <span style="font-size: 12px; color:red;">
          <?php
          foreach($error as $err){
            echo $err . "<br>";
          }
          ?>
          </span>
          <input type="email" name="code" placeholder="Code"><br>
          <br style="clear:both;">
          <a href="forgotpassword.php?mode=enter_password">
                <input type="button" value="Next">
          </a>
          <a href="">
            <input type="button" value="Return">
          </a>
          
          <br><br>
          <div><a href="login.php">Return</a></div>
    </form>
    <?php
    break;
    case 'enter_password':
     ?>
<form action="forgotpassword.php?mode=enter_password" method="post">
    <h2>Enter your new password</h2>
    <span style="font-size: 12px; color:red;">
        <?php
        foreach($error as $err){
            echo $err . "<br>";
        }
        ?>
    </span>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="password2" placeholder="Retype Password"><br>
    <br style="clear:both;">
    <input type="submit" value="Start Over">
    <br><br>
    <div><a href="login.php">Login</a></div>
</form>

    <?php
     break;
        default:

        break;
    }
    ?>
 
</body>
</html>