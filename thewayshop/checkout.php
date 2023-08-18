<?php
include "header.php";
include "navbar.php";
$user_query = "SELECT * FROM users where id = $user_id";
$user_result = $database->select($user_query);
if ($user_result) {
    $row = $user_result->fetch_assoc();
    $user_name = $row['fullname'];
    $email = $row['email'];
    $address = $row['address'];
    $phone = $row['phone'];
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <form action="../admin/process-order.php" method="post" onsubmit="return validateForm();">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username *</label>
                            <div class="input-group">
                                <input type="text" name="username" class="form-control" id="username" required value="<?php if (!empty($user_name)) {
                                                                                                                            echo $user_name;
                                                                                                                        } ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Phone *</label>
                            <input type="text" name="phone" class="form-control" id="phone" required value="<?php if (!empty($phone)) {
                                                                                                                echo $phone;
                                                                                                            } ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" class="form-control" id="email" required value="<?php if (!empty($email)) {
                                                                                                                    echo $email;
                                                                                                                } ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address">Address *</label>
                            <input type="text" name="address" class="form-control" id="address" required value="<?php if (!empty($address)) {
                                                                                                                    echo $address;
                                                                                                                } ?>">
                        </div>
                        <hr class="mb-4">
                        <div class="title"> <span>Payment</span> </div>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required value="COD">
                                <label class="custom-control-label" for="credit">COD</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required value="MOMO">
                                <label class="custom-control-label" for="debit">MOMO</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required value="Paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <hr class="mb-1">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio" value="Standard Delivery">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span>
                                    </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio" value="Express Delivery">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">$10.00</span>
                                    </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio" value="Next Business day">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">$20.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <?php
                                if (!empty($cartItems)) {
                                    foreach ($cartItems as $item) {
                                ?>
                                        <div class="rounded p-2 bg-light">
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"><?php echo $item['product_name'] ?> | <?php echo $item['product_color'] ?> | <?php echo $item['product_memory_ram'] ?></a>
                                                    <div class="small text-muted">Price: $<?php echo number_format($item['product_price']); ?> <span class="mx-2">|</span> Qty: <?php echo $item['quantity']; ?> <span class="mx-2">|</span> Subtotal: $<?php echo number_format($item['total']); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold" id="shippingCost"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5" id="totalPrice"> $ <?php echo number_format($totalPrice) ?> </div>
                                    <input type="hidden" name="total_order" id="finalTotalPrice" value="<?php echo $totalPrice; ?>">
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><button type="submit" class="ml-auto btn hvr-hover">Place Order</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Cart -->
<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var address = document.getElementById("address").value;
        if (username === "" || phone === "" || email === "" || address === "") {
            alert("All fields are required.");
            return false;
        }
        var phonePattern = /^[0-9]{10}$/;
        if (!phone.match(phonePattern)) {
            alert("Phone must be a 10-digit numeric value.");
            return false;
        }

        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!email.match(emailPattern)) {
            alert("Please enter a valid email address.");
            return false;
        }

        return true;
    }

    $(document).ready(function() {
        $("input[name='shipping-option']").on("change", function() {
            var selectedShipping = $("input[name='shipping-option']:checked").val();

            $.ajax({
                url: "../admin/process-shipping-method.php",
                type: "POST",
                data: {
                    shippingMethod: selectedShipping
                },
                success: function(response) {
                    $("#shippingCost").text(response);
                    updateTotalPrice(); // Gọi hàm cập nhật tổng giá trị
                },
                error: function() {
                    $("#shippingCost").text("Lỗi khi truy xuất phí vận chuyển.");
                }
            });
        });
    });

    // Hàm cập nhật tổng giá trị dựa trên phí vận chuyển và tổng giá trị sản phẩm
    function updateTotalPrice() {
        var shippingCost = $("#shippingCost").text();
        var productTotal = <?php echo $totalPrice ?>;

        if (shippingCost !== "N/A") {
            var shippingCostValue = parseFloat(shippingCost.replace('$', '').trim());
            var totalPrice = productTotal + shippingCostValue;
            $("#totalPrice").text("$ " + totalPrice.toFixed(2));
        }
        $("#finalTotalPrice").val(totalPrice.toFixed(2))
    }
</script>
<?php
include "footer.php";
?>