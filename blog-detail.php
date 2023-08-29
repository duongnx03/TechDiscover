<?php
include "header.php";
include "navbar.php";
include "admin/class/blog_class.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $blog = new Blog();
    $blogDetail = $blog->get_blog($blog_id);

    if ($blogDetail) {
        $detail = $blogDetail->fetch_assoc();
        $categoryName = $blog->getCategoryNameById($detail['blog_cate_id']);
        $relatedBlogs = $blog->getRelatedBlogs($blog_id);
?>
        <section id="blog-detail" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Blog Post -->
                        <div class="card mb-4">
                            <h1 class="card-title"><?php echo $detail['blog_title']; ?></h1>
                            <div class="vote-count">
                                <p class="fa fa-thumbs-up" id="upvote-count"><?php echo isset($detail['upvotes']) ? $detail['upvotes'] : 0; ?></p>
                                <p class="fa fa-thumbs-down" id="downvote-count"><?php echo isset($detail['downvotes']) ? $detail['downvotes'] : 0; ?></p>
                            </div>
                            <img class="card-img-top-a" src="admin/uploads/<?php echo $detail['blog_image']; ?>">
                            <div class="card-body text-center blog-content">
                                <p class="card-text"><?php echo $detail['blog_content']; ?></p>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <a href="#"><?php echo $categoryName; ?></a> /
                                <?php echo $detail['blog_date']; ?> /
                                <a href="https://github.com/duongnx03"><?php echo $detail['blog_author']; ?></a> /
                                <a href="#"><?php echo $detail['blog_tags']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Comment -->
        <section id="comment-section" class="section">
            <div class="container text-center">
                <div id="comment-section" class="section">
                    <div class="container">
                        <h2 class="text-center">Comments</h2>
                        <div id="comments-list">
                            <!-- Các comment sẽ được thêm vào đây -->
                        </div>
                    </div>
                </div>
                <!-- Phần Vote -->
                <div class="vote-section">
                    <h3>Rate this blog:</h3>
                    <button class="btn btn-success vote-up"><i class="fa fa-thumbs-up"></i> Upvote</button>
                    <button class="btn btn-danger vote-down"><i class="fa fa-thumbs-down"></i> Downvote</button>
                </div><br>
                <form method="post">
                    <div class="form-group">
                        <h4 class="card-title">Leave a Comment:</h4>
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </section>

        <!-- carousel blog related-->
        <?php
        if ($relatedBlogs && $relatedBlogs->num_rows > 0) {
        ?>
            <section id="related-blogs" class="section">
                <div class="container">
                    <h2 class="text-center">Related Blogs</h2>
                    <div id="relatedBlogsCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $activeClass = "active"; // Gán lớp active cho phần tử đầu tiên
                            while ($row = $relatedBlogs->fetch_assoc()) {
                            ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <h4><a href="blog-detail.php?blog_id=<?php echo $row['blog_id']; ?>"><?php echo $row['blog_title']; ?></a></h4>
                                    <p><a href="blog-detail.php?blog_id=<?php echo $row['blog_id']; ?>"><?php echo substr($row['blog_content'], 0, 200); ?>...</a></p>
                                    <a href="blog-detail.php?blog_id=<?php echo $row['blog_id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                            <?php
                                $activeClass = ""; // Bỏ lớp active sau khi gán cho phần tử đầu tiên
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#relatedBlogsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#relatedBlogsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>
        <?php } ?>
<?php
    } else {
        echo '<p>No Blogs found.</p>';
    }
} else {
    echo '<p>No Blog ID provided.</p>';
}
?>


<br><br>


<style>
    h1 {
        padding-top: 30px;
        text-align: center;
        font-weight: 600;
        font-size: 35px;
    }

    .carousel-item {
        background-color: #ddd;
    }

    .card-img-top-a {
        max-width: 80%;
        height: auto;
        display: block;
        /* Để giữ cho ảnh căn giữa */
        margin: 0 auto;
        /* Để căn giữa theo chiều ngang */
    }

    .card-img-top-a:hover {
        /* Bất kỳ hiệu ứng hover nào cũng được loại bỏ bằng cách thiết lập các thuộc tính sau về giá trị ban đầu */
        transform: none;
        opacity: 1;
    }

    /* CSS để tạo khuôn viền cho phần comment */
    .comment-section {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f7f7f7;
        /* Màu nền cho phần comment */
        border-radius: 5px;
        /* Định dạng góc bo tròn */
    }

    .comment-container {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f7f7f7;
        /* Màu nền cho mỗi comment */
        border-radius: 5px;
        /* Định dạng góc bo tròn */
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .comment-author {
        font-weight: bold;
    }

    .comment-text {
        margin-top: 5px;
    }

    /* CSS để điều chỉnh vị trí của mũi tên "Previous" và "Next" */
    .carousel-control-prev,
    .carousel-control-next {
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
    }

    .carousel-control-prev {
        background: black;
        left: -30px;
        /* Điều chỉnh khoảng cách về bên trái */
    }

    .carousel-control-next {
        background: black;
        right: -30px;
        /* Điều chỉnh khoảng cách về bên phải */
    }

    #comment-section {
        background-color: #f7f7f7;
        /* Màu nền cho phần comment */
        padding: 30px 0;
        /* Khoảng cách giữa nội dung và mép trang */
    }

    .container.text-center {
        max-width: 800px;
        /* Đặt kích thước tối đa cho phần comment */
        margin: 0 auto;
        /* Căn giữa theo chiều ngang */
    }

    .vote-section {
        margin-top: 20px;
        text-align: center;
    }

    .rating {
        font-size: 24px;
        cursor: pointer;
    }

    .fa-star {
        color: #ddd;
    }

    .fa-star.checked {
        color: gold;
    }

    .blog-content {
        max-width: 800px;
        /* Đặt kích thước tối đa của nội dung */
        margin: 0 auto;
        /* Căn giữa theo chiều ngang */
        padding: 20px;
        /* Thêm phần đệm cho khoảng cách từ nội dung đến mép trang */
    }

    .vote-count {
        text-align: center;
        margin-top: 10px;
    }

    .fa.fa-thumbs-up,
    .fa.fa-thumbs-down {
        font-size: 24px;
        margin-right: 10px;
        cursor: pointer;
    }

    .fa.fa-thumbs-up:hover,
    .fa.fa-thumbs-down:hover {
        color: #007bff;
        /* Màu khi di chuột qua */
    }
</style>

<script>

    $(document).ready(function() {
        $("#relatedBlogsCarousel").owlCarousel({
            items: 3, // Số lượng phần tử hiển thị
            loop: true, // Lặp vô hạn
            margin: 10, // Khoảng cách giữa các phần tử
            nav: true, // Hiển thị nút Previous và Next
            responsive: {
                0: {
                    items: 1 // Số lượng phần tử hiển thị ở màn hình nhỏ
                },
                600: {
                    items: 2 // Số lượng phần tử hiển thị ở màn hình có độ rộng từ 600px trở lên
                },
                1000: {
                    items: 3 // Số lượng phần tử hiển thị ở màn hình có độ rộng từ 1000px trở lên
                }
            }
        });
    });
</script>

<?php
include "footer.php";
?>
