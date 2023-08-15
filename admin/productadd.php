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

$color_list = $product->show_color();
$memory_ram_list = $product->show_memory_ram();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $add_product = $product->insert_product($_POST, $_FILES);

    if ($insert_product) {
        echo "<script>window.location.href = 'productlist.php';</script>";
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Thêm Sản Phẩm</h6>
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
                                echo '<option value="' . $_result['cartegory_main_id'] . '">' . $_result['cartegory_main_name'] . '</option>';
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
                                echo '<option value="' . $_result['cartegory_id'] . '">' . $_result['cartegory_name'] . '</option>';
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
                                echo '<option value="' . $_result['brand_id'] . '">' . $_result['brand_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_name">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
                    <input name="product_name" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="product_price">Giá Sản Phẩm <span style="color:red;">*</span></label>
                    <input required name="product_price" type="text" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="product_price_sale">Giá Khuyễn Mãi<span style="color:red;">*</span></label>
                    <input required name="product_price_sale" type="text" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="product_color">Màu Sắc <span style="color:red;">*</span></label>
                    <select name="product_color" required class="form-control">
                        <option value="">--Chọn--</option>
                        <?php
                        if ($color_list) {
                            while ($color = $color_list->fetch_assoc()) {
                                echo '<option value="' . $color['color_name'] . '">' . $color['color_name'] . '</option>';
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
                                echo '<option value="' . $memory_ram['memory_ram_name'] . '">' . $memory_ram['memory_ram_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_quantity">Số Lượng Hàng Trong Kho <span style="color:red;">*</span></label>
                    <input required name="product_quantity" type="number" min="0" class="form-control">
                </div>

                <div class="form-group">
                    <label for="product_intro">Giới Thiệu Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea required name="product_intro" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="product_detail">Chi Tiết Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_detail" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="product_accessory">Phụ Kiện Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_accessory" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="product_guarantee">Bảo Hành Sản Phẩm <span style="color:red;">*</span></label>
                    <textarea name="product_guarantee" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="product_img">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
                    <input required name="product_img" type="file" class="form-control" onchange="previewImage(this, 'previewProductImg')">
                    <img id="previewProductImg" src="" alt="Preview Image" style="max-width: 200px; max-height: 200px; display: none;"><br>
                </div>

                <div class="form-group">
                    <label for="product_img_desc">Ảnh Mô Tả<span style="color:red;">*</span></label>
                    <input name="product_img_desc[]" multiple type="file" class="form-control" onchange="previewImages(this)">
                    <div class="image-previews">
                        <!-- Dùng để hiển thị các ảnh đã chọn -->
                    </div>
                    <!-- <div class="error-messages"></div> -->
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>



<style>
    .admin-content-right-product-add{
    display: flex;
    flex-direction: column; /* Sắp xếp hàng dọc */
    align-items: flex-start; /* Căn trái phần tử con */
    gap: 20px; /* Khoảng cách giữa các phần tử con */
}

    .image-previews {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* Thiết lập số cột tùy ý */
        grid-gap: 10px;
        /* Khoảng cách giữa các ô */
        justify-items: center;
        /* Căn giữa các ô */
    }

    .image-preview-item {
        text-align: center;
    }

    .image-preview-item img {
        width: 150px;
        /* Cài độ rộng tùy ý */
        height: 200px;
        /* Cài chiều cao tùy ý */
        display: block;
        margin-bottom: 5px;
    }
</style>
<script>
    //function for productadd to show cartegory with cartegory_main_id
    function getCategoriesByMainCategory() {
    var cartegory_main_id = document.getElementById("cartegory_main_id").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_cartegories_by_cartegory_main_id.php?cartegory_main_id=" + cartegory_main_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var selectCategory = document.getElementById("cartegory_id");
            selectCategory.innerHTML = xhr.responseText;

            // Trigger the change event of the category select to update the brands select
            getBrandsByCategory();
        }
    };
    xhr.send();
}

    //function for productadd to show brand with cartegory_id
    function getBrandsByCategory() {
        var cartegory_id = document.getElementById("cartegory_id").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "get_brands_by_category.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var selectBrand = document.getElementById("brand_id");
                selectBrand.innerHTML = xhr.responseText;
            }
        };
        xhr.send("cartegory_id=" + cartegory_id);
    }

    //hien anh truoc khi add san pham 
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

    function previewImages(input) {
        var imagesContainer = document.querySelector('.image-previews');
        imagesContainer.innerHTML = '';

        var errorMessagesContainer = document.querySelector('.error-messages');
        errorMessagesContainer.innerHTML = '';

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
                errorMessage.innerText = "Định dạng đuôi ảnh không hợp lệ. Chỉ chấp nhận định dạng jpg, jpeg, png, gif.";
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