<?php
include "header.php";
include "navbar.php";
include "admin/database.php";
include "admin/class/product_class.php";

$product = new product();
$products = $product->show_product();
?>
<!---------------------------------------category--------------------------------------------------->

<section class="category">
    <div class="container">
        <div class="category-top row ">
            <p>Home</p> <span>&#10148;</span>
            <p>Điện Thoại</p><span>&#10148;</span>
            <p>iPhone</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="category-left">
                <ul>
                    <li class="category-left-li"><a href="">SERIES iPhone14</a>
                        
                    </li>
                    <li class="category-left-li"><a href="">SERIES iPhone13</a>
                        
                    </li>
                    <li class="category-left-li"><a href="">SERIES iPhone12</a>
                       
                    </li>
                    <li class="category-left-li"><a href=""> SERIES iPhone11</a>
                       
                    </li>
                    <li class="category-left-li"><a href="">iPhone SE</a></li>
                </ul>
            </div>
            <div class="category-right row">
                <div class="category-right-top-item">
                    <p>iPhone</p>
                </div>
                <div class="category-right-top-item">
                    <button><span>Bộ Lọc </span><i class="fa-solid fa-sort-down"></i></button>
                </div>
                <div class="category-right-top-item">
                    <select name="" id="">
                        <option value="">Sắp Xếp</option>
                        <option value="">Cao Đến Thấp</option>
                        <option value="">Thấp Đến Cao</option>
                    </select>
                </div>


                <!---------------------------------------product--------------------------------------------------->
                <div class="category-right-content row">
                    <?php
                    if ($products) {
                        while ($row = $products->fetch_assoc()) {
                    ?>
                            <div class="category-right-content-item">
                                <a href="product.php?product_id=<?php echo $row['product_id']; ?>">
                                    <img src="admin/uploads/<?php echo $row['product_img']; ?>">
                                    <h2><?php echo $row['product_name']; ?></h2>
                                    <p><?php echo number_format($row['product_price']); ?><span>₫</span></p>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Không có sản phẩm.</p>";
                    }
                    ?>
                </div>

                <div class="category-right-bottom row">
                    <div class="category-right-bottom-items">
                        <p>Hien Thi 7 <span>|</span> 8 san pham</p>
                    </div>
                    <div class="category-right-bottom-items">
                        <p><span>&#171;</span>1 2  ... <span>&#187;</span>Trang cuoi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include "footer.php";
?>