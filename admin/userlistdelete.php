<?php
include "class/user_class.php";

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
    
    $user = new User();
    $result = $user->delete_user($user_id);

    if ($result) {
        // Xóa thành công, bạn có thể chuyển hướng về userlist.php hoặc hiển thị thông báo thành công
        header("Location: userlist.php");
        exit;
    } else {
        // Xóa thất bại, bạn có thể chuyển hướng về userlist.php hoặc hiển thị thông báo lỗi
        header("Location: userlist.php");
        exit;
    }
}
?>




