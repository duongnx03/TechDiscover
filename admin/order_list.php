<?php
include "header.php";
include "slider.php";
include "class/order_class.php";
?>

<?php
$order = new order;
$show_order = $order-> show_order_list();
$result = '';
if (isset($_SESSION["order_result"])) {
    $result = $_SESSION["order_result"];
    unset($_SESSION["order_result"]);
        echo "<script>
                alert('$result');
             </script>";
    }
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Order User List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>User Info</th>
                <th>Product Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_order){$i=0;
                while($result = $show_order->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['order_id']?></td>
                <td class="info"><?php echo $result['user_info'] ?></td>
                <td><?php echo $result['product_name']?></td>
                <td><?php echo $result['product_type']?></td>
                <td><?php echo $result['quantity']?></td>
                <td><?php echo $result['order_date']?></td>
                <td><?php echo $result['payment_method']?></td>
                <form action="order_edit.php?order_id=<?php echo $result['order_id']?>" method="post">
                <td class="status">
                    <select name="order_status">
                        <option value="order_processing" <?php if ($result['order_status'] == 'order_processing') echo 'selected' ?>>Order processing</option>
                        <option value="preparing_orders" <?php if ($result['order_status'] == 'preparing_orders') echo 'selected' ?>>Preparing orders</option>
                        <option value="packing_products" <?php if ($result['order_status'] == 'packing_products') echo 'selected' ?>>Packing products</option>
                        <option value="delivered_carrier" <?php if ($result['order_status'] == 'delivered_carrier') echo 'selected' ?>>Delivered to the carrier</option>
                        <option value="delivering" <?php if ($result['order_status'] == 'delivering') echo 'selected' ?>>Delivering</option>
                        <option value="delivered" <?php if ($result['order_status'] == 'delivered') echo 'selected' ?>>Delivered</option>
                    </select>
                </td>
                <td><button type="submit">Update</button> |
                </form>
                <button><a href="#" onclick="confirmDelete(<?php echo $result['order_id']; ?>)">Delete</a></td></button>
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