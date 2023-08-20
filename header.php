<?php
session_start();

$myAccountLink = ''; // Khởi tạo giá trị mặc định cho liên kết "My Account"

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION["login"]) && isset($_SESSION["id"])) {
    $userId = $_SESSION["id"];

    require 'admin/config.php';

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website_td';

    // Tạo kết nối đến cơ sở dữ liệu bằng MySQLi
    $conn = mysqli_connect($hostname, $username, $password, $database);

    // Kiểm tra xem kết nối có thành công không
    if (!$conn) {
        die("Database connection error: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Nếu người dùng tồn tại, hiển thị liên kết "My Account"
        $myAccountLink = '<li><a href="my-account.php">My Account</a></li>';
    } else {
        // Nếu không tìm thấy người dùng, xóa phiên và đăng xuất
        unset($_SESSION["login"]);
        unset($_SESSION["id"]);
        header("Location: login.php");
        exit();
    }

    $conn->close();
}

$loginLink = '<li><a href="login.php">Login</a></li>';
?>

<!-- Các phần còn lại của header.php -->

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>TechDiscovery</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="image/logocr.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://kit.fontawesome.com/99cf1e4b98.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 10% - 20% off on Smartphone
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 15% off Entire Purchase Promo code: offTD15
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 5/9 Free full day shipping
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 8%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 5% - 8% off on Apple
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 5% off Enter discount Code to buy: offTD5
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 30% Accessory! Shop Now
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


                    <div class="our-link">
                        <ul>

                            <li><a href="profile.php">My Account</a></li>
                            <li><a href="https://www.google.com/maps/place/391A+%C4%90.+Nam+K%E1%BB%B3+Kh%E1%BB%9Fi+Ngh%C4%A9a,+Ph%C6%B0%E1%BB%9Dng+14,+Qu%E1%BA%ADn+3,+Th%C3%A0nh+ph%E1%BB%91+H%E1%BB%93+Ch%C3%AD+Minh+700000/@10.7907758,106.6818425,17z/data=!3m1!4b1!4m6!3m5!1s0x317528d4a8afdb7b:0x2e46c4ada94947dd!8m2!3d10.7907758!4d106.6818425!16s%2Fg%2F11h89s2mz2?hl=en&entry=ttu">Our location</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>
                            <?php
                            if (isset($_SESSION["login"])) {
                                echo '<li><a href="logout.php">Logout</a></li>';
                            } else {
                                echo '<li><a href="login.php">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    window.addEventListener('beforeunload', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'logout.php', false); // Thay đổi URL của trang logout.php của bạn
        xhr.send();
    });
</script>
    <!-- End Main Top -->
