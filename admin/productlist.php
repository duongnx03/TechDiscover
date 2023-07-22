<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php
$product = new product;
$show_product = $product->show_product();
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Danh Sách Sản Phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>
                <th>Loại Sản Phẩm</th>
                <th>Giá</th>
                <th>Giá Khuyến Mãi</th>
                <th>Mô Tả</th>
                <th>Ảnh Sản Phẩm</th>
                <th>Ảnh Mô Tả</th>
                <th>Edit</th>
            </tr>
            <?php
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['cartegory_name'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td><?php echo $result['product_price_sale'] ?></td>
                        <td><?php echo $result['product_desc'] ?></td>
                        <td>
                            <img src="uploads/<?php echo $result['product_img'] ?>" alt="Product Image" style="max-width: 100px;">
                        </td>
                        <td>
                            <?php
                            $product_id = $result['product_id'];
                            $product_imgs_desc = $product->get_product_imgs_desc($product_id);
                            if ($product_imgs_desc) {
                                while ($row = $product_imgs_desc->fetch_assoc()) {
                                    echo '<img src="uploads/' . $row['product_img_desc'] . '" alt="Product Image" style="max-width: 100px;">';
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Update</a> |
                            <a href="#" onclick="confirmDelete(<?php echo $result['product_id'] ?>)">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
<style>
    .admin-content-right-product-add .image-previews {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* Thiết lập số cột tùy ý */
        grid-gap: 10px;
        /* Khoảng cách giữa các ô */
        justify-items: center;
        /* Căn giữa các ô */
    }

    .admin-content-right-product-add .image-preview-item {
        text-align: center;
    }

    .admin-content-right-product-add .image-preview-item img {
        width: 150px;
        /* Cài độ rộng tùy ý */
        height: 150px;
        /* Cài chiều cao tùy ý - đặt chiều cao giống chiều rộng để giữ kích thước vuông */
        object-fit: cover;
        /* Hiển thị ảnh trong kích thước đã thiết lập mà không làm biến dạng ảnh */
        display: block;
        margin-bottom: 5px;
    }

    .admin-content-right-category-list .image-previews {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* Thiết lập số cột tùy ý */
        grid-gap: 10px;
        /* Khoảng cách giữa các ô */
        justify-items: center;
        /* Căn giữa các ô */
    }

    .admin-content-right-category-list .image-preview-item {
        text-align: center;
    }

    .admin-content-right-category-list .image-preview-item img {
        width: 150px;
        /* Cài độ rộng tùy ý */
        height: 150px;
        /* Cài chiều cao tùy ý - đặt chiều cao giống chiều rộng để giữ kích thước vuông */
        object-fit: cover;
        /* Hiển thị ảnh trong kích thước đã thiết lập mà không làm biến dạng ảnh */
        display: block;
        margin-bottom: 5px;
    }
</style>

<script>
    //function for productlist-delete
    function confirmDelete(product_id) {
        var result = confirm("Are you sure you want to delete this product?");
        if (result) {
            window.location.href = "productdelete.php?product_id=" + product_id;
        }
    }
</script>
</body>

</html>