<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/blog_class.php";
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
$blog = new Blog;

$categories = $blog->show_categories();

$errors = []; // Mảng lưu trữ thông báo lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra và xử lý dữ liệu đầu vào
    $blog_title = $_POST['blog_title'];
    $blog_author = $_POST['blog_author'];
    $blog_content = $_POST['blog_content'];

    // Kiểm tra tiêu đề
    if (empty($blog_title)) {
        $errors[] = "Blog title is required.";
    } elseif (strlen($blog_title) > 200) {
        $errors[] = "Blog title should not exceed 200 characters.";
    }else {
        // Kiểm tra xem tiêu đề đã tồn tại trong cơ sở dữ liệu chưa
        $existingBlog = $blog->get_blog_by_title($blog_title);
        if ($existingBlog) {
            $errors[] = "Blog with the same title already exists.";
        }
    }

    // Kiểm tra tác giả
    if (empty($blog_author)) {
        $errors[] = "Blog author is required.";
    } elseif (strlen($blog_author) > 50) {
        $errors[] = "Blog author should not exceed 50 characters.";
    }

    // Kiểm tra nội dung
    if (empty($blog_content)) {
        $errors[] = "Blog content is required.";
    } elseif (strlen($blog_content) < 100) {
        $errors[] = "Blog content should be at least 100 characters long.";
    }

    // Kiểm tra và xử lý ảnh
    $imageInput = $_FILES['blog_image'];
    if (!empty($imageInput['name'])) {
        $fileExtension = strtolower(pathinfo($imageInput['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Invalid image format. Only JPG, JPEG, PNG, GIF, and WebP formats are allowed.";
        }

        if ($imageInput['size'] > $maxFileSize) {
            $errors[] = "Image file size is too large. Maximum file size allowed is 5MB.";
        }
    } else {
        $errors[] = "Blog image is required.";
    }

    // Nếu không có lỗi, thực hiện thêm blog
    if (empty($errors)) {
        $insert_blog = $blog->insert_blog($_POST);

        if ($insert_blog) {
            echo "<script>window.location.href = 'bloglist.php';</script>";
            exit; // Thêm dòng này để ngăn tạo ra mã HTML nữa
        }
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Add Blog</h6>
            <a href="bloglist.php">Back to Blog List</a>
        </div>
        <div class="admin-content-right-product-add row">
            <form action="" method="POST" enctype="multipart/form-data">

                <?php
                // Hiển thị thông báo lỗi (nếu có)
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger">';
                    foreach ($errors as $error) {
                        echo '<p>' . $error . '</p>';
                    }
                    echo '</div>';
                }
                ?>

                <div class="form-group">
                    <label for="blog_cate_id">Select Blog Category <span style="color:red;">*</span></label>
                    <select name="blog_cate_id" id="blog_cate_id" class="form-control" required>
                        <option value="">--Select--</option>
                        <?php
                        if ($categories) {
                            while ($category = $categories->fetch_assoc()) {
                                echo '<option value="' . $category['blog_cate_id'] . '">' . $category['blog_cate_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="blog_title">Blog Title: <span style="color:red;">*</span></label>
                    <input name="blog_title" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="blog_author">Blog Author: <span style="color:red;">*</span></label>
                    <input name="blog_author" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="blog_content">Blog Content: <span style="color:red;">*</span></label>
                    <textarea name="blog_content" id="summernote_content" cols="30" rows="10" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="blog_image">Blog Image:<span style="color:red;">*</span></label>
                    <input required name="blog_image" type="file" class="form-control" onchange="previewImage(this, 'previewBlogImg'); validateImage(this);">
                    <img id="previewBlogImg" src="" alt="Preview Image" style="max-width: 200px; max-height: 200px; display: none;"><br>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Summernote and JavaScript code for it here -->
<script>
    // Function to preview the selected image
    function previewImage(input, imgId) {
        var preview = document.getElementById(imgId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block'; // Show the image when an image is selected
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    $('#summernote_content').summernote({
        placeholder: 'Enter Blog Content',
        tabsize: 2,
        height: 200
    });
</script>

<?php
include "footer.php";
?>
