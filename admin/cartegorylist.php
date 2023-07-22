<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php"
?>

<?php
$cartegory = new cartegory;
$show_cartegory = $cartegory-> show_cartegory();
?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Danh Sách Danh Mục</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Ten Danh Muc</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_cartegory){$i=0;
                while($result = $show_cartegory->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['cartegory_id']?></td>
                <td><?php echo $result['cartegory_name']?></td>
                <td><a href="cartegoryedit.php?cartegory_id=<?php echo $result['cartegory_id']?>">Update</a> | 
                <a href="#" onclick="confirmDelete(<?php echo $result['cartegory_id']; ?>)">Delete</a></td>
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
     function confirmDelete(cartegory_id) {
            if (confirm('Are you sure you want to delete this category?')) {
                window.location.href = 'cartegorydelete.php?cartegory_id=' + cartegory_id;
            }
        }
</script>
</body>

</html>