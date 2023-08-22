<?php
include 'admin/class/survey_class.php';
?>
<?php
$coupon_code = ""; // Khởi tạo biến để lưu mã giảm giá

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupon = new coupon();

    // Lấy một mã giảm giá còn hiệu lực từ cơ sở dữ liệu
    $coupon_code = $coupon->get_valid_coupon_code();
    // if ($coupon_code) {
    //     // Trừ quantity của mã giảm giá đi 1 đơn vị
    //     $coupon_info = $coupon->get_coupon_by_id($coupon_code);
    //     if ($coupon_info) {
    //         $coupon_id = $coupon_info['coupon_id'];
    //         $quantity = $coupon->get_coupon_quantity($coupon_id);
            
    //         if ($quantity > 0) {
    //             // Giảm số lượng đi 1
    //             $coupon->update_coupon_quantity($coupon_id, $quantity - 1);
    //         } else {
    //             $coupon_code = ""; // Reset biến nếu số lượng hết
    //         }
    //     } else {
    //         $coupon_code = ""; // Reset biến nếu không tìm thấy thông tin mã giảm giá
    //     }
    // }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body{
        background-color: #eeeeee;
    }
    .tieude h1{
        text-align: center;
            color: #444444;
            font-family: monospace;
            font-size: 40px;
            margin-top: 10px;
    }
    .tieude h2{
        color: red;
        font-size: 35px;
        text-align: center;
            font-family: monospace;
    }
    .code {
       background-color: white;
        width: 520px;
        margin: 0 auto; /* Center the block horizontally */
        padding: 20px;
        margin-top: 20px;
        border-radius: 7px;
    }
    .code h3{
        font-size: 22.5px;
        text-align: center;
    }
    .code h1{
        color: blue;
        text-align: center;
        font-size: 40px;
    }
    .code h4{
        text-align: center;
        color: red;
        font-size: 20px
        
    }
    .code img{
        width: 60px;
        height: 60px;
    }
    .code p{
        margin-bottom: -20px;
        text-align: right;
        font-size: 10px;
    }
    .home {
        text-align: center;
        margin-top: 20px;
    }

    
</style>
<body>
    

<div class="container">
    <div class="tieude">
        <h1>Thank you for submitting the survey!</h1>
        <h2>Before leaving the site, please remember this code because you won't see it again!</h1>
    </div>

    <?php if ($coupon_code): ?>
    <div class="code">
        <h6><img src="image/logocr.png" alt=""></h6>
        <h3>CONGRATE! YOUR CODE IS</h3><br>
        <h1><?php echo $coupon_code; ?></h1><br><br>
        <h4>!! DON'T FORGET THE CODE</h4><br>
        <p>-This promotion belongs to Tech Discovery-</p>
    </div>
    <?php else: ?>
    <div class="code">
        <h6><img src="image/logocr.png" alt=""></h6>
        <h3>No valid coupon code available at the moment.</h3><br>
    </div>
    <?php endif; ?>
    <div class="home"><a href="index.php">!!!Click Here To Exit Promotion Site</a></div>
</div>
</body>