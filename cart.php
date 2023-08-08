<?php
session_start();
include "header.php";
include "admin/database.php";

$totalProducts = $totalPrice = $intoMoney = 0;
$shippingFee = 10;
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
$database = new Database();
$query = "SELECT * FROM tbl_cart where user_id = $user_id";
$result = $database->select($query);
?>


<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart cart-top-item">
                    <i class="fas fa-shopping-cart"></i>
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
            <?php
                    if($result){
                ?>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                $totalProducts += $row['quantity'];
                                $totalPrice += $row['total'];
                                $intoMoney = $totalPrice + $shippingFee;
                        ?>
                        <tr>
                        <form action="admin/process-cart-edit.php?id=<?php echo $row["cart_id"]?>" method="post">
                                <td><img src="admin/uploads/<?php echo $row['product_img']; ?>" width="100px"></td>
                                <td><?php echo $row['product_name']?></td>
                                <td><?php echo $row['product_color'].' | '.$row['product_memory_ram']?></td>
                                <td><span>$</span><?php echo number_format($row['product_price']); ?></td>
                                <td><input type="number" name="quantity[<?php echo $row['cart_id']; ?>]" value="<?php echo $row['quantity']; ?>" min="1"></td>
                                <td><span>$</span><?php echo number_format($row['total']); ?></td>
                                <td>
                                    <button type="submit">Edit</button> |
                            </form>
                                <button onclick="confirmDelete(<?php echo $row['cart_id']?>)">Delete</button>
                                </td>
                        </tr>
                        <?php
                            }  
                        ?>
                    </table>
                <?php
                    }else{
                        echo 'There is no product in the store';
                    }
                ?>    
            </div>
            <div class="cart-content-right">
                <table class="table_price">
                    <tr>
                        <th colspan="2">TOTAL MONEY (Temporary):</th>
                    </tr>
                    <tr>
                        <td>Total Products</td>
                        <td id="total-quantity"><?php echo $totalProducts?></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td id="total-price"><span>$</span><?php echo number_format($totalPrice)?></td>
                    </tr>
                    <tr>
                        <td>Shopping Fee</td>
                        <td id="total-price"><span>$</span><?php echo number_format($shippingFee)?></td>
                    </tr>
                    <tr>
                        <td>Into money</td>
                        <td><span>$</span><?php echo number_format($intoMoney)?></td>
                    </tr>
                </table>
                <div class="cart-content-right-button">
                    <a href="checkout.php"><button>PROCEED PAYMENT</button></a>
                    <a href="category.php"><button>CHOOSE MORE OTHER PRODUCTS</button></a>
                </div>
                <div class="cart-content-right-login">
                    <p>TechDiscovery!</p>
                    <p>Please <a href="login.php">Login</a> To Continue Shopping And Earn Rewards Points!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function confirmDelete(cartId) {
        var confirmation = confirm("Are you sure you want to delete this product from the cart?");
        if (confirmation) {
            window.location.href = "admin/process-cart-delete.php?id=" + cartId;
        } else {

        }
    }
</script>
<?php
include "footer.php";
?>
