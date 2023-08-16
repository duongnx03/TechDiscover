<?php
session_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'website_td';

// Create a connection to the database using MySQLi.
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful or display an error message.
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Xử lý cập nhật thông tin nếu người dùng gửi biểu mẫu chỉnh sửa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id']; // Lấy ID của người dùng từ session

    // Lấy dữ liệu cập nhật từ biểu mẫu
    $newFullname = $_POST["fullname"];
    $newAddress = $_POST["address"];
    $newPhone = $_POST["phone"];

    // Xây dựng truy vấn cập nhật
    $updateQuery = "UPDATE users SET fullname = '$newFullname', address = '$newAddress', phone = '$newPhone' WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        $updateSuccess = true; // Đánh dấu cập nhật thành công
    } else {
        $updateError = "An error occurred while updating the information."; // Thông báo lỗi
    }
}
// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Xử lý nếu không tìm thấy thông tin người dùng
}

// Hiển thị thông tin cá nhân và biểu mẫu chỉnh sửa
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
<h2>Profile</h2>
    <?php if ($updateSuccess): ?>
        <p style="color: green;">Profile updated successfully!</p>
    <?php endif; ?>
    <?php if (!empty($updateError)): ?>
        <p style="color: red;"><?php echo $updateError; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
    <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>" disabled>
        <a href="#" class="edit-link" onclick="toggleEdit('email'); return false;"><img src="edit-icon.png" alt="Edit"></a><br>
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo $user['fullname']; ?>" disabled>
        <a href="#" class="edit-link" onclick="toggleEdit('fullname'); return false;"><img src="edit-icon.png" alt="Edit"></a><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $user['address']; ?>" disabled>
        <a href="#" class="edit-link" onclick="toggleEdit('address'); return false;"><img src="edit-icon.png" alt="Edit"></a><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>" disabled>
        <a href="#" class="edit-link" onclick="toggleEdit('phone'); return false;"><img src="edit-icon.png" alt="Edit"></a><br>
        <input type="submit" value="Save Changes">
        
    </form>
    <script>
        function toggleEdit(fieldId) {
            var inputField = document.getElementById(fieldId);
            var editLink = inputField.nextElementSibling;
            if (inputField.disabled) {
                inputField.disabled = false;
                inputField.focus();
                editLink.innerHTML = '<img src="save-icon.png" alt="Save">';
            } else {
                inputField.disabled = true;
                editLink.innerHTML = '<img src="edit-icon.png" alt="Edit">';
            }
        }
    </script>
</body>
</html>
