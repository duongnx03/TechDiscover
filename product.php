<?php
session_start();
include "header.php";
include "admin/database.php";
include "admin/config.php";
include "admin/class/product_class.php";

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product = new product;
    $product_detail = $product->get_product_detail($product_id);
}
$result = '';
if (isset($_SESSION["add_to_cart_result"])) {
    $result = $_SESSION["add_to_cart_result"];
    unset($_SESSION["add_to_cart_result"]);
        echo "<script>
                alert('$result');
             </script>";
    }
?>

<section class="product">
    <div class="container">
        <form id="addToCartForm" action="admin/process-addToCart.php" method="post">
            <?php if ($product_detail) {
                $row = $product_detail->fetch_assoc();
            ?>
            <div class="product-top row">
                <p>Home</p> <span>&#10148;</span>
                <p>Điện Thoại</p><span>&#10148;</span>
                <p>iPhone</p><span>&#10148;</span>
                <p><?php echo $row['product_name']; ?></p>
            </div>
            <div class="produc-content row">
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                        <img src="admin/uploads/<?php echo $row['product_img']; ?>">
                    </div>
                    <div class="product-content-left-small-img">
                        <?php
                        // Lấy danh sách ảnh mô tả sản phẩm
                        $product_imgs_desc = $product->get_product_imgs_desc($product_id);
                        if ($product_imgs_desc) {
                            while ($img_row = $product_imgs_desc->fetch_assoc()) {
                                echo '<img src="admin/uploads/' . $img_row['product_img_desc'] . '">';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h2><?php echo $row['product_name']; ?></h2>
                    </div>
                    <div class="product-content-right-product-price">
                        <p><?php echo number_format($row['product_price']); ?><span>₫</span></p>
                    </div>
                    <div class="product-content-right-product-color">
                        <p><span style="font-weight: bold;">Màu Sắc</span>: <?php echo $row['product_color']; ?><span style="color: red;">*</span></p>
                        <div class="product-content-right-product-color-img">

                        </div>
                    </div>

                    <div class="product-content-right-product-size">
                        <p style="font-weight: bold;">Bộ Nhớ, Ram: </p>
                        <div class="size">
                            <?php
                            // Chia các bộ nhớ - ram thành mảng và hiển thị
                            $memory_ram_arr = explode(",", $row['product_memory_ram']);
                            foreach ($memory_ram_arr as $memory_ram) {
                                echo '<label><input type="radio" name="selected_ram" value="' . htmlspecialchars($memory_ram) . '"> ' . $memory_ram . '</label><br>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="quantity">
                        <p style="font-weight: bold;">Số Lượng: </p>
                        <input type="number" name="quantity" min="1" value="1">
                    </div>
                    <div class="quantity">
                        <p>Kho:</p>
                        <p><?php echo $row['product_quantity']; ?></p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <input type="hidden" name="product_img" value="<?php echo $row['product_img']; ?>">
                    <input type="hidden" name="product_color" value="<?php echo htmlspecialchars($row['product_color']); ?>">
                    <input type="hidden" name="product_memory_ram" value="<?php echo htmlspecialchars($row['product_memory_ram']); ?>">
                    <div class="product-content-right-product-button">
                        <button type="submit" name="addToCart"><i class="fa fa-shopping-bag"></i>
                            <p>Add To Cart</p>
                        </button>
                   </div>
                    </form>
                    <div class="product-content-right-product-icon row">
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-phone-alt"></i>
                            <p>Hotline</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-comments"></i>
                            <p>Chat</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-envelope"></i>
                            <p>Mail</p>
                        </div>
                    </div>

                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            <span>&#812;</span>
                        </div>
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title row">
                                <div class="product-content-right-bottom-content-title-item introduce">
                                    <p>Giới Thiệu</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item detail">
                                    <p>Chi tiết</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item accessory">
                                    <p>Phụ Kiện</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item guarantee">
                                    <p>Bảo Hành</p>
                                </div>
                            </div>

                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-introduce active">
                                    <?php echo $row['product_intro']; ?>
                                    <br><br>
                                    <h4></h4> <br>
                                </div>
                                <div class="product-content-right-bottom-content-detail">
                                    <h4></h4>
                                    <?php echo $row['product_detail']; ?>
                                </div>
                                <div class="product-content-right-bottom-content-accessory">
                                    <?php echo $row['product_accessory']; ?>
                                </div>
                                <div class="product-content-right-bottom-content-guarantee">
                                    <?php echo $row['product_guarantee']; ?> <span><a href="" style="color: rgb(105, 159, 235);">(Xem chi tiết)</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <p>Sản phẩm không tồn tại.</p>
        <?php } ?>
    </div>
</section>
<!----------------------------------------end-product-main------------------------------------------>


<!--------------------------------start-product-related------------------------>
<section class="product-related container">
    <div class="product-related-title">
        <p>SẢN PHẨM TƯƠNG TỰ</p>
    </div>
    <div class="product-content row ">
        <div class="product-related-item">
            <img src="image/cate2.webp" alt="">
            <h2>iPhone 14 128GB | Chính hãng VN/A</h2>
            <p>19.090.000<span>₫</span><span class="sale-off">22.990.000<span>₫</span></span></p>
        </div>
        <div class="product-related-item">
            <img src="image/cate3.webp">
            <h2>iPhone 14 Pro 128GB | Chính hãng VN/A</h2>
            <p>24.590.000<span>₫</span><span class="sale-off">27.990.000<span>₫</span></span></p>
        </div>
        <div class="product-related-item">
            <img src="image/cate4.webp">
            <h2>iPhone 14 Pro Max 256GB | Chính hãng VN/A</h2>
            <p>29.750.000<span>₫</span><span class="sale-off">32.990.000<span>₫</span></span></p>
        </div>
        <div class="product-related-item">
            <img src="image/cate5.webp">
            <h2>iPhone 14 Plus 128GB | Chính hãng VN/A</h2>
            <p>21.290.000<span>₫</span><span class="sale-off">24.990.000<span>₫</span></span></p>
        </div>
        <div class="product-related-item">
            <img src="image/cate6.webp">
            <h2>iPhone 14 Pro 256GB | Chính hãng VN/A</h2>
            <p>27.590.000<span>₫</span><span class="sale-off">29.990.000<span>₫</span></span></p>
        </div>
    </div>
</section>

<!--------------------------------end-product-related------------------------>

<?php
include "footer.php";
?>