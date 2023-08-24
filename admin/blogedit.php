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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $blog_detail = $blog->get_blog_detail($blog_id);
} else {
    // Redirect to bloglist.php if blog_id is not provided
    header('Location: bloglist.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = $_POST['blog_id'];

    // Xử lý tệp ảnh nếu người dùng chọn ảnh mới
    $blog_image = $blog->get_blog_image_by_id($blog_id);

    if (isset($_FILES['blog_image']['name']) && !empty($_FILES['blog_image']['name'])) {
        // Xóa ảnh blog cũ trước khi cập nhật ảnh mới
        $old_img_path = "uploads/" . $blog_image;
        if (file_exists($old_img_path)) {
            unlink($old_img_path);
        }

        $blog_image = $_FILES['blog_image']['name'];
        move_uploaded_file($_FILES['blog_image']['tmp_name'], "uploads/" . $_FILES['blog_image']['name']);
    }

    $update_blog = $blog->update_blog($_POST, $blog_id);

    if ($update_blog) {
        echo "<script>alert('Blog updated successfully.');</script>";
        echo "<script>window.location.href = 'bloglist.php';</script>";
    } else {
        echo "<script>alert('Failed to update the blog.');</script>";
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Edit Blog</h6>
            <a href="bloglist.php">Back to Blog List</a>
        </div>
        <div class="admin-content-right-product-add row">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                <div class="form-group">
                    <label for="blog_cate_id">Select Blog Category <span style="color:red;">*</span></label>
                    <select name="blog_cate_id" id="blog_cate_id" class="form-control" required>
                        <option value="">--Select--</option>
                        <?php
                        if ($categories) {
                            while ($category = $categories->fetch_assoc()) {
                                $selected = ($category['blog_cate_id'] == $blog_detail['blog_cate_id']) ? 'selected' : '';
                                echo '<option value="' . $category['blog_cate_id'] . '" ' . $selected . '>' . $category['blog_cate_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="blog_title">Blog Title: <span style="color:red;">*</span></label>
                    <input name="blog_title" type="text" class="form-control" value="<?php echo $blog_detail['blog_title']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="blog_date">Blog Date: <span style="color:red;">*</span></label>
                    <input name="blog_date" type="text" class="form-control" value="<?php echo $blog_detail['blog_date']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="blog_author">Blog Author: <span style="color:red;">*</span></label>
                    <input name="blog_author" type="text" class="form-control" value="<?php echo $blog_detail['blog_author']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="blog_content">Blog Content: <span style="color:red;">*</span></label>
                    <textarea name="blog_content" id="summernote_content" cols="30" rows="10" class="form-control" required><?php echo $blog_detail['blog_content']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="blog_tags">Blog Tags: <span style="color:red;">*</span></label>
                    <input name="blog_tags" type="text" class="form-control" value="<?php echo $blog_detail['blog_tags']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="blog_image">Blog Image: (Leave blank to keep the current image)</label>
                    <input name="blog_image" type="file" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Summernote and JavaScript code for it here -->
<script>
    $('#summernote_content').summernote({
        placeholder: 'Enter Blog Content',
        tabsize: 2,
        height: 200
    });
</script>

<?php
include "footer.php";
?>
