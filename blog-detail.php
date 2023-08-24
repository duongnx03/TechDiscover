<?php
include "header.php";
include "navbar.php";

// Trước hết, bạn nên truy vấn dữ liệu của bài blog từ cơ sở dữ liệu tại đây.
// Sau đó, sử dụng dữ liệu đó để điền vào mẫu dưới đây.

// Ví dụ:
$blogTitle = "iOS 17 will have some special features exclusive to dual-SIM iPhones, try it now!"; // Thay đổi thành tiêu đề thực tế của bài blog
$blogImageSrc = "image/img-blog-1.jpg"; // Đường dẫn hình ảnh của bài blog
$blogContent = ""; // Thay đổi thành nội dung thực tế của bài blog
$blogCategory = "Category"; // Thay đổi thành danh mục thực tế của bài blog
$blogDate = "20 JULY, 2017"; // Thay đổi thành ngày thực tế của bài blog
$blogAuthor = "DuongNX"; // Thay đổi thành tên tác giả thực tế của bài blog

?>

<section id="blog-detail" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Blog Post -->
                <div class="card mb-4">
                    <h1 class="card-title"><?php echo $blogTitle; ?></h1>
                    <img class="card-img-top-a" src="<?php echo $blogImageSrc; ?>" alt="<?php echo $blogTitle; ?>">
                    <div class="card-body text-center">
                        <p class="card-text"><?php echo $blogContent; ?></p>
                        <p>Not long ago, Apple released the latest versions of iOS 17 and iPadOS 17 operating systems. Besides, it also
                            released the first Public Beta for all compatible iPhone models. In the latest beta version, Apple has added
                            new features to iPhone models that support dual SIM, helping users have a better user experience.</p>
                        <p>As TechCrunch reports, in iOS 17, dual-SIM iPhone users will be able to categorize messages by SIM.
                            This means that messages from SIM 1 and SIM 2 will be stored and managed separately in the Messages app, making it
                            easier for users to manage and search for messages.</p>
                        <p class="blockquote">In addition, iOS 17 also provides separate ringtones for each SIM, making it easy for users to identify
                            which SIM the call is coming from. This is very useful for users who use dual SIM for work and personal purposes.
                            Currently, when the iPhone rings, users can't tell which SIM the call is coming from, but with a new
                            feature in iOS 17, it's easier than ever.</p>
                        <p>Finally, iOS 17 will provide a feature that allows users of dual-SIM iPhone models to select a SIM before calling an
                            unknown number. Currently, this feature is not available because users must call via a pre-assigned SIM to make calls.</p>
                        <p>These are all features that will be made available in iOS 17 for dual-SIM iPhone models. These features are not limited
                            to the latest models, which all dual-SIM enabled iPhones will be able to use.
                            In addition, iOS 17 also offers the ability to store screenshots of entire web pages in the Photos app.
                            Currently, you can screenshot entire web pages on iPhone, but these images are saved as PDF files instead of images.
                            From now on, the "Save to Photos" feature will make it easier to share screenshots of entire web pages.</p>

                    </div>
                    <div class="card-footer text-muted text-center">
                        <a href="#"><?php echo $blogCategory; ?></a> / <a href="#"><?php echo $blogDate; ?></a> / <a href="#"><?php echo $blogAuthor; ?></a>
                    </div>
                </div>

                <!-- Phần Comment -->
                <div class="card mb-4">
                    <div class="card-body comment-section">
                        <h4 class="card-title">Comments:</h4>
                        <!-- Hiển thị danh sách các comment ở đây, bạn có thể sử dụng vòng lặp PHP -->
                        <?php
                        // Mã PHP để lấy và hiển thị danh sách các comment từ cơ sở dữ liệu
                        // Ví dụ:
                        $comments = [
                            ["id" => 1, "author" => "John Doe", "comment" => "Great post!"],
                            ["id" => 2, "author" => "Jane Smith", "comment" => "I enjoyed reading this."],
                            // Thêm các comment khác tương tự ở đây
                        ];

                        foreach ($comments as $comment) {
                            echo '<div class="comment-container">';
                            echo '<div class="comment">';
                            echo '<div class="comment-header">';
                            echo '<span class="comment-author">' . $comment["author"] . '</span>';
                            echo '</div>';
                            echo '<p class="comment-text">' . $comment["comment"] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>


                <!-- Form Comment -->
                <section id="comment-section" class="section">
                    <div class="container text-center">
                        <!-- Phần Vote -->
                        <div class="vote-section">
                            <h3>Rate this blog:</h3>
                            <button class="btn btn-success vote-up"><i class="fa fa-thumbs-up"></i> Upvote</button>
                            <button class="btn btn-danger vote-down"><i class="fa fa-thumbs-down"></i> Downvote</button>
                        </div>
                        <h4 class="card-title">Leave a Comment:</h4>
                        <form method="post">
                            <div class="form-group">
                                <label for="author">Your Name</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>


                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<section id="related-blogs" class="section">
    <div class="container">
        <h3>You may also like</h3>
        <div id="related-blog-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $relatedBlogs = [
                    ["title" => "Related Post 1", "image" => "image/slide1.png", "link" => "#"],
                    ["title" => "Related Post 2", "image" => "image/slide2.jpeg", "link" => "#"],
                    ["title" => "Related Post 3", "image" => "image/slide4.jpeg", "link" => "#"],
                    ["title" => "Related Post 4", "image" => "image/slide6.jpeg", "link" => "#"],
                    ["title" => "Related Post 5", "image" => "image/slide4.jpeg", "link" => "#"],
                    ["title" => "Related Post 6", "image" => "image/slide8.jpeg", "link" => "#"],
                    // Thêm các bài viết liên quan khác tương tự ở đây
                ];

                // Chia thành từng dòng (4 bài viết trên mỗi dòng)
                $chunks = array_chunk($relatedBlogs, 4);

                foreach ($chunks as $key => $chunk) {
                    echo '<div class="carousel-item' . ($key === 0 ? ' active' : '') . '">';
                    echo '<div class="row">';
                    foreach ($chunk as $relatedBlog) {
                        echo '<div class="col-md-3">';
                        echo '<div class="card">';
                        echo '<a href="' . $relatedBlog["link"] . '"><img class="card-img-top" src="' . $relatedBlog["image"] . '" alt="' . $relatedBlog["title"] . '"></a>';
                        echo '<div class="card-body text-center">';
                        echo '<h4 class="card-title"><a href="' . $relatedBlog["link"] . '">' . $relatedBlog["title"] . '</a></h4>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#related-blog-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#related-blog-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<br><br>


<style>
    h1{
        padding-top: 30px;
        text-align: center;
        font-weight: 600;
        font-size: 35px;
    }
    .card-img-top-a{
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
        left: -25px;
        /* Điều chỉnh khoảng cách về bên trái */
    }

    .carousel-control-next {
        background: black;
        right: -25px;
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
</style>

<?php
include "footer.php";
?>