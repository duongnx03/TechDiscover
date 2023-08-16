<?php
include "header.php";
include "navbar.php";
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
                            <div class="list-group-collapse sub-men">
                                <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men1">Phone 
                                    <small class="text-muted">(50)</small>
                                </a>
                                <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action active">Smartphones <small class="text-muted">(46)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Cellphones <small class="text-muted">(8)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Gaming Phones <small class="text-muted">(13)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">iPad <small class="text-muted">(10)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Battery Phones <small class="text-muted">(20)</small></a>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-collapse sub-men">
                                <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Laptop
                                    <small class="text-muted">(30)</small>
                                </a>
                                <div class="collapse" id="sub-men2" data-parent="#list-group-men">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">Ultrabooks <small class="text-muted">(10)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Business Laptops <small class="text-muted">(8)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Gaming Laptops <small class="text-muted">(6)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">High-Performance Laptops <small class="text-muted">(6)</small></a>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-collapse sub-men">
                                <a class="list-group-item list-group-item-action" href="#sub-men3" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men3">Accessories
                                    <small class="text-muted">(30)</small>
                                </a>
                                <div class="collapse" id="sub-men3" data-parent="#list-group-men">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">Earphone <small class="text-muted">(10)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Charging cable and charger <small class="text-muted">(8)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Battery backup <small class="text-muted">(6)</small></a>
                                        <a href="#" class="list-group-item list-group-item-action">Mouse and keyboard <small class="text-muted">(6)</small></a>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="filter-brand-left">
                        <div class="title-left">
                            <h3>Brand</h3>
                        </div>
                        <div class="brand-box">
                            <ul>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios1" value="Yes" type="radio">
                                        <label for="Radios1"> ịPhone </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios2" value="No" type="radio">
                                        <label for="Radios2"> SAMSUNG </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios3" value="declater" type="radio">
                                        <label for="Radios3"> OPPO </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios4" value="declater" type="radio">
                                        <label for="Radios4"> Xiaomi </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios5" value="declater" type="radio">
                                        <label for="Radios5"> Realme </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios6" value="declater" type="radio">
                                        <label for="Radios6"> VIVO </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios7" value="declater" type="radio">
                                        <label for="Radios7"> Nokia </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios8" value="declater" type="radio">
                                        <label for="Radios8"> MackBook </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios9" value="declater" type="radio">
                                        <label for="Radios9"> ASUS </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio radio-danger">
                                        <input name="survey" id="Radios10" value="declater" type="radio">
                                        <label for="Radios10"> DELL </label>
                                    </div>
                                </li>
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
                            <p>Showing all <span>0</span>  results</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/cate1.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                                <h4>iPhone 14 PROMAX 128GB VN/A</h4>
                                                <h5> <del> $1599.79</del> <a href="">$1499.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="new">New</p>
                                                </div>
                                                <img src="../image/cate1.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPhone 14 PROMAX 256GB VN/A</h4>
                                                <h5> <del> $1699.79</del> <a href="">$1599.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/cate2.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPhone 12  128GB VN/A</h4>
                                                <h5> <del> $1099.79</del> <a href="">$999.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/cate4.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPhone 13 PROMAX 128GB VN/A</h4>
                                                <h5> <del> $1599.79</del> <a href="">$1499.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/cate5.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPhone 12 256 VN/A</h4>
                                                <h5> <del> $1199.79</del> <a href="">$1109.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/cate6.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPhone 14 PROMAX 512GB VN/A</h4>
                                                <h5> <del> $1799.79</del> <a href="">$1709.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="sale">Sale</p>
                                                </div>
                                                <img src="../image/macbook_air_m2_1_1.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>Macbook Air M2</h4>
                                                <h5> <del> $1599.79</del> <a href="">$1499.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="new">New</p>
                                                </div>
                                                <img src="../image/ipad2.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>iPad VN/A</h4>
                                                <h5> <del> $1599.79</del> <a href="">$1499.79</a></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <div class="type-lb">
                                                    <p class="new">New</p>
                                                </div>
                                                <img src="../image/vertu1.webp" class="img-fluid" alt="Image">
                                                <div class="mask-icon">
                                                    <ul>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                    </ul>
                                                    <a class="cart" href="cart.php">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="why-text">
                                            <h4>Vertu</h4>
                                                <h5> <del> $8599.79</del> <a href="">$8099.79</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="list-view">
                                <div class="list-view-box">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="new">New</p>
                                                    </div>
                                                    <img src="images/img-pro-01.jpg" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                            <div class="why-text full-width">
                                                <h4>Lorem ipsum dolor sit amet</h4>
                                                <h5> <del>$ 60.00</del> $40.79</h5>
                                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                <a class="btn hvr-hover" href="cart.php">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-view-box">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>
                                                    <img src="images/img-pro-02.jpg" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                            <div class="why-text full-width">
                                                <h4>Lorem ipsum dolor sit amet</h4>
                                                <h5> <del>$ 60.00</del> $40.79</h5>
                                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                <a class="btn hvr-hover" href="cart.php">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-view-box">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>
                                                    <img src="images/img-pro-03.jpg" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                            <div class="why-text full-width">
                                                <h4>Lorem ipsum dolor sit amet</h4>
                                                <h5> <del>$ 60.00</del> $40.79</h5>
                                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                <a class="btn hvr-hover" href="cart.php">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->

<?php
include "footer.php";
?>