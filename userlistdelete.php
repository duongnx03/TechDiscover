<?php
    include "class/user_class.php";
    $user = new User;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $user_id = $_POST['user_id'];

            // Now, you can proceed with deleting the user entry.
            $delete_success = $user->delete_user($user_id);
            if ($delete_success) {
                echo "<script>alert('User deleted successfully.');</script>";
            } else {
                echo "<script>alert('Failed to delete user.');</script>";
            }
        }
    }
?>

<form action="" method="POST">
    <input type="hidden" name="user_id" value="user_id_to_delete">
    <button type="submit">Delete User</button>
</form>
