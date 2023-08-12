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
    <form action="admin/process-payment.php" method="post">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-method-payment">
                    <p style="font-weight: bold;">Payment methods</p> <br>
                    <p>All transactions are encrypted and secure when paying. Credit card information will not be saved.</p> <br>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment" value="credit-card">
                        <label for="">Paying By Credit Card (OnePay)</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/visa.png">
                        <img src="image/payment-icon copy/mastercart.png" alt="">
                        <img src="image/payment-icon copy/paypal.png" alt="">
                    </div> <br>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment" value="atm-card">
                        <label for="">Paying With ATM Card</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/vcbbank.jpeg" alt="" width="120px" height="40px">
                        <img src="image/payment-icon copy/mbbank.png" alt="" width="120px" height="40px">
                    </div> <br>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment" value="momo">
                        <label for="">Paying With MOMO</label>
                    </div>
                    <div class="payment-content-left-method-payment-item-img">
                        <img src="image/payment-icon copy/momo.png" alt="" width="120px" height="40px">
                    </div> <br>
                    <div class="payment-content-left-method-payment-item">
                        <input type="radio" name="method-payment" value="payment-on-delivery">
                        <label for="">Payment on delivery</label>
                    </div>
                </div>
            </div>

            <div class="payment-content-right">
                <div class="payment-content-right-button row">
                    <input type="text" placeholder="Discount/Gift Code">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Employee Code">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div class="payment-content-right-staff">
                    <select name="" id="">
                        <option value="">Choose Employee Loyalty Code</option>
                        <option value="">D333</option>
                        <option value="">D111</option>
                        <option value="">T222</option>
                        <option value="">T444</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-content-right-payment">
            <button type="submit">Order</button>
        </div>
        </form>
    </div>
</section>




<?php
   include "footer.php";
?>