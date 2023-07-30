<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Order</h1>

        <div class="order-form">
            <h2>Order Information</h2>
            <form action="confirm.php" method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="text" name="address" placeholder="Your Address" required>
                <input type="text" name="phone" placeholder="Your Phone" required>
                <textarea name="notes" placeholder="Notes"></textarea>
                <input type="submit" name="place_order" value="Place Order">
            </form>
        </div>
    </div>
</body>
</html>
