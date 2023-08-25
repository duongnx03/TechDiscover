<?php
include "header.php";
include "navbar.php";
?>
<?php


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

if (isset($_SESSION["id"])) {
    $loggedInUserId = $_SESSION["id"];
    // Truy vấn thông tin tài khoản người dùng đã đăng nhập
    $query = "SELECT * FROM users WHERE id = $loggedInUserId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
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
    <title>Document</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" cro </head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="file-upload">
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Username" value="<?php echo " " . $user["username"] ?>">
                                    </div>
                                    <!-- Last name -->
                                    <div class="col-md-6">
                                        <label class="form-label">Fullname</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Fullname" value="<?php echo "" . $user["fullname"] ?>">
                                    </div>
                                    <!-- Phone number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Email" value="<?php echo "" . $user["email"] ?>">
                                    </div>
                                    <!-- Mobile number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile number *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Phone number" value="<?php echo "" . $user["phone"] ?>">
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="Address" value="<?php echo " " . $user["address"] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="Password" value="<?php echo " " . $user["password"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

