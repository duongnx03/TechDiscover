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
        <!------------- danh-gia ------------->
        <?php
include '../admin/class/danhgia_class.php';

$danhgia = new danhgia();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_id = $_POST["product_id"];
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    $created_at = date('Y-m-d H:i:s');

    // Validate and sanitize input data here
    
    // $danhgia_id = md5($product_id . $user_id . $email . time());  // Generate a unique ID for each review

    $result = $danhgia->insert_danhgia(null, $product_id, $user_id, $name, $email, $rating, $comment, $created_at);
    if ($result) {
        // header("Location: danhgia.php");
    } else {
        // Review insertion failed
        // Handle the error appropriately
    }
}

$reviews = $danhgia->show_danhgia();
$reviewCount = mysqli_num_rows($reviews); // Đếm số lượng bình luận trong kết quả truy vấn
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate and Comment</title>
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        
        .danhgia {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }
        
        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

        /* Additional CSS for the form and review section */
        .danhgia {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .existing-reviews {
            margin-top: 20px;
        }

        .review {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }

        /* CSS for the comment textarea */
        label[for="comment"] {
            display: block;
            margin-top: 10px;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        textarea[name="comment"] {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 600px;
            margin-left: 24%;
            padding: 20px;
        }

        /* CSS for the submit button */
        .submit-container {
            text-align: center;
            margin-top: 20px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-left: 47%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        span.star {
            color: #FFCC00;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="danhgia">
            <div class="existing-reviews">
                <h2><?php echo $reviewCount; ?> Comment</h2>
                <?php
                    $reviewArray = array_reverse(mysqli_fetch_all($reviews, MYSQLI_ASSOC));
                    foreach ($reviewArray as $review) {
                ?>
                    <div class="review">
                        <p><strong>Name:</strong> <?php echo $review['name']; ?> - <?php echo date('M d,Y', strtotime($review['created_at'])); ?></p>
                        <p>
                            <?php
                            $ratingValue = intval($review['rating']);
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $ratingValue) {
                                    echo '<span class="star star-' . $i . '">&#9733;</span>';
                                } else {
                                    echo '<span class="star star-' . $i . '">&#9734;</span>';
                                }
                            }
                            ?>
                        </p>
                        <p><?php echo isset($review['comment']) ? $review['comment'] : ''; ?></p>
                    </div>
                <?php } ?>
            </div>
            <!-- Review form -->
            <h2>Leave a comment</h2>
            <form class="review-form" action="" method="POST">
                <input type="hidden" name="product_id" value="1"> <!-- Adjust the product ID accordingly -->
                <input type="hidden" name="user_id" value="1"> <!-- Adjust the user ID accordingly -->
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="rating">Rating:</
                <div class="stars">
                    <input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" type="radio" name="rating" value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
                
                <label for="comment">Comment:</label>
                <textarea name="comment" rows="4" required></textarea>
                <br>
                <button type="submit" name="submit_danhgia">Send</button>
            </form>
        </div>
    </div>
</body>
</html>

<!-- -------------End Danh-gia ----------------- -->

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