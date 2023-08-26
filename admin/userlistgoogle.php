<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/user_class.php";
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_td";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$user = new user;
$show_user = $user->show_users();
$user = new user;
$show_user = $user->show_users_except_admin();

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to get users based on search criteria
$query = "SELECT * FROM userss 
          WHERE id LIKE '%$search%' OR email LIKE '%$search%'";

$show_user = $db->query($query); // Use the query() method to perform the query
?>
 
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        <form class="d-none d-md-flex ms-4" method="GET" action="userlist.php"> <!-- Chuyển hướng đến trang userlist.php để xử lý tìm kiếm -->
                    <input class="form-control bg-dark border-0" type="search" name="search" placeholder="Search by ID, Gmail, or Username">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            <h6 class="mb-0">User List</h6>
            <a href="userlistadd.php">ADD User</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">ID</th>
                        <th scope="col">Oauth Provider</th>
                        <th scope="col">Oauth ID</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th> <!-- Thêm cột Status -->
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <body>
                    <?php
                    if ($show_user) {
                        $i = 0;
                        while ($result = $show_user->fetch_assoc()) {
                            if ($result['role'] !== 'admin') {
                                $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['id'] ?></td>
                                <td><?php echo $result['oauth_provider'] ?></td>
                                <td><?php echo $result['oauth_uid']; ?></td>
                                <td><?php echo $result['first_name'] ?></td>
                                <td><?php echo $result['last_name'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td>
                                    <?php
                                    if ($result['is_online'] == 2) {
                                        echo 'Banned';
                                    } else {
                                        echo $result['is_online'] ? 'Online' : 'Offline';
                                    }
                                    ?>
                                </td>
                                <td><a href="../admin/userlistedit.php?id=<?php echo $result['id']; ?>">Edit</a></td>
                                <td>
                                    <a href="userlistdelete.php?id=<?php echo $result['id']; ?>" onclick="return confirmDelete()">Delete</a>
                                </td>
                                <?php if ($result['is_online'] == 2) : ?>
                                    <td><a href="../admin/userlistunbanned.php?id=<?php echo $result['id']; ?>" onclick="confirmUnban(<?php echo $result['id']; ?>)">Unbaned</a></td>
                                <?php else : ?>
                                    <td><a href="../admin/userlistbanned.php?id=<?php echo $result['id']; ?>" onclick="confirmBan(<?php echo $result['id']; ?>)">Ban</a></td>
                                <?php endif; ?>
                            </tr>
                    <?php
                        }
                    }
                }
                    ?>
                </body>
            </table>
        </div>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'userlistdelete.php?id=' + userId;
        }
    }
</script>
<script>
    function confirmBan(userId) {
        if (confirm('Are you sure you want to ban this user?')) {
            window.location.href = 'userlistbanned.php?id=' + userId;
        }
    }
</script>
<script>
    function confirmUnban(userId) {
        if (confirm('Are you sure you want to unban this user?')) {
            window.location.href = 'userlistunbanned.php?id=' + userId;
        }
    }
</script>

<script>
    function updateStatus(userId, isOnline) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_user_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Cập nhật thành công, có thể thực hiện thao tác khác nếu cần
                } else {
                    // Xử lý lỗi nếu cần
                }
            }
        };
        var data = 'user_id=' + userId + '&is_online=' + isOnline;
        xhr.send(data);
    }
</script>

<?php
include "footer.php";
?>
