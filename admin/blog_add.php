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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_blog = $blog->insert_blog($_POST);

    if ($insert_blog) {
        echo "<script>window.location.href = 'bloglist.php';</script>";
        exit; // Thêm dòng này để ngăn tạo ra mã HTML nữa
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
                    <label for="blog_tags">Blog Tags: <span style="color:red;">*</span></label>
                    <input name="blog_tags" type="text" class="form-control" >
                </div>

                <div class="form-group">
                    <label for="blog_image">Blog Image:<span style="color:red;">*</span></label>
                    <input required name="blog_image" type="file" class="form-control" onchange="previewImage(this, 'previewBlogImg'); validateImage(this);">
                    <img id="previewBlogImg" src="" alt="Preview Image" style="max-width: 200px; max-height: 200px; display: none;"><br>
                </div>
                <div class="error-messages">
                    <!-- Dùng để hiển thị thông báo lỗi -->
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

     // Hàm để xem xét và định dạng hình ảnh khi người dùng chọn ảnh mới
     function previewImage(input, imageID) {
        var file = input.files[0];
        if (file) {
            var image = document.getElementById(imageID);
            image.style.display = 'block'; // Hiển thị ảnh

            // Sử dụng URL.createObjectURL để tạo đường dẫn tạm thời đến ảnh
            var imageURL = URL.createObjectURL(file);
            image.src = imageURL;
        }
    }

    // Hàm kiểm tra định dạng và dung lượng của ảnh
    function validateImage(input) {
        var errorMessagesContainer = document.querySelector('.error-messages');
        errorMessagesContainer.innerHTML = '';

        var file = input.files[0];
        if (file) {
            // Kiểm tra định dạng ảnh
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            var fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                var errorMessage = document.createElement('div');
                errorMessage.innerText = "Định dạng đuôi ảnh không hợp lệ. Chỉ chấp nhận định dạng jpg, jpeg, png, gif, webp.";
                errorMessagesContainer.appendChild(errorMessage);
                input.value = ''; // Xóa giá trị của trường input
                return;
            }

            // Kiểm tra dung lượng ảnh
            var maxFileSize = 5 * 1024 * 1024; // 5MB
            if (file.size > maxFileSize) {
                var errorMessage = document.createElement('div');
                errorMessage.innerText = "Dung lượng ảnh quá lớn. Chỉ chấp nhận ảnh có dung lượng tối đa là 5MB.";
                errorMessagesContainer.appendChild(errorMessage);
                input.value = ''; // Xóa giá trị của trường input
                return;
            }
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