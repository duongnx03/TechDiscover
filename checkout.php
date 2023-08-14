<?php
session_start();
include "header.php";
include "navbar.php";
include "admin/database.php";

$totalProducts = $totalPrice = $intoMoney = 0;
$shippingFee = 10;
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = 0;
}
$database = new Database();
$query = "SELECT * FROM tbl_cart where user_id = $user_id";
$result = $database->select($query);
$cartItems = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = array(
            'product_name' => $row['product_name'],
            'product_color' => $row['product_color'],
            'product_memory_ram' => $row['product_memory_ram'],
            'product_price' => $row['product_price'],
            'quantity' => $row['quantity'],
            'total' => $row['total'],
            'product_img' => $row['product_img']
        );
        $totalProducts += $row['quantity'];
        $totalPrice += $row['total'];
    }
    $intoMoney = $totalPrice + $shippingFee;
}
?>
<!--------------------------------------------check-out------------------------------------------------------>
<section class="delivery">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="payment-top-cart payment-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <form action="">
                    <div class="discount-content">
                        <h4>If you have a discount code, please fill it in here</h4>
                        <div class="discount-content-button">
                            <input type="text" name="discount_code" id="discountCode" placeholder="Discount/Gift Code">
                            <button type="button" id="applyDiscount"><i class="fas fa-check"></i></button>
                        </div>
                        <br>
                        <span id="discountMessage" class="discount-message"></span>
                    </div>
                </form>
                <form id="order-form" action="admin/process-order.php" method="post">
                    <p>Please select a shipping address</p>
                    <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <input type="text" name="name" id="name" required placeholder="Full name">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input type="text" name="phone" id="phone" required placeholder="Phone">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input type="text" name="city" id="city" required placeholder="Province/City">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input type="text" name="district" id="district" required placeholder="District">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <input type="text" name="ward" id="ward" placeholder="Ward">
                        </div>
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <input type="text" name="address" id="address" placeholder="Address (Details)">
                    </div>
                    <div class="delivery-content-left-button row">
                        <a href="cart.php?user_id=<?php echo $user_id; ?>">
                            <p>&#171;</p>Back to Cart
                        </a>
                    </div>
            </div>
            <div class="delivery-content-right">
                <table class="table_price">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    foreach ($cartItems as $item) {
                    ?>
                        <tr>
                            <td><?php echo $item['product_name'] ?></td>
                            <td align="center"><?php echo $item['product_color'] . ' | ' . $item['product_memory_ram']; ?>
                            </td>
                            <td align="center"><span>$</span><?php echo number_format($item['product_price']); ?></td>
                            <td align="center"><?php echo $item['quantity']; ?></td>
                            <td><span>$</span><?php echo number_format($item['total']); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td style="font-weight: bold;" colspan="4">Total</td>
                        <td style="font-weight: bold;">
                            <p><span>$</span><?php echo number_format($totalPrice); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="4">Shipping Fee</td>
                        <td style="font-weight: bold;">
                            <p><span>$</span><?php echo number_format($shippingFee); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="4">Into Money</td>
                        <td style="font-weight: bold;">
                            <p id="intoMoney"><span>$</span><?php echo number_format($intoMoney); ?></p>
                        </td>
                    </tr>
                </table>
                <div class="btn">
                    <button type="submit" class="button-cell" onclick="validateForm(), setPaymentMethod()">Confirm and place order | COD</button>
                </div>
                <div id="paypal-button-container"></div>
                <input type="hidden" name="code" id="code" value="">
                <input type="hidden" name="total_price" id="totalPrice" value="">
                <input type="hidden" name="payment_method" id="payment_method" value="">
                <input type="hidden" id="paypal_amount" name="paypal_amount" value="">
            </div>
            </form>
        </div>
    </div>
</section>
<script src="https://www.paypal.com/sdk/js?client-id=AUbOEvIMIXKSLOwnIgiCu0q7iRKK2hJtW55odcvAgtYO7heyQAa2ZDIv7ziZkzD-sGM3L2rKH5SIaxad&currency=USD"></script>
<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var phone = document.getElementById('phone').value;
        var city = document.getElementById('city').value;
        var district = document.getElementById('district').value;
        var ward = document.getElementById('ward').value;
        var address = document.getElementById('address').value;

        if (name.length === 0 || phone.length === 0 || city.length === 0 || district.length === 0 || ward.length === 0 || address.length === 0) {
            alert('Please fill out all required fields.');
            return false;
        }
    }

    var discountApplied = false;
    document.getElementById('applyDiscount').addEventListener('click', function() {
        if (!discountApplied) {
            var discountCode = document.getElementById('discountCode').value;
            var intoMoneyValue = parseFloat(document.getElementById('intoMoney').innerText.replace('$', ''));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin/check-discount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var newIntoMoney = intoMoneyValue;

                        var discountMessage = document.getElementById('discountMessage'); // Moved outside if-else block

                        if (response.valid && response.discountedValue) {
                            newIntoMoney = response.discountedValue;
                            discountApplied = true;

                            // Disable the discount input and button
                            document.getElementById('discountCode').disabled = true;
                            document.getElementById('applyDiscount').disabled = true;

                            // Display success message
                            discountMessage.innerText = 'Discount applied successfully.';
                            discountMessage.classList.remove('error-message'); // Remove error class
                            discountMessage.classList.add('discount-message'); // Add success class
                        } else {
                            // Display error message
                            discountMessage.innerText = 'Invalid discount code or Discount code already used by this user.';
                            discountMessage.classList.remove('discount-message'); // Remove success class
                            discountMessage.classList.add('error-message'); // Add error class
                        }

                        // Update the displayed total and PayPal amount
                        var intoCodeElement = document.getElementById('discountCode').value;
                        var codeInput = document.getElementById('code');
                        codeInput.value = intoCodeElement;
                        var intoMoneyElement = document.getElementById('intoMoney');
                        intoMoneyElement.innerText = '$' + newIntoMoney;
                        var paypalAmountInput = document.getElementById('paypal_amount');
                        paypalAmountInput.value = newIntoMoney.toFixed(2);
                        var totalPriceElement = document.getElementById('intoMoney');
                        totalPriceElement.innerText = '$' + newIntoMoney;
                        var totalPriceInput = document.getElementById('totalPrice');
                        totalPriceInput.value = newIntoMoney.toFixed(2);
                    } else {
                        console.error('Error:', xhr.status);
                    }
                }
            };
            xhr.send('code=' + encodeURIComponent(discountCode) + '&intoMoney=' + intoMoneyValue);
        }
    });

    document.getElementById('payment_method').value = 'PayPal';

    function setPaymentMethod() {
        document.getElementById('payment_method').value = 'COD';
    }

    paypal.Buttons({
        onClick: function(details) {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var city = document.getElementById('city').value;
            var district = document.getElementById('district').value;
            var ward = document.getElementById('ward').value;
            var address = document.getElementById('address').value;

            if (name.length === 0 || phone.length === 0 || city.length === 0 || district.length === 0 || ward.length === 0 || address.length === 0) {
                alert('Please fill out all required fields.');
                return false;
            }

            var paypalAmountInput = document.getElementById('paypal_amount');
            paypalAmountInput.value = parseFloat(document.getElementById('intoMoney').innerText.replace('$', '')).toFixed(2);
        },
        createOrder: function(data, actions) {
            var paypalAmount = parseFloat(document.getElementById('paypal_amount').value);
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: paypalAmount.toFixed(2)
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                submitForm();
            });
        }
    }).render('#paypal-button-container');

    function submitForm() {
        document.getElementById('order-form').submit();
    }
</script>
<?php
include "footer.php";
?>