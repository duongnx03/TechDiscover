<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/product_class.php";
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
$product = new product;

if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}

$get_product = $product->get_product($product_id);

if ($get_product) {
    $result = $get_product->fetch_assoc();
}

$color_list = $product->show_color();
$memory_ram_list = $product->show_memory_ram();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_product = $product->update_product($_POST, $_FILES, $product_id);

    if ($update_product) {
        echo "<script>window.location.href = 'productlist.php';</script>";
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Cập Nhật Sản Phẩm</h6>
            <a href="productlist.php">Back to Product List</a>
        </div>
        <div class="admin-content-right-product-add row">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="cartegory_main_id">Chọn Danh Mục Chính <span style="color:red;">*</span></label>
                    <select name="cartegory_main_id" id="cartegory_main_id" onchange="getCategoriesByMainCategory()" class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        $show_cartegory_main = $product->show_cartegory_main();
                        if ($show_cartegory_main) {
                            while ($_result = $show_cartegory_main->fetch_assoc()) {
                                $selected = ($result['cartegory_main_id'] == $_result['cartegory_main_id']) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $_result['cartegory_main_id'] . '">' . $_result['cartegory_main_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cartegory_id">Chọn Danh Mục <span style="color:red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id" onchange="getBrandsByCategory()" class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        $show_cartegory = $product->show_cartegory();
                        if ($show_cartegory) {
                            while ($_result = $show_cartegory->fetch_assoc()) {
                                $selected = ($result['cartegory_id'] == $_result['cartegory_id']) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $_result['cartegory_id'] . '">' . $_result['cartegory_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        $show_brand = $product->show_brand();
                        if ($show_brand) {
                            while ($_result = $show_brand->fetch_assoc()) {
                                $selected = ($result['brand_id'] == $_result['brand_id']) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $_result['brand_id'] . '">' . $_result['brand_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_name">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
                    <input name="product_name" type="text" class="form-control" required value="<?php echo $result['product_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="product_price">Giá Sản Phẩm <span style="color:red;">*</span></label>
                    <input required name="product_price" type="text" class="form-control" placeholder="" value="<?php echo $result['product_price']; ?>">
                </div>

                <div class="form-group">
                    <label for="product_price_sale">Giá Khuyễn Mãi<span style="color:red;">*</span></label>
                    <input required name="product_price_sale" type="text" class="form-control" placeholder="" value="<?php echo $result['product_price_sale']; ?>">
                </div>

                <div class="form-group">
                    <label for="product_color">Màu Sắc <span style="color:red;">*</span></label>
                    <select name="product_color" required class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        if ($color_list) {
                            while ($color = $color_list->fetch_assoc()) {
                                $selected = ($result['product_color'] == $color['color_name']) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $color['color_name'] . '">' . $color['color_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_memory_ram">Bộ Nhớ, Ram <span style="color:red;">*</span></label>
                    <select name="product_memory_ram" required class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        if ($memory_ram_list) {
                            while ($memory_ram = $memory_ram_list->fetch_assoc()) {
                                $selected = ($result['product_memory_ram'] == $memory_ram['memory_ram_name']) ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $memory_ram['memory_ram_name'] . '">' . $memory_ram['memory_ram_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_quantity">Số Lượng Hàng Trong Kho <span style="color:red;">*</span></label>
                    <input required name="product_quantity" type="number" min="0" class="form-control" value="<?php echo $result['product_quantity']; ?>">
                </div>

                <div class="form-group">
                    <label for="product_intro">Giới Thiệu Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea required name="product_intro" id="" cols="30" rows="10" class="form-control"><?php echo $result['product_intro']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="product_detail">Chi Tiết Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_detail" id="" cols="30" rows="10" class="form-control"><?php echo $result['product_detail']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="product_accessory">Phụ Kiện Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_accessory" id="" cols="30" rows="10" class="form-control"><?php echo $result['product_accessory']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="product_guarantee">Bảo Hành Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_guarantee" id="" cols="30" rows="10" class="form-control"><?php echo $result['product_guarantee']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="product_img">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
                    <input required name="product_img" type="file" class="form-control" onchange="previewImage(this, 'previewProductImg')">
                    <img id="previewProductImg" src="uploads/<?php echo $result['product_img']; ?>" alt="Preview Image" style="max-width: 200px; max-height: 200px; display: block;"><br>
                </div>

                <div class="form-group">
                    <label for="product_img_desc">Ảnh Mô Tả<span style="color:red;">*</span></label>
                    <input name="product_img_desc[]" multiple type="file" class="form-control" onchange="previewImagesOnEdit(this)">
                    <div class="image-previews">
                        <?php
                        $product_imgs_desc = $product->get_product_imgs_desc($product_id);
                        if ($product_imgs_desc) {
                            while ($row = $product_imgs_desc->fetch_assoc()) {
                                echo '<div class="image-preview-item">';
                                echo '<img src="uploads/' . $row['product_img_desc'] . '" alt="Product Image" style="max-width: 150px; height: 100px;">';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <!-- <div class="error-messages"></div> -->
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    /* ... */
    .image-previews {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .image-preview-item {
        margin: 10px;
        text-align: center;
        padding: 10px;
        box-sizing: border-box;
        width: 150px;
        /* Độ rộng cố định của từng ảnh */
    }

    .image-preview-item img {
        width: 100%;
        /* Tự động điều chỉnh kích thước theo độ rộng của phần tử chứa ảnh */
        height: auto;
        /* Đảm bảo tỷ lệ chiều cao thích hợp */
        display: block;
        margin-bottom: 5px;
    }
</style>

<!--  <script> của trang productedit.php -->
<!-- Đoạn mã JavaScript -->
<script>
    function previewImagesOnEdit(input) {
        var imagesContainer = document.querySelector('.image-previews');
        imagesContainer.innerHTML = '';

        // var errorMessagesContainer = document.querySelector('.error-messages');
        // errorMessagesContainer.innerHTML = '';

        var files = input.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageURL = URL.createObjectURL(file);

            var image = document.createElement('img');
            image.src = imageURL;
            image.style.width = '150px'; // Cài độ rộng tùy ý
            image.style.height = '150px'; // Cài chiều cao tùy ý

            imagesContainer.appendChild(image);

            // Kiểm tra định dạng và dung lượng của ảnh mô tả
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            var maxFileSize = 5 * 1024 * 1024; // 5MB

            var fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                var errorMessage = document.createElement('div');
                errorMessage.innerText = "Định dạng đuôi ảnh không hợp lệ. Chỉ chấp nhận định dạng jpg, jpeg, png, webp, gif.";
                errorMessagesContainer.appendChild(errorMessage);
            }

            if (file.size > maxFileSize) {
                var errorMessage = document.createElement('div');
                errorMessage.innerText = "Dung lượng ảnh quá lớn. Chỉ chấp nhận ảnh có dung lượng tối đa là 5MB.";
                errorMessagesContainer.appendChild(errorMessage);
            }
        }
    }
</script>

<?php
    include "footer.php";
?>