<?php
session_start();
include "header.php";
include "admin/config.php";
include "admin/database.php";

$totalProducts = $totalPrice = $intoMoney = 0;
$shippingFee = 10;
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}else{
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
        <form action="admin/process-order.php" method="post">
            <div class="delivery-content-left">
                <p>Please select a shipping address</p>
                <div class="delivery-content-left-input-top row">
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Full name: <span style="color: red;">*</span></label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Phone number: <span style="color: red;">*</span></label>
                        <input type="text" name="phone" required> 
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Province/City: <span style="color: red;">*</span></label>
                        <input type="text" name="city" v>
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">District: <span style="color: red;">*</span></label>
                        <input type="text" name="district" required>
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Wards: <span style="color: red;">*</span></label>
                        <input type="text" name="ward" required>
                    </div>
                </div>
                <div class="delivery-content-left-input-top-item">
                    <label for="">Address (Details): <span style="color: red;">*</span></label>
                    <input type="text" name="address" required>
                </div>
                <div class="delivery-content-left-button row">
                    <a href="cart.php?user_id=<?php echo $user_id; ?>">
                        <p>&#171;</p>Back to Cart
                    </a>
                    <button type="submit">
                        <p style="font-weight: bold;">Payment And Delivery</p>
                    </button>
                </div>
            </div>
            </form>
            <div class="delivery-content-right">
                <table>
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
                        <td><?php echo $item['product_name']?></td>
                        <td align="center"><?php echo $item['product_color'].' | '.$item['product_memory_ram'];?></td>
                        <td align="center"><span>$</span><?php echo number_format($item['product_price']); ?></td>
                        <td align="center"><?php echo $item['quantity'];?></td>
                        <td><span>$</span><?php echo number_format($item['total']);?></td>
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
                            <p><span>$</span><?php echo number_format($intoMoney); ?></p>
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