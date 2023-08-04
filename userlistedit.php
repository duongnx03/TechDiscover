<?php
    include "header.php";
    include "slider.php";
    include "class/user_class.php";

    $user = new User;

    if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
        echo "<script>window.location = 'userlist.php'</script>";
    } else {
        $user_id = $_GET['user_id'];
    }

    $get_user = $user->get_user_by_id($user_id);

    if ($get_user) {
        $user_data = $get_user->fetch_assoc();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Make sure that the user_id has been provided and has a value
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['id'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
    
            // Add validation and sanitization of user inputs here
    
            $update_success = $user->update_user($user_id, $email, $username, $password, $fullname, $address, $phone);
    
            if ($update_success) {
                echo "<script>alert('User information updated successfully.');</script>";
            } else {
                echo "<script>alert('Failed to update user information.');</script>";
            }
        }
    }
    
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-add">
        <h1>User Details</h1>
        <?php if ($user_data) { ?>
            <p>ID: <?php echo $user_data['id']; ?></p>
            <p>Email: <?php echo $user_data['email']; ?></p>
            <p>Username: <?php echo $user_data['username']; ?></p>
            <p>Password: <?php echo $user_data['password']; ?></p>
            <p>Full Name: <?php echo $user_data['fullname']; ?></p>
            <p>Address: <?php echo $user_data['address']; ?></p>
            <p>Phone: <?php echo $user_data['phone']; ?></p>

            <!-- You can provide links/buttons to edit or delete the user entry if needed -->
            <a href="userlistedit.php?user_id=<?php echo $user_data['id']; ?>">Edit</a>
            <a href="delete_user.php?user_id=<?php echo $user_data['id']; ?>">Delete</a>
        <?php } else { ?>
            <p>No user found with the provided ID.</p>
        <?php } ?>
 