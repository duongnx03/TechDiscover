<?php
include "header.php";
include "slider.php";
include "class/coupon_class.php";

$coupon_data = null;
$error_message = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $coupon = new coupon();
    $coupon_data = $coupon->get_coupon_by_id($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $amount = $_POST['amount'];
    $expiry_date = $_POST['expiry_date'];

    $coupon = new coupon();
    $result = $coupon->update_coupon($id, $code, $amount, $expiry_date);

    if ($result) {
        // Cập nhật thành công, chuyển hướng người dùng về trang danh sách coupon
        header('Location: coupon.php');
        exit(); // Đảm bảo kết thúc luồng xử lý sau khi chuyển hướng
    } else {
        $error_message = "Cập nhật không thành công.";
    }
}
?>

<div class="admin-content-right">
    <h1>Update Coupon</h1>
    <?php if ($error_message) : ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="" method="post" id="update-form" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo isset($coupon_data['id']) ? $coupon_data['id'] : ''; ?>">

        <label for="code">Code:</label>
        <input type="text" id="code" name="code" value="<?php echo isset($coupon_data['code']) ? $coupon_data['code'] : ''; ?>"><br><br>

        <label for="amount">Discount Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo isset($coupon_data['amount']) ? $coupon_data['amount'] : ''; ?>"><br><br>

        <label for="expiry_date">Expiry Date:</label>
        <input type="datetime-local" id="expiry_date" name="expiry_date" value="<?php echo isset($coupon_data['expiry_date']) ? $coupon_data['expiry_date'] : ''; ?>"><br><br>

        <input type="submit" value="Update Coupon">
    </form>
</div>

<script>
function validateForm() {
    var code = document.getElementById("code").value;
    var amount = document.getElementById("amount").value;
    var expiry_date = document.getElementById("expiry_date").value;

    if (code === "" || amount === "" || expiry_date === "") {
        alert("Vui lòng điền đầy đủ thông tin.");
        return false;
    }
}
</script>

