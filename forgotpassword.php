<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "website_td");
$error = array();

if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

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
                if ($result == "Mã xác thực hợp lệ.") {
                    $_SESSION['is_correct_code'] = true;
                    header("Location: forgotpassword.php?mode=enter_password");
                    die;
                } else {
                    $error[] = $result;
                }
                break;
    
            case 'enter_password':
                if (isset($_SESSION['is_correct_code']) && $_SESSION['is_correct_code'] === true) {
                    $password = $_POST['password'];
                    $password2 = $_POST['password2'];
                    if ($password !== $password2) {
                        $error[] = "Passwords do not match";
                    } else {
                        save_password($password);
                        header("Location: login.php");
                        die;
                    }
                } else {
                    header("Location: forgotpassword.php?mode=enter_email");
                    die;
                }
                break;
    
            default:
                break;
        }
    }
    


function send_email($email) {
    global $conn;
    
    $expire = time() + (60 * 1);
    $code = rand(100000, 999999);
    $email = addslashes($email);
    $query = "INSERT INTO codes (email, code, expire) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        return "Lỗi khi chuẩn bị truy vấn: " . mysqli_error($conn);
    }
    
    mysqli_stmt_bind_param($stmt, "ssi", $email, $code, $expire);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        // Gửi mã xác thực đến email ở đây
        return "Mã xác thực đã được gửi đến email của bạn.";
    } else {
        $error[] = "Có lỗi khi gửi code. Vui lòng thử lại sau!";
    }
}

function save_password($password) {
    global $conn;
    
    $password2 = addslashes($_POST['password2']);
    if ($password !== $password2) {
        return "Mật khẩu không khớp. Vui lòng nhập lại!";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = addslashes($_SESSION['email']);
    $query = "UPDATE users SET password = ? WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        return "Lỗi khi chuẩn bị truy vấn: " . mysqli_error($conn);
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $password, $email);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        return "Mật khẩu đã được cập nhật thành công!";
    } else {
        $error[] = "Có lỗi khi cập nhật mật khẩu. Vui lòng thử lại sau!";
    }
}

function valid_email($email) {
    global $conn;
    
    $email = addslashes($email);
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        return "Lỗi khi chuẩn bị truy vấn: " . mysqli_error($conn);
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        $row = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($row) > 0) {
            return true;
        }
    }
    return false;
}


function is_code_correct($code) {
    global $conn;
    
    $email = $_SESSION['email'];

    $query = "SELECT * FROM codes WHERE code = ? AND email = ? AND expire > ? ORDER BY id DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        return "Lỗi khi chuẩn bị truy vấn: " . mysqli_error($conn);
    }
    

    $expire = time();
    
    mysqli_stmt_bind_param($stmt, "ssi", $code, $email, $expire);
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['expire'] > $expire) {
            return "Mã xác thực hợp lệ.";
        } else {
            return "Mã xác thực đã hết hạn.";
        }
    } else {
        return "Mã xác thực không đúng.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Forgot Password</title>
</head>
<body>
    
<?php
switch($mode){
    case 'enter_email':
     ?>

    <section>
    <div class="login-box">
       <form action="forgotpassword.php?mode=enter_email" method="post">
          <h2>Enter your email</h2>
          <span style="font-size: 12px; color:red;">
          <?php
          foreach($error as $err){
            echo $err . "<br>";
          }
          ?>
          </span>
        <div class="input-box">
            <input type="email" name="email" placeholder="Email"><br>
        </div>
          <button type="submit" value="Next">Next</button>
          <br></br>
    </form>
    </div>  
    </section>
    <?php
    break;

    case 'enter_code':
     ?>
      <section>
    <div class="login-box">
        <form action="forgotpassword.php?mode=enter_code" method="post">
          <h2>Enter your the code </h2>
          <span style="font-size: 12px; color:red;">
          <?php
          if (is_array($error)) {
            foreach ($error as $err) {
                echo $err . "<br>";
            }
        } else {
            echo "An error occurred.";
        }   
          ?>
          </span>

          <div class="input-box">
            <input type="number" name="code" placeholder="Code">
          </div>

          <button type="submit" value="Next">Next</button>

          <br></br>
    </form>
    </div>
    </section>
    <?php
    break;
    case 'enter_password':
        if (isset($_SESSION['is_correct_code']) && $_SESSION['is_correct_code'] === true) {
            ?>
               <section>
    <div class="login-box">
            <form action="forgotpassword.php?mode=enter_password" method="post">
                <h2>Enter new password</h2>
                <span style="font-size: 12px; color:red;">
                    <?php
                       if (is_array($error)) {
                        foreach ($error as $err) {
                            echo $err . "<br>";
                        }
                    } else {
                        echo "An error occurred.";
                    }   
                    ?>
                </span>
                <div class="input-box">
                <input type="password" name="password" placeholder="New Password">
                </div>
                <div class="input-box">
                <input type="password" name="password2" placeholder="Confirm New Password">
                </div>
                <br style="clear:both;">
                <button type="submit" >Start Over</button>
                <br><br>
            </form>
        </div>
        </section>
            <?php
        } else {
            header("Location: forgotpassword.php?mode=enter_email");
            die;
        }
        break;

    default:
        break;
}
    ?>
 
</body>
</html>
