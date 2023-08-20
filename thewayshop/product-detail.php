<?php
include "header.php";
include "navbar.php";
include "../admin/class/product_class.php";

$product = new product();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $productDetail = $product->get_product($product_id);

    if ($productDetail) {
        $detail = $productDetail->fetch_assoc();
?>
        <!-- Start All Title Box -->
        <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Product Detail</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">TechDiscovery</a></li>
                            <li class="breadcrumb-item active">Product Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->

        <!-- Start Shop Detail  -->
        <div class="shop-detail-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <!-- Bạn có thể thay đổi mã này để hiển thị hình ảnh sản phẩm -->
                                <?php
                                $images = explode(',', $detail['product_img_desc']);
                                $isFirst = true;
                                foreach ($images as $image) {
                                    echo '<div class="carousel-item ' . ($isFirst ? 'active' : '') . '">';
                                    echo '<img class="d-block w-100" src="../admin/uploads/' . $image . '" alt="Product Image">';
                                    echo '</div>';
                                    $isFirst = false;
                                }
                                ?>
                            </div>
                            <!-- Các điều khiển trượt -->
                            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <!-- Điểm điều hướng -->
                            <ol class="carousel-indicators">
                                <!-- Bạn có thể thay đổi mã này để tạo điểm điều hướng cho hình ảnh sản phẩm -->
                                <?php
                                $isFirst = true;
                                foreach ($images as $key => $image) {
                                    echo '<li data-target="#carousel-example-1" data-slide-to="' . $key . '" class="' . ($isFirst ? 'active' : '') . '">';
                                    echo '<img class="d-block w-100 img-fluid" src="../admin/uploads/' . $image . '" alt="Product Image" />';
                                    echo '</li>';
                                    $isFirst = false;
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <div class="single-product-details">
                            <!-- Hiển thị tên sản phẩm -->
                            <h2><?php echo $detail['product_name']; ?></h2>
                            <!-- Hiển thị giá sản phẩm -->
                            <h5> <del>$<?php echo $detail['product_price']; ?></del> $<?php echo $detail['product_price_sale']; ?></h5>
                            <!-- Hiển thị số lượng tồn kho và số lượng đã bán -->
                            <p class="available-stock">
                                <span> Sold: 0 / <a href="#"> Stock: <?php echo $detail['product_quantity']; ?> </a></span>
                            </p>

                            <!-- Hiển thị tùy chọn màu sắc -->
                            <div class="form-group size-st">
                                <label class="size-label">Color</label>
                                <select id="basic" class="selectpicker show-tick form-control">
                                    <!-- Bạn có thể thay đổi mã này để hiển thị tùy chọn màu sắc -->
                                    <?php
                                    // Lấy danh sách color_id từ trường product_color
                                    $product_color_ids = explode(',', $detail['product_color']);

                                    // Lặp qua danh sách color_id và chuyển thành color_name
                                    foreach ($product_color_ids as $color_id) {
                                        $color_name = $product->get_color_name_by_id($color_id);
                                        echo '<option value="' . $color_name . '">' . $color_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Hiển thị tùy chọn dung lượng -->
                            <div class="form-group size-st">
                                <label class="size-label">Memory-Capacity</label>
                                <select id="basic" class="selectpicker show-tick form-control">
                                    <!-- Bạn có thể thay đổi mã này để hiển thị tùy chọn dung lượng -->
                                    <?php
                                    // Lấy danh sách memory_ram_id từ trường product_memory_ram
                                    $product_memory_ram_ids = explode(',', $detail['product_memory_ram']);

                                    // Lặp qua danh sách memory_ram_id và chuyển thành memory_ram_name
                                    foreach ($product_memory_ram_ids as $memory_ram_id) {
                                        $memory_ram_name = $product->get_memory_ram_name_by_id($memory_ram_id);
                                        echo '<option value="' . $memory_ram_name . '">' . $memory_ram_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Hiển thị số lượng sản phẩm để mua -->
                            <div class="form-group quantity-box">
                                <label class="control-label">Quantity</label>
                                <input class="form-control" value="1" min="1" max="20" type="number">
                            </div>

                            <!-- Hiển thị nút mua hàng và thêm vào giỏ hàng -->
                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <a class="btn hvr-hover" data-fancybox-close="" href="cart.php">Buy Now</a>
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                                </div>
                            </div>

                            <!-- Hiển thị nút thêm vào danh sách yêu thích và chia sẻ -->
                            <div class="add-to-btn">
                                <div class="add-comp">
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                </div>
                                <div class="share-bar">
                                    <a class="btn hvr-hover" href="https://www.facebook.com/groups/1249874295731488"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

            <!-- Hiển thị thông tin sản phẩm và các tab tương ứng -->
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
                        <!-- Hiển thị phần giới thiệu -->
                        <div class="product-content-right-bottom-content-introduce active">
                            <h4><?php echo $detail['product_intro']; ?></h4>
                        </div>

                        <!-- Hiển thị phần chi tiết -->
                        <div class="product-content-right-bottom-content-detail">
                            <h4><?php echo $detail['product_detail']; ?></h4>
                        </div>

                        <!-- Hiển thị phần phụ kiện -->
                        <div class="product-content-right-bottom-content-accessory">
                            <h4><?php echo $detail['product_accessory']; ?></h4>
                        </div>

                        <!-- Hiển thị phần bảo hành -->
                        <div class="product-content-right-bottom-content-guarantee">
                            <h4><?php echo $detail['product_guarantee']; ?> <span><a href="" style="color: rgb(105, 159, 235);">(Xem chi tiết)</a></span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo '<p>Không tìm thấy sản phẩm.</p>';
    }
} else {
    echo '<p>Không có ID sản phẩm được cung cấp.</p>';
}
?>
<br><br><br><br>




<div class="row my-5">
    <div class="col-lg-12">
        <div class="title-all text-center">
            <h1>Similar products</h1>
        </div>
        <div class="featured-products-box owl-carousel owl-theme">
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/cate4.webp" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/cate1.webp" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/cate1-white.webp" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/cate5.webp" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/cate2.webp" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/iphone13promaxden.jpg" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/iphone14promaxtrang.png" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="../admin/uploads/iphone8plus.png" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="#">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <h5> $9.79</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<!-- End Cart -->

<?php
include "footer.php";
?>