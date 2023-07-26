<?php
include "header.php";
include "slider.php";
include "class/color_class.php"
?>

<?php
 $color = new color;
$show_color = $color-> show_color();
?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Color List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Color</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_color){$i=0;
                while($result = $show_color->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['color_id']?></td>
                <td><?php echo $result['color_name']?></td>
                <td><a href="coloredit.php?color_id=<?php echo $result['color_id']?>">Update</a> | 
                <a href="#" onclick="confirmDelete(<?php echo $result['color_id']; ?>)">Delete</a></td>
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
     function confirmDelete(color_id) {
            if (confirm('Are you sure you want to delete this color?')) {
                window.location.href = 'colordelete.php?color_id=' + color_id;
            }
        }
</script>
</body>

</html>