<?php
include "header.php";
include "navbar.php";

?>

<section id="cta" class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 align-self-center">
                <h2>TechDiscovery Blog</h2>
                <p class="lead">Welcome to the TechDiscovery Blog- where we take you on an endless journey of discovery in the world of innovative technology. Here, immerse us in stories, reviews, and the latest trends in the tech industry - all shared from the heart of the passionate and professional team at TechDiscovery Innovation never stops, and together we will discover great things there this world of technology.</p>
                <a href="#" class="btn btn-primary">Try for free</a>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Subscribe Today!</h3>
                    <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                    <form class="form-inline" method="post">
                        <input type="text" name="email" placeholder="Add your email here.." required class="form-control" />
                        <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go</button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card mt-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                    </ul>
                </div>
            </div>

            <!-- Recent Posts Widget -->
            <div class="card mt-4">
                <h5 class="card-header">Recent Posts</h5>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#">
                                <h6>Recent Post 1</h6>
                                <p class="small">Posted on January 3, 2023 by Author Name</p>
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="#">
                                <h6>Recent Post 2</h6>
                                <p class="small">Posted on January 4, 2023 by Author Name</p>
                            </a>
                        </li>
                        <!-- Thêm các mục khác tương tự cho các bài viết gần đây khác -->
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Blog Post 1 -->
            <div class="card mb-4">
                <a href="blog-detail.php"><img class="card-img-top" src="image/img-blog-1.jpg" alt="Blog Post 1"></a>
                <div class="card-body text-center">
                    <h2 class="card-title"><a href="blog-detail.php"> iOS 17 will have some special features exclusive to dual-SIM iPhones, try it now!</a></h2>
                    <p class="card-text">Not long ago, Apple released the latest versions of iOS 17 and iPadOS 17 operating systems. Besides, it also
                                released the first Public Beta for all compatible iPhone models. In the latest beta version, Apple has added
                                new features to iPhone models that support dual SIM, helping users have a better user experience.</p>
                    <a href="blog-detail.php" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="">Category</a> / <a href=""> 24 August, 2023</a> / <a href="">By DuongNX</a> 
                </div>
            </div>

            <!-- Blog Post 2 -->
            <div class="card mb-4">
            <a href="blog-detail.php"><img class="card-img-top" src="image/img-blog-2.webp" alt="Blog Post 2"></a>
                <div class="card-body text-center">
                    <h2 class="card-title"><a href="blog-detail.php"> When will iPhone 15 be released?</a></h2>
                    <p class="card-text">According to Apple's traditional strategy, new iPhones will usually be introduced in mid-September to timely arrive in key markets before December. Therefore, it is possible that this year's iPhone 15 will be released on Tuesday. September 12, 2023. The product will then hit the shelves ten days later, on Friday, September 22, 2023..</p>
                    <a href="blog-detail.php" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="">Category</a> / <a href=""> 24 August, 2023</a> / <a href="">By DuongNX</a> 
                </div>
            </div><br>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<br><br>

<?php
include "footer.php";
?>