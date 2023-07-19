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
        <h1>Danh Sách Loại Sản Phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Loại Sản Phẩm</th>
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
                <a href="#" onclick="confirmDelete(<?php echo $result['brand_id']; ?>)">Delete</a></td>
            </tr>
            <?php
             }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>

</html>