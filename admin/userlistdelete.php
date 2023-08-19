<?php
include "class/user_class.php";

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
    $user = new User();
    $user->delete_user($user_id);

    // Chuyển hướng về trang userlist.php sau khi xóa
    header("Location: userlist.php");
    exit;
} else {
    header("Location: userlist.php"); // Redirect if "id" is not set in URL
    exit;
}
?>
