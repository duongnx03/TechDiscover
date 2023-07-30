<?php
include "header.php";
include "slider.php";
include "class/product_class.php"
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
    // var_dump($_POST, $_FILES);
    // echo '<pre>';
    // echo print_r($_FILES['product_img_desc']);
    // echo '</pre>';

    $update_product = $product->update_product($_POST, $_FILES, $product_id);

    
}
?>

<style>
    select {
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Update Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">

            <label for="">Chọn Danh Mục <span style="color:red;">*</span></label>
            <select name="cartegory_id" id="">
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

            <label for="">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
            <select name="brand_id" id="">
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


            <label for="">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
            <input name="product_name" type="text" required value="<?php echo $result['product_name']; ?>">

            <label for="">Giá Sản Phẩm <span style="color:red;">*</span></label>
            <input required name="product_price" type="text" placeholder="" value="<?php echo $result['product_price']; ?>">

            <label for="">Giá Khuyến Mãi<span style="color:red;">*</span></label>
            <input required name="product_price_sale" type="text" placeholder="" value="<?php echo $result['product_price_sale']; ?>">

            <label for="">Màu Sắc <span style="color:red;">*</span></label>
            <select name="product_color" required>
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

            <label for="">Bộ Nhớ, Ram <span style="color:red;">*</span></label>
            <select name="product_memory_ram" required>
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
            <label for="">Số Lượng Hàng Trong Kho <span style="color:red;">*</span></label>
            <input required name="product_quantity" type="number" min="0" value="<?php echo $result['product_quantity']; ?>">

            <label for="">Giới Thiệu Sản Phẩm <span style="color:red;">*</span></label>
            <textarea required name="product_intro" id="" cols="30" rows="10"><?php echo $result['product_intro']; ?></textarea>

            <label for="">Chi Tiết Sản Phẩm <span style="color:red;">*</span></label>
            <textarea name="product_detail" id="" cols="30" rows="10"><?php echo $result['product_detail']; ?></textarea>

            <label for="">Phụ Kiện Sản Phẩm <span style="color:red;">*</span></label>
            <textarea name="product_accessory" id="" cols="30" rows="10"><?php echo $result['product_accessory']; ?></textarea>

            <label for="">Bảo Hành Sản Phẩm <span style="color:red;">*</span></label>
            <textarea name="product_guarantee" id="" cols="30" rows="10"><?php echo $result['product_guarantee']; ?></textarea>

            <label for="">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
            <input name="product_img" type="file">
            <img src="uploads/<?php echo $result['product_img']; ?>" alt="Product Image" style="max-width: 200px; max-height: 200px;"><br>

            <label for="">Ảnh Mô Tả<span style="color:red;">*</span></label>
            <input name="product_img_desc[]" multiple type="file" onchange="previewImagesOnEdit(this)">
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
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</section>

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

</body>

</html>