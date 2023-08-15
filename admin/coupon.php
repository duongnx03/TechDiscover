<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/coupon_class.php"
?>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $coupon = new coupon();
    $coupon->delete_coupon($id);
}
if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
    // Chuyển đến trang cập nhật
    // $coupon = new coupon();
    // $coupon_data = $coupon->get_coupon_by_id($id);
    header('Location: coupon_update.php?id=' . $_GET['id']);
    
}
    $coupon = new coupon();
    $coupons = $coupon->show_coupon();
?>

<div class="admin-content-right">
            <div class="admin-content-right">
    <h1>Coupons List</h1>
    <h2><a href="coupon_create.php">Create coupon</a></h2>
    <table border="1">
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
                <a href="coupon.php?action=update&id=<?php echo $row['id']; ?>">Update</a>
                    <a href="coupon.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 

    </div>
</div>

