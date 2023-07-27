<?php
include "header.php";

?>
<!--------------------------------------------check-out------------------------------------------------------>

<section class="delivery">
    <div class="container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-cart delivery-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="delivery-top-address delivery-top-item">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="delivery-top-payment delivery-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <p>Vui lòng chọn địa chỉ giao hàng</p>
                <div class="delivery-content-left-login row">
                    <i class="fas fa-sign-in-alt"></i>
                    <p> Đăng Nhập (Nếu đã có tài khoản)</p>
                </div>
                <div class="delivery-content-left-sigle-customer row">
                    <input name="customers" type="radio">
                    <p><span style="font-weight: bold;">Khách Lẻ</span>(Mua mà không cần đăng nhập hay lưu lại thông tin)</p>
                </div>
                <div class="delivery-content-left-register row">
                    <input name="customers" type="radio">
                    <p><span style="font-weight: bold;">Đăng ký</span>(Tạo tài khoản mới)</p>
                </div>
                <div class="delivery-content-left-input-top row">
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Họ Tên: <span style="color: red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Điện Thoại: <span style="color: red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Tỉnh/TP: <span style="color: red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Quận/Huyện: <span style="color: red;">*</span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Phường/Xã: <span style="color: red;">*</span></label>
                        <input type="text">
                    </div>
                </div>
                <div class="delivery-content-left-input-top-item">
                    <label for="">Địa Chỉ (Chi Tiết): <span style="color: red;">*</span></label>
                    <input type="text">
                </div>
                <div class="delivery-content-left-button row">
                    <a href="cart.html">
                        <p>&#171;</p>Quay Lại Giỏ Hàng
                    </a>
                    <button>
                        <p style="font-weight: bold;"><a href="payment.php"> Thanh Toán Và Giao Hàng</a></p>
                    </button>
                </div>
            </div>
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Giảm Giá</th>
                        <th>Số Lượng</th>
                        <th>Thành Tiền</th>
                    </tr>
                    <tr>
                        <td>iPhone 14 Pro Max 128GB | Chính hãng VN/A</td>
                        <td>-2%</td>
                        <td>1</td>
                        <td>
                            <p>24.190.000<span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>iPhone 14 Pro Max 128GB | Chính hãng VN/A</td>
                        <td>-2%</td>
                        <td>1</td>
                        <td>
                            <p>24.190.000<span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Tổng</td>
                        <td style="font-weight: bold;">
                            <p>48.380.000<span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Thuế VAT</td>
                        <td style="font-weight: bold;">
                            <p>1.000.000<span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Tổng Thanh Toán</td>
                        <td style="font-weight: bold;">
                            <p>49.380.000<span>₫</span></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>




<?php
   include "footer.php";
?>