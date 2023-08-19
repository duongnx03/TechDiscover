<?php
include "header.php";
include "navbar.php";
include "../admin/class/product_class.php";
include "../admin/class/cartegory_class.php";
include "../admin/class/brand_class.php";


$product = new product();
$category = new cartegory();
$brand = new brand();

$products = $product->show_product();
$mainCategories = $category->show_cartegory_main();
$cartegory = $product->show_cartegory();
$brands = $product->show_brand();
?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="search-product">
                        <form action="#">
                            <input class="form-control" placeholder="Search here..." type="text">
                            <button type="submit"> <i class="fa fa-search"></i> </button>
                        </form>
                    </div>
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Categories</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            <?php
                            if ($mainCategories) {
                                while ($mainCategory = $mainCategories->fetch_assoc()) {
                                    echo '<div class="list-group-collapse sub-men">';
                                    echo '<a class="list-group-item list-group-item-action" href="#sub-men' . $mainCategory['cartegory_main_id'] . '" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men' . $mainCategory['cartegory_main_id'] . '">' . $mainCategory['cartegory_main_name'] . '</a>';
                                    echo '<div class="collapse" id="sub-men' . $mainCategory['cartegory_main_id'] . '" data-parent="#list-group-men">';
                                    echo '<div class="list-group">';

                                    $subCategories = $category->get_cartegories_by_cartegory_main_id($mainCategory['cartegory_main_id']);
                                    if ($subCategories) {
                                        while ($subCategory = $subCategories->fetch_assoc()) {
                                            echo '<a href="#" class="list-group-item list-group-item-action">' . $subCategory['cartegory_name'] . '</a>';
                                        }
                                    }

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="filter-brand-left">
                        <div class="title-left">
                            <h3>Brand</h3>
                        </div>
                        <div class="brand-box">
                            <ul>
                                <?php
                                if ($brands) {
                                    while ($brand = $brands->fetch_assoc()) {
                                        echo '<li>';
                                        echo '<div class="radio radio-danger">';
                                        echo '<input name="survey" id="Radios' . $brand['brand_id'] . '" value="' . $brand['brand_name'] . '" type="radio">';
                                        echo '<label for="Radios' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</label>';
                                        echo '</div>';
                                        echo '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <span>Sort by </span>
                                <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                    <option data-display="Select">Nothing</option>
                                    <option value="1">Popularity</option>
                                    <option value="2">Low Price → High Price</option>
                                    <option value="3">Hight Price → Low Price</option>
                                    <option value="4">Best Selling</option>
                                </select>
                            </div>
                            <p>Showing all <span>0</span> results</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="row product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">
                                    <?php
                                    if ($products) {
                                        while ($product = $products->fetch_assoc()) {
                                            echo '<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">';
                                            echo '<div class="products-single fix">';
                                            echo '<div class="box-img-hover">';

                                            // Check if the product is on sale or new
                                            if ($product['is_sale']) {
                                                echo '<div class="type-lb"><p class="sale">Sale</p></div>';
                                            } else {
                                                echo '<div class="type-lb"><p class="new">New</p></div>';
                                            }

                                            echo '<img src="../admin/uploads/' . $product['product_img'] . '" class="img-fluid" alt="Image">';
                                            echo '<div class="mask-icon">';
                                            echo '<ul>';
                                            echo '<li><a href="product-detail.php?id=' . $product['product_id'] . '" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>';
                                            echo '<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>';
                                            echo '</ul>';
                                            echo '<a class="cart" href="cart.php">Add to Cart</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="why-text">';
                                            echo '<h4><a href="product-detail.php?id=' . $product['product_id'] . '">' . $product['product_name'] . '</a></h4>';
                                            echo '<h5> <del> $' . $product['product_price'] . '</del> <a href="product-detail.php?id=' . $product['product_id'] . '"> $' . $product['product_price_sale'] . '</a></h5>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>No products available in this category.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Start Pagination -->
                    <div class="pagination-area">
                        <ul class="pagination">
                            <p>Display 6 <span>|</span> 6 Product</p>
                            <p class="alight-right"><span>&#171;</span>1 2 ... <span>&#187;</span>Last page</p>
                        </ul>
                    </div>
                    <!-- End Pagination -->
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <?php
    include "footer.php";
    ?>