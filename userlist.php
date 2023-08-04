<?php
include "header.php";
include "slider.php";
include "class/user_class.php"
?>

<?php
$user = new user;
$show_user = $user->show_users();

?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>User List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Fullname</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
            <?php
             if($show_user){$i=0;
                while($result = $show_user->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['id']?></td>
                <td><?php echo $result['email']?></td>
                <td><?php echo $result['username']?></td>
                <td><?php echo $result['password']?></td>
                <td><?php echo $result['fullname']?></td>
                <td><?php echo $result['address']?></td>
                <td><?php echo $result['phone']?></td>
            </tr>
            <?php
             }
            }
            ?>
        </table>
    </div>
</div>
</section>
<script>
     //function for cartegory-delete
     function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this memory_ram?')) {
                window.location.href = 'userlistdelete.php?id=' + id;
            }
        }
</script>
</body>

</html>