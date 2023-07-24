<?php
session_start();
$error = $send = '';
if (isset($_SESSION['result'])) {
    if ($_SESSION['result'] == 'fail') {
        $error = $_SESSION['message'];
    } elseif ($_SESSION['result'] == 'success') {
        $send = 'successfully sent';
    }
    unset($_SESSION['result']);
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/99cf1e4b98.js" crossorigin="anonymous"></script>
    <link rel="icon" href="image/logocr.png" type="image/png">
    <title>TechDiscovery</title>
</head>

<body>

    <!-------------------------------------------header--------------------------------------------------->
    <header>
        <div class="logo">
            <img src="image/logocr.png" alt="" width="80px" height="65 px">
        </div>

        <div class="menu">
            <li><a href="index.html"> Home</a></li>

            <li><a href="category.html">Điện Thoại</a>
                <ul class="sub-menu">
                    <li><a href=""> iPhone</a></li>
                    <li><a href=""> SamSung</a></li>
                    <li><a href=""> Xiaomi</a></li>
                    <li><a href=""> OPPO</a></li>
                    <li><a href=""> Realmei</a></li>
                </ul>
            </li>

            <li><a href=""> Laptop</a>
                <ul class="sub-menu">
                    <li><a href="">MacBook</a></li>
                    <li><a href="">DELL</a></li>
                    <li><a href="">ASUS</a></li>
                    <li><a href="">GIGABYTE</a></li>
                    <li><a href="">Lenovo</a></li>
                </ul>
            </li>

            <li><a href=""> Phụ Kiện </a>
                <ul class="sub-menu">
                    <li><a href="">Di động </a></li>
                    <li><a href="">Laptop</a></li>
                    <li><a href="">Thiết bị mạng</a></li>
                    <li><a href="">Camera</a></li>
                </ul>
            </li>

            <li><a href=""> New and Sale</a>
                <ul class="sub-menu">
                    <li><a href="">Hàng Mới Về </a></li>
                    <li><a href="">SALE</a></li>
                    <li><a href="">Siêu Sale Tháng ..</a></li>
                </ul>
            </li> 

            <li><a href=""> Đồ Cũ</a>
                <ul class="sub-menu">
                    <li><a href="">iPhone Cũ </a></li>
                    <li><a href="">Android Cũ</a></li>
                    <li><a href="">Laptop Cũ</a></li>  
                    <li><a href="">Phụ kiện Cũ</a></li>
                </ul>
            </li>

            <li><a href="">About Shop</a>
                <ul class="sub-menu">
                    <li><a href="">Blog</a></li>
                    <li><a href="">Contac US</a></li>
                    <li><a href="">About US</a></li>
                </ul>
            </li> 
        </div>

        <div class="other">
            <li class="search-container"><input type="text" placeholder="search"><a href=""><i class="fa fa-search"></i></a></li>
            <li><a href="" class="fa fa-paw"></a></li>
            <li><a href="" class="fa fa-user"></a></li>
            <li><a href="cart.html" class="fa fa-shopping-bag"></a></li>
        </div>
    </header>
    <!-----------------------------------------end-header--------------------------------------------------->

    <!-------------------------------------------contact--------------------------------------------------->
    <section class="contact">
        <div class="contact_area">
            <div class="row1">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message">
                       <h2>Tell Us Your Subject</h2>
                        <form id="contact-form" method="POST" action="mail/orderConfirm.php">
                            <div class="row1">
                                <div class="col-lg-6">
                                    <input id="name" name="name" placeholder="Name *" type="text">
                                </div>
                                <div class="col-lg-6">
                                    <input id="email" name="email" placeholder="Email *" type="email">
                                </div>
                                <div class="col-lg-6">
                                    <input id="subject" name="subject" placeholder="Subject *" type="text">
                                </div>
                                <div class="col-lg-6">
                                    <input id="phone" name="phone" placeholder="Phone *" type="text">
                                </div>
                                <div class="col-12">
                                    <div class="contact_textarea">
                                        <textarea id="message" placeholder="Message *" name="message"
                                            class="form-control2"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" name="submit"> Send Message </button>
                                </div>
                                <div class="col-lg-6">
                                    <p class="form-messege1"><?php echo $error?></p>
                                    <p class="form-messege2"><?php echo $send?></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="contact_info">
                        <h2>Contact Us</h2>
                        <p>Thank you for choosing TechDiscovery as your preferred destination for all your technology needs.
                             We value your business and are committed to providing exceptional customer service. If you have any 
                             questions, concerns, or need assistance, we are here to help.</p>
                        <p><i class="fa fa-fax"></i> Address: <b> 391a Nam Ky Khoi Nghia Street,
                            Ward 14, District 3, Ho Chi Minh City,
                            VietNam.</b></p>
                        <p><i class="fa fa-envelope-o"></i> Email: <b>TechDiscovery@gmail.com</b></p>
                        <p><i class="fa fa-phone"></i></i> Phone: <b>+0123456789</b></p>
                        <p><b>Working hours:</b></p>
                        <p><strong>Monday – Saturday</strong>: 08AM – 22PM</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact_map">
            <div class="row1">
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2662594205276!2d106.67985067469736!3d10.790907689358715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528d4a7c59c09%3A0x8e2f7cbc924be1db!2zMzkxYSDEkC4gTmFtIEvhu7MgS2jhu59pIE5naMSpYSwgUGjGsOG7nW5nIDE0LCBRdeG6rW4gMywgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1689844397166!5m2!1sen!2s"
                        width="830px" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>    
    </section>
    <!----------------------------------------end-contact------------------------------------------>

    <!-------------------------------------------footer--------------------------------------------------->
    <!-----------------------------------app-container------------------------------------>
    <footer>
        <hr>
        <section class="app-container">
            <div>Tải Ứng Dụng TechDiscovery</div>
            <div class="app-google">
                <img src="image/appstore.jpeg" alt="">
                <img src="image/ggplay.png" alt="">
            </div>
            <div>Nhận Thông Báo Mới Nhất Từ TechDiscovery</div>
            <input type="text" placeholder="Nhập email của bạn...">
        </section>


        <div class="footer-top">
            <li><a href=""><img src="image/logo.png"></a></li>
            <li><a href="contact.html"></a>Contact US</li>
            <li><a href="category.html"></a>Shop</li>
            <li><a href="about.html"></a>About US</li>
            <li>
                <a href="" class="fab fa-facebook-f"></a>
                <a href="" class="fab fa-twitter"></a>
                <a href="" class="fab fa-youtube"></a>
                <a href="" class="fab fa-instagram"></a>
            </li>
        </div>

        <div class="footer-center">
            <p>
                Address: 391a Nam Ky Khoi Nghia Street,
                Ward 14, District 3, Ho Chi Minh City,
                VietNam <br>
                Phone: <b><a href="">+0123456789</a></b> <br>
                Email: <b><a href="">TechDiscovery@gmail.com</a> </b>
            </p>
        </div>

        <div class="footer-bottom">
            @TechDiscovery All right reserved.
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/slider.js"></script>

</body>
<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var subject = document.getElementById('subject').value;
        var phone = document.getElementById('phone').value;
        var message = document.getElementById('message').value;

        if (name === '' || email === '' || subject === '' || phone === '' || message === '') {
            alert('Please fill in all the information in the input fields.');
            return false;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailRegex)) {
            alert('Invalid email');
            return false;
        }

        return true;
    }
    document.getElementById('contact-form').onsubmit = function() {
        return validateForm();
    };
</script>

</html>