<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/coupon_class.php"
?>
<?php
$coupon = new coupon();
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $coupon->delete_coupon($id);
    echo "<script>window.location.href = 'coupon.php';</script>";
    exit;
}
    $coupons = $coupon->show_coupon(); 
?>
<style>
    /* Tạo giao diện cho bảng */
.coupon-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.coupon-table th, .coupon-table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}

.coupon-table th {
    background-color: #f2f2f2;
}

/* Tạo giao diện cho các nút hành động */
.btn-update, .btn-delete {
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

.btn-update {
    background-color: #3498db;
}

.btn-delete {
    background-color: #e74c3c;
    margin-left: 10px;
}
h3{
    text-align: right;
    margin-right: 30px;
}

</style>

<div class="admin-content-right">
            <div class="admin-content-right">
    <h1>Coupons List</h1><br>
    <h3><a href="coupon_create.php">Create coupon</a></h3>
    <table class="coupon-table" border="1">
        <tr>
            <th>STT</th>
            <th>Code</th>
            <th>Discount Amount</th>
            <th>Expiry Date</th>
            <!-- <th>Status</th> -->
            <th>Action</th>
        </tr>
        <?php  $stt = 1; foreach ($coupons as $row) : ?>
            <tr>
                <td><?php echo $stt++; ?></td>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['expiry_date']; ?></td>
                <td>
                <!-- <a class="btn-update" href="coupon_update.php?id=">Update</a> -->

                    <a class="btn-delete" href="coupon.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 

    </div>
</div>
<?php
    include "footer.php";
?>