<?php
    include "header.php";
    include "slider.php";
    include "class/user_class.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

    }
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-add">
        <h1>ADD User Information</h1>
        <form action="" method="POST">
            <input name="id" type="text" placeholder="ID" required>
            <input name="email" type="email" placeholder="Email" required>
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <input name="fullname" type="text" placeholder="Full Name" required>
            <input name="address" type="text" placeholder="Address" required>
            <input name="phone" type="tel" placeholder="Phone" required>
            <button type="submit">Add</button>
        </form>
    </div>
</div>
</section>
</body>
</html>
