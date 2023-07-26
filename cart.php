<?php
include "header.php";

?>

<!---------------------------------------start-cart--------------------------------------------------->
<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart cart-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="cart-top-address cart-top-item">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="cart-top-payment cart-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cart-content row">
            <div class="cart-content-left">
                <table>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Ram</th>
                        <th>Màu Sắc</th>
                        <th>SL</th>
                        <th>Thành Tiền</th>
                        <th>Xoá</th>
                    </tr>
                    <tr>
                        <td><img src="image/cate1-gold.webp">
                            <p>iPhone 14 Pro Max | Chính hãng VN/A</p>
                        </td>
                        <td>
                            <p>128GB</p>
                        </td>
                        <td>Gold</td>
                        <td><input type="number" value="1" min="1"></td>
                        <td>
                            <p>24.590.000<span>₫</span></p>
                        </td>
                        <td><span class="delete-product-cart">X</span></td>
                    </tr>
                    <tr>
                        <td><img src="image/cate2.webp">
                            <p>iPhone 14 | Chính hãng VN/A</p>
                        </td>
                        <td>
                            <p>128GB</p>
                        </td>
                        <td>Vàng</td>
                        <td><input type="number" value="1" min="1"></td>
                        <td>
                            <p>19.090.000<span>₫</span></p>
                        </td>
                        <td><span class="delete-product-cart">X</span></td>
                    </tr>
                </table>
            </div>
            <div class="cart-content-right">
                <table>
                    <tr>
                        <th colspan="2">Tổng tiền tạm tính:</th>
                    </tr>
                    <tr>
                        <td>Tổng Sản Phẩm</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Tổng Tiền Hàng</td>
                        <td>24.590.000<span>₫</span></td>
                    </tr>
                    <tr>
                        <td>Thành Tiền</td>
                        <td>
                            <p>24.290.000<span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Tạm Tính</td>
                        <td>
                            <p style="color: black; font-weight:bold;">24.290.000<span>₫</span></p>
                        </td>
                    </tr>
                </table>
                <div class="cart-content-right-text">
                    <p style="color: rgb(52, 178, 84); font-weight:bold;">Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 2.000.000<span>₫</span>*</p>
                    <p style="color: rgb(244, 8, 63); font-weight:bold;">Mua thêm 10.000.000<span>₫</span> để được miễn phí SHIP *</p>
                </div>
                <div class="cart-content-right-button">
                    <button><a href="delivery.php">TIẾN HÀNH THANH TOÁN</a></button>
                    <button><a href="category.php">CHỌN THÊM SẢN PHẨM KHÁC</a></button>
                </div>
                <div class="cart-content-right-login">
                    <p>TechDiscovery!</p>
                    <p>Hãy <a href="login.html">Đăng Nhập</a> Để Tiếp Tục Mua Sắm Và Tích Điểm Thưởng Nhé!</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
   include "footer.php";
?>