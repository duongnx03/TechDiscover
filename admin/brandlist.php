<?php
include "header.php";
include "slider.php";
include "class/brand_class.php"
?>

<?php
$brand = new brand;
$show_brand = $brand-> show_brand();
?>


<div class="admin-content-right">
    <div class="admin-content-right-category-list">
        <h1>Brand List</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Category Name</th>
                <th>Product Type</th>
                <th>Edit</th>
            </tr>
            <?php
             if($show_brand){$i=0;
                while($result = $show_brand->fetch_assoc()){$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['brand_id']?></td>
                <td><?php echo $result['cartegory_name']?></td>
                <td><?php echo $result['brand_name']?></td>
                <td><a href="brandedit.php?brand_id=<?php echo $result['brand_id']?>">Update</a> | 
                <a href="branddelete.php?brand_id=<?php echo $result['brand_id']?>">Delete</a></td>
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
        function confirmDelete(brand_id) {
            if (confirm('Are you sure you want to remove this brand?')) {
                window.location.href = 'branddelete.php?brand_id=' + brand_id;
            }
        }
    </script>
</body>

</html>