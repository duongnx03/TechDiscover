<?php
include "header.php";
include "slider.php";
include "database.php";

if (isset($_POST)) {
    $order_id = $_GET['order_id'];
    $database = new Database();
    $query = "SELECT * FROM tbl_order_items where order_id = $order_id";
    $result = $database->select($query);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Order User List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>Product</th>
                <th>Name</th>
                <th>Color</th>
                <th>Ram</th>
                <th>Quantity</th>
            </tr> 
            <?php
             if($result){
                $i=0;
                while($row = $result->fetch_assoc()){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><img src="uploads/<?php echo $row['product_img']; ?>" width="100px"></td>
                <td><?php echo $row['product_name']?></td>
                <td><?php echo $row['product_color']?></td>
                <td><?php echo $row['product_memory_ram']?></td>
                <td><?php echo $row['quantity']?></td>
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
    .info{
        width: 250px;
    }
    .status{
        width: 90px;
    }
</style>
<script>
     function confirmDelete(order_id) {
            if (confirm('Are you sure you want to delete this order list?')) {
                window.location.href = 'order_delete.php?order_id=' + order_id;
            }
        }
</script>
</body>

</html>