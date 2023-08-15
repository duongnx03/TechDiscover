<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/user_class.php";
?>

<?php
$user = new user;
$show_user = $user->show_users();
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">User List</h6>
            <a href="userlistadd.php">ADD User</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_user) {
                        $i = 0;
                        while ($result = $show_user->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['id'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $result['username'] ?></td>
                                <td><?php echo $result['password'] ?></td>
                                <td><?php echo $result['fullname'] ?></td>
                                <td><?php echo $result['address'] ?></td>
                                <td><?php echo $result['phone'] ?></td>
                                <td><a href="../admin/userlistedit.php">Edit</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Function for user-delete
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'userlistdelete.php?id=' + id;
        }
    }
</script>

<?php
include "footer.php";
?>
