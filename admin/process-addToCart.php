<?php
session_start();
include("config.php");
include("database.php");

if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}else{
    echo '<script>
            alert("Please login to add products to cart.");
            window.location.href = "../login.php";
        </script>';
        exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addToCart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_POST['product_img'];
    $product_color = $_POST['product_color'];
    $product_memory_ram = $_POST['product_memory_ram'];
    $quantity = $_POST['quantity'];
    $total = $product_price * $quantity;
    $db = new Database();
    $query = "INSERT INTO tbl_cart (user_id, product_name, product_price, product_color, product_memory_ram, product_img, quantity, total, product_id) 
              VALUES ('$user_id', '$product_name', '$product_price', '$product_color', '$product_memory_ram', '$product_img', '$quantity', '$total', '$product_id')";
    $result = $db->insert($query);
    if ($result) {
        $_SESSION["add_to_cart_result"] = "Add to Cart success!";
        header("Location: ../product.php?product_id=$product_id");
        exit();
    }
}
?>

