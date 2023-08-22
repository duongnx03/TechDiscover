<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/coupon_class.php"
?>
<?php
$coupon = new coupon();
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['coupon_id'])) {
    $coupon_id = $_GET['coupon_id'];
    $coupon->delete_coupon($coupon_id);
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
.expired {
    color: red;
}
.out-of-stock {
    color: red;
    font-weight: bold;
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
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php  $stt = 1; foreach ($coupons as $row) : ?>
            <?php
                $expiry_date = $row['expiry_date'];
                $expiry_date = $row['expiry_date']; // Lấy ngày/giờ từ cơ sở dữ liệu
$expiry_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $expiry_date); // Chuyển đổi thành đối tượng DateTime
$current_datetime = new DateTime(); // Lấy thời gian hiện tại

if ($expiry_datetime < $current_datetime) {
    $expired_class = 'expired'; // Đã hết hạn
} else {
    $expired_class = ''; // Còn hiệu lực
}
                $quantity = $row['quantity'];
                $out_of_stock_class = ($quantity <= 0) ? 'out-of-stock' : '';
            ?>
            <tr>
                <td><?php echo $stt++; ?></td>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td class="<?php echo $expired_class; ?>"><?php echo $row['expiry_date']; ?></td>
                <td class="<?php echo $out_of_stock_class; ?>"><?php echo $quantity; ?></td>
                <td>
                <a class="btn-update" href="coupon_update.php?coupon_id=<?php echo $row['coupon_id']; ?>">Update</a>

                    <a class="btn-delete" href="coupon.php?action=delete&coupon_id=<?php echo $row['coupon_id']; ?>" onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 

    </div>
</div>
<?php
    include "footer.php";
?>