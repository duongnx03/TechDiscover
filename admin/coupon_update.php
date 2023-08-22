<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/coupon_class.php";

$coupon_data = null;
$error_message = '';

$coupon = new coupon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupon_id = $_POST['coupon_id'];
    $code = $_POST['code'];
    $amount = $_POST['amount'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];

    $result = $coupon->update_coupon($coupon_id, $code, $amount, $expiry_date, $quantity);

    if ($result) {
        // Cập nhật thành công, chuyển hướng người dùng về trang danh sách coupon
        echo "<script>window.location.href = 'coupon.php';</script>";
        exit(); // Đảm bảo kết thúc luồng xử lý sau khi chuyển hướng
    } else {
        $error_message = "Cập nhật không thành công.";
    }
} elseif (isset($_GET['coupon_id'])) {
    $coupon_id = $_GET['coupon_id'];
    $coupon_data = $coupon->get_coupon_by_id($coupon_id);
    //print_r($coupon_data);
    //$coupon_data->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="admin-content-right">
    <h1>Update Coupon</h1>
   
    <?php if ($error_message) : ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="" method="post" id="update-form" onsubmit="return validateForm()">
        <input type="hidden" name="coupon_id" value="<?php echo $coupon_data['coupon_id']; ?>">

        <label for="code">Code:</label>
        <input type="text" id="code" name="code" value="<?php echo $coupon_data['code']; ?>"><br><br>

        <label for="amount">Discount Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo $coupon_data['amount']; ?>"><br><br>

        <label for="expiry_date">Expiry Date:</label>
        <input type="datetime-local" id="expiry_date" name="expiry_date" value="<?php echo ($coupon_data['expiry_date']) ?>"><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo ($coupon_data['quantity']) ?>"><br><br>

        <input type="submit" value="Update Coupon">
    </form>
</div>

<script>
function validateForm() {
    var code = document.getElementById("code").value;
    var amount = document.getElementById("amount").value;
    var expiry_date = document.getElementById("expiry_date").value;
    var quantity = document.getElementById("quantity").value;

    if (code === "" && amount === "" && expiry_date === "" && quantity === "") {
        alert("Vui lòng điền ít nhất 1 thông tin.");
        return false;
    }
}
</script>

<?php
    include "footer.php";
?>
