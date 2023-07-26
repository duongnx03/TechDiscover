<?php
include "header.php";
include "slider.php";
include "class/memory_ram_class.php"
?>

<?php
 $memory_ram = new memory_ram;
$show_memory_ram = $memory_ram-> show_memory_ram();
?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Memory - Ram List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Memory - Ram</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_memory_ram){$i=0;
                while($result = $show_memory_ram->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['memory_ram_id']?></td>
                <td><?php echo $result['memory_ram_name']?></td>
                <td><a href="memory_ramedit.php?memory_ram_id=<?php echo $result['memory_ram_id']?>">Update</a> | 
                <a href="#" onclick="confirmDelete(<?php echo $result['memory_ram_id']; ?>)">Delete</a></td>
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
     function confirmDelete(memory_ram_id) {
            if (confirm('Are you sure you want to delete this memory_ram?')) {
                window.location.href = 'memory_ramdelete.php?memory_ram_id=' + memory_ram_id;
            }
        }
</script>
</body>

</html>