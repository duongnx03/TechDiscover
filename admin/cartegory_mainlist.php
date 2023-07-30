<?php
include "header.php";
include "slider.php";
include "class/cartegory_main_class.php"
?>

<?php
$cartegory_main = new cartegory_main;
$show_cartegory_main = $cartegory_main-> show_cartegory_main();
?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Category-Main List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Category-Main Name</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_cartegory_main){$i=0;
                while($result = $show_cartegory_main->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['cartegory_main_id']?></td>
                <td><?php echo $result['cartegory_main_name']?></td>
                <td><a href="cartegory_mainedit.php?cartegory_main_id=<?php echo $result['cartegory_main_id']?>">Update</a> | 
                <a href="#" onclick="confirmDelete(<?php echo $result['cartegory_main_id']; ?>)">Delete</a></td>
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
     //function for cartegory_main-delete
     function confirmDelete(cartegory_main_id) {
            if (confirm('Are you sure you want to delete this category-main?')) {
                window.location.href = 'cartegory_maindelete.php?cartegory_main_id=' + cartegory_main_id;
            }
        }
</script>
</body>

</html>