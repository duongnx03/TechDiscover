<?php
include "header.php";
include "slider.php";
include "class/product_class.php"
?>

<?php
$product = new product;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST, $_FILES);
    // echo '<pre>';
    // echo print_r($_FILES['product_img_desc']);
    // echo '</pre>';

    $insert_product = $product->insert_product($_POST, $_FILES);
}
?>


<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Thêm Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">

            <label for="">Chọn Danh Mục <span style="color:red;">*</span></label>
            <select name="cartegory_id" id="cartegory_id" onchange="getBrandsByCategory()">
                <option value="">--Chon--</option>
                <?php
                $show_cartegory = $product->show_cartegory();
                if ($show_cartegory) {
                    while ($_result = $show_cartegory->fetch_assoc()) {
                ?>
                        <option value="<?php echo $_result['cartegory_id'] ?>"><?php echo $_result['cartegory_name'] ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label for="">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
            <select name="brand_id" id="brand_id">
                <option value="">--Chọn--</option>
            </select>

            <label for="product_name">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
            <input name="product_name" type="text" required>

            <label for="">Giá Sản Phẩm <span style="color:red;">*</span></label>
            <input required name="product_price" type="text" placeholder="">

            <label for="">Giá Khuyễn Mãi<span style="color:red;">*</span></label>
            <input required name="product_price_sale" type="text" placeholder="">

            <label for="">Màu Sắc <span style="color:red;">*</span></label>
            <input required name="product_color" type="text">

            <label for="">Bộ Nhớ, Ram <span style="color:red;">*</span></label>
            <input required name="product_memory_ram" type="text">

            <label for="">Số Lượng Hàng Trong Kho <span style="color:red;">*</span></label>
            <input required name="product_quantity" type="number" min="0">

            <label for="">Giới Thiệu Sản Phẩm <span style="color:red;">*</span></label>
            <textarea required name="product_intro" id="" cols="30" rows="10"></textarea>

            <label for="">Chi Tiết Sản Phẩm <span style="color:red;">*</span></label>
            <textarea  name="product_detail" id="" cols="30" rows="10"></textarea>

            <label for="">Phụ Kiện Sản Phẩm <span style="color:red;">*</span></label>
            <textarea  name="product_accessory" id="" cols="30" rows="10"></textarea>

            <label for="">Bảo Hành Sản Phẩm <span style="color:red;">*</span></label>
            <textarea  name="product_guarantee" id="" cols="30" rows="10"></textarea>


            <label for="">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
            <input required name="product_img" type="file" onchange="previewImage(this, 'previewProductImg')">
            <img id="previewProductImg" src="#" alt="Preview Image" style="max-width: 200px; max-height: 200px; display: none;"><br>

            <div>
                <label for="">Ảnh Mô Tả<span style="color:red;">*</span></label>
                <input name="product_img_desc[]" multiple type="file" onchange="previewImages(this)">
                <div class="image-previews"></div>
                <div class="error-messages"></div>
            </div>
            <button type="submit">Add</button>

        </form>
    </div>
</div>
</section>
<style>
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
</body>

</html>