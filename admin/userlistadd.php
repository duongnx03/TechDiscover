<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/user_class.php";

$errors = array(); // Khởi tạo mảng chứa lỗi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Kiểm tra số điện thoại, địa chỉ email và các trường khác

    // Kiểm tra lỗi từ việc thêm người dùng vào cơ sở dữ liệu
    $user = new User();
    $insertResult = $user->insert_user($email, $username, $password, $fullname, $address, $phone);
    
    if (is_string($insertResult)) {
        $errors['insert'] = $insertResult;
    } elseif ($insertResult === true) {
        $successMessage = "User added successfully!";
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">ADD User Information</h6>
            <a href="userlist.php">Back to User List</a>
        </div>
        <div class="admin-content-right-category-add">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" required placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" required placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" required placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input name="fullname" type="text" class="form-control" required placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input name="address" type="text" class="form-control" required placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" type="tel" class="form-control" required placeholder="Enter Phone Number">
                </div>
                <button type="submit" class="btn btn-primary">Add User</button>
            </form>
        </div>
    </div>
</div>
<?php
if (!empty($errors)) {
    echo '<div class="alert alert-danger" role="alert">';
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo '</div>';
}

if (isset($successMessage)) {
    echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
}
?>
<?php include "footer.php"; // Include your footer ?>
