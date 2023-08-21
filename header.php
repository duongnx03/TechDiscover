<?php
session_start();
include "admin/database.php";
$db = new Database();
$loginLink = '<li><a href="login.php">Login</a></li>'; // Mặc định là liên kết đăng nhập

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION["id"])) {
    $loginLink = '<li><a href="logout.php">Logout</a></li>'; // Liên kết đăng xuất nếu đã đăng nhập
}
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
                        <?php
                        if (isset($_SESSION["id"])) {
                            $user_id = $_SESSION["id"];
                            $is_online = 1; // Online

                            // Cập nhật trạng thái trực tuyến của người dùng
                            $sql = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
                            $result = $db->update($sql);

                            echo '<ul>';
                            echo '<li><a href="my-account.php">My Account</a></li>';
                            echo '<li><a href="https://www.google.com/maps/place/...">Our location</a></li>';
                            echo '<li><a href="contact-us.php">Contact Us</a></li>';
                            echo '<li><a href="logout.php">Logout</a></li>';
                            echo '</ul>';
                        } else {
                            echo '<ul>';
                            echo '<li><a href="https://www.google.com/maps/place/...">Our location</a></li>';
                            echo '<li><a href="contact-us.php">Contact Us</a></li>';
                            echo '<li><a href="login.php">Login</a></li>';
                            echo '</ul>';
                        }
                        ?>
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
