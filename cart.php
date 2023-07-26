<?php
include "header.php";

// Khởi tạo biến lưu trữ thông tin giỏ hàng
$cart_items = array();

// Kiểm tra nếu có thông tin sản phẩm được truyền từ trang product.php
if (isset($_GET['product_id']) && isset($_GET['product_name']) && isset($_GET['product_price']) && isset($_GET['quantity'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $product_price = $_GET['product_price'];
    $quantity = $_GET['quantity'];

    // Lưu thông tin sản phẩm vào giỏ hàng
    $cart_item = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity
    );
    array_push($cart_items, $cart_item);
}

// Xử lý xoá sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['delete_product_id'])) {
    $delete_product_id = $_GET['delete_product_id'];
    foreach ($cart_items as $key => $item) {
        if ($item['product_id'] === $delete_product_id) {
            unset($cart_items[$key]);
        }
    }
    // Cập nhật lại giỏ hàng sau khi xoá
    $cart_items = array_values($cart_items);
}

?>

<script>
    function updateCartItemQuantity(product_id) {
        const quantityInput = document.getElementById(`quantity-${product_id}`);
        const productPrice = parseFloat(quantityInput.dataset.productPrice);
        const oldQuantity = parseFloat(quantityInput.dataset.oldQuantity);
        const newQuantity = parseFloat(quantityInput.value);

        const totalQuantityElement = document.getElementById('total-quantity');
        const totalPriceElement = document.getElementById('total-price');

        const totalQuantity = parseFloat(totalQuantityElement.innerText);
        const totalPrice = parseFloat(totalPriceElement.innerText);

        const quantityDiff = newQuantity - oldQuantity;
        const newTotalQuantity = totalQuantity + quantityDiff;
        const newTotalPrice = totalPrice + quantityDiff * productPrice;

        totalQuantityElement.innerText = newTotalQuantity;
        totalPriceElement.innerText = newTotalPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

        // Cập nhật giá trị cũ của input
        quantityInput.dataset.oldQuantity = newQuantity;
    }
</script>

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
                <?php if (count($cart_items) > 0) { ?>
                    <table>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Ram</th>
                            <th>Màu Sắc</th>
                            <th>SL</th>
                            <th>Thành Tiền</th>
                            <th>Xoá</th>
                        </tr>
                        <?php foreach ($cart_items as $item) { ?>
                            <tr>
                                <td><img src="admin/uploads/<?php echo $item['product_id']; ?>.png">
                                    <p><?php echo $item['product_name']; ?></p>
                                </td>
                                <td>
                                    <p>128GB</p>
                                </td>
                                <td>Gold</td>
                                <td><input type="number" value="<?php echo $item['quantity']; ?>" min="1"></td>
                                <td>
                                    <p><?php echo number_format($item['product_price'] * $item['quantity']); ?><span>₫</span></p>
                                </td>
                                <td><a href="cart.php?action=delete&delete_product_id=<?php echo $item['product_id']; ?>" onclick="return confirm('Bạn có muốn xoá sản phẩm khỏi giỏ hàng?')"><span class="delete-product-cart">X</span></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <p>Không có sản phẩm trong giỏ hàng.</p>
                <?php } ?>
            </div>
            <div class="cart-content-right">
                <?php
                $total_quantity = 0;
                $total_price = 0;

                foreach ($cart_items as $item) {
                    $total_quantity += $item['quantity'];
                    $total_price += $item['product_price'] * $item['quantity'];
                }
                ?>
                <table>
                    <tr>
                        <th colspan="2">Tổng tiền tạm tính:</th>
                    </tr>
                    <tr>
                        <td>Tổng Sản Phẩm</td>
                        <td><?php echo $total_quantity; ?></td>
                    </tr>
                    <tr>
                        <td>Tổng Tiền Hàng</td>
                        <td><?php echo number_format($total_price); ?><span>₫</span></td>
                    </tr>
                    <tr>
                        <td>Thành Tiền</td>
                        <td>
                            <p><?php echo number_format($total_price); ?><span>₫</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Tạm Tính</td>
                        <td>
                            <p style="color: black; font-weight:bold;"><?php echo number_format($total_price); ?><span>₫</span></p>
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
