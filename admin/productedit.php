<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php"
?>

<?php
    $product = new product;
    if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
        echo "<script>window.location = 'productlist.php'</script>";
    }else{
        $product_id = $_GET['product_id'];
    }

    $get_product = $product->get_product($product_id);

    if($get_product){
        $result = $get_product->fetch_assoc();
    }

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
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">

            <label for="">Chọn Danh Mục <span style="color:red;">*</span></label>
            <select name="cartegory_id" id="">
                <option value="">--Chọn--</option>
                <?php
                    $show_cartegory = $product->show_cartegory();
                    if($show_cartegory){
                        while($_result = $show_cartegory->fetch_assoc()){
                            $selected = ($result['cartegory_id'] == $_result['cartegory_id']) ? 'selected' : '';
                            echo '<option '.$selected.' value="'.$_result['cartegory_id'].'">'.$_result['cartegory_name'].'</option>';
                        }
                    }
                ?>
            </select>

            <label for="">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
            <select name="brand_id" id="">
                <option value="">--Chọn--</option>
                <?php
                    $show_brand = $product->show_brand();
                    if($show_brand){
                        while($_result = $show_brand->fetch_assoc()){
                            $selected = ($result['brand_id'] == $_result['brand_id']) ? 'selected' : '';
                            echo '<option '.$selected.' value="'.$_result['brand_id'].'">'.$_result['brand_name'].'</option>';
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

            <label for="">Mô Tả Sản Phẩm<span style="color:red;">*</span></label>
            <textarea required name="product_desc" id="" cols="30" rows="10"><?php echo $result['product_desc']; ?></textarea>

            <label for="">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
            <input name="product_img" type="file">
            <img src="uploads/<?php echo $result['product_img']; ?>" alt="Product Image" style="max-width: 200px; max-height: 200px;"><br>

            <label for="">Ảnh Mô Tả<span style="color:red;">*</span></label>
            <input name="product_img_desc[]" multiple type="file">
            <div class="image-previews">
                <?php
                    $product_imgs_desc = $product->get_product_imgs_desc($product_id);
                    if($product_imgs_desc){
                        while($row = $product_imgs_desc->fetch_assoc()){
                            echo '<div class="image-preview-item">';
                            echo '<img src="uploads/'.$row['product_img_desc'].'" alt="Product Image" style="max-width: 150px; height: 100px;">';
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
        width: 150px; /* Độ rộng cố định của từng ảnh */
    }

    .image-preview-item img {
        width: 100%; /* Tự động điều chỉnh kích thước theo độ rộng của phần tử chứa ảnh */
        height: auto; /* Đảm bảo tỷ lệ chiều cao thích hợp */
        display: block;
        margin-bottom: 5px;
    }
</style>

</body>
</html>
