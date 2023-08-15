<?php
include "header.php";
include "slider.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'class/coupon_class.php';

    $id = null; // Since ID is AUTO_INCREMENT, it will be automatically generated
    $code = $_POST['code'];
    $amount = $_POST['amount'];
    $expiry_date = $_POST['expiry_date'];
    $created_at = date('Y-m-d H:i:s');

    $coupon = new coupon();
    $coupon->insert_coupon($id, $code, $amount, $expiry_date, $created_at);
    header('Location: coupon.php');
    exit;
}
?>


<head>
    <title>Create Coupon</title>
</head>
<body>
    <h1>Create New Coupon</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" required><br><br>

        <label for="amount">Discount Amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <label for="expiry_date">Expiry Date:</label>
        <input type="datetime-local" id="expiry_date" name="expiry_date" required><br><br>

        <input type="submit" value="Create Coupon">
        
    </form>
</body>