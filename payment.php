<?php
include "header.php";

?>

<!--------------------------------------------payment------------------------------------------------------>

<section class="payment">
    <div class="container">
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-cart payment-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="payment-top-address payment-top-item">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold;">Phương Thức Giao Hàng</p>
                    <div class="payment-content-left-method-delivery-item">
                        <input type="radio" name="">
                        <label for="">Giao Hàng Chuyển Phát Nhanh</label>
                    </div>
                </div>
                <div class="payment-content-left-method-payment">
                    <p style="font-weight: bold;">Phương Thức Thanh Toán</p>
                    <p>Mọi giao dịch đều được mã hoã và bảo mật khi thanh toán. Thông tin thẻ tín dụng sẽ không được lưu lại.</p>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment">
                        <label for="">Thanh Toán Bằng Thẻ Tín Dụng (OnePay)</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/visa.png">
                        <img src="image/payment-icon copy/mastercart.png" alt="">
                        <img src="image/payment-icon copy/paypal.png" alt="">
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment">
                        <label for="">Thanh Toán Bằng Thẻ ATM</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/vcbbank.jpeg" alt="" width="120px" height="40px">
                        <img src="image/payment-icon copy/mbbank.png" alt="" width="120px" height="40px">
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment">
                        <label for="">Thanh Toán Bằng MOMO</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/momo.png" alt="" width="120px" height="40px">
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment">
                        <label for="">Thanh Toán Bằng Khi Nhận Hàng</label>
                    </div>
                </div>
            </div>

            <div class="payment-content-right">
                <div class="payment-content-right-button row">
                    <input type="text" placeholder="Mã Giảm Giá/Quà Tặng">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Mã Công Tác Viên">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-staff">
                    <select name="" id="">
                        <option value="">Chọn Mã Nhân Viên Thân Thiết</option>
                        <option value="">D333</option>
                        <option value="">D111</option>
                        <option value="">T222</option>
                        <option value="">T444</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-content-right-payment">
            <button>TIẾP TỤC THANH TOÁN</button>
        </div>
    </div>
</section>




<?php
   include "footer.php";
?>