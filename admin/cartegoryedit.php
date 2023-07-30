<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php";

$cartegory = new cartegory;

// Lấy cartegory_id từ URL
if(isset($_GET['cartegory_id']) && !empty($_GET['cartegory_id'])) {
    $cartegory_id = $_GET['cartegory_id'];
} else {
    echo "<script>window.location = 'cartegorylist.php'</script>";
}

// Lấy thông tin cartegory theo cartegory_id
$get_cartegory = $cartegory->get_cartegory($cartegory_id);
if($get_cartegory) {
    $result = $get_cartegory->fetch_assoc();
}

// Xử lý khi form được submit
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartegory_main_id = $_POST['cartegory_main_id'];
    $cartegory_name = $_POST['cartegory_name'];
    $update_cartegory = $cartegory->update_cartegory($cartegory_main_id, $cartegory_name, $cartegory_id);
}

?>

<style>
    select {
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-category-add">
        <h1>Update Cartegory</h1>
        <form action="" method="POST">
            <select name="cartegory_main_id" id="" required>
                <option value="">-- Danh Mục --</option>
                <?php
                $show_cartegory_main = $cartegory->show_cartegory_main();
                if($show_cartegory_main) {
                    while($result_main = $show_cartegory_main->fetch_assoc()) {
                        ?>
                        <option <?php if($result['cartegory_main_id'] == $result_main['cartegory_main_id']) { echo "SELECTED"; } ?> value="<?php echo $result_main['cartegory_main_id']?>"><?php echo $result_main['cartegory_main_name']?></option>
                        <?php
                    }
                }
                ?>
            </select><br>
            <input required name="cartegory_name" type="text" placeholder="Nhập Tên Loại Sản Phẩm" value="<?php echo $result['cartegory_name']?>">
            <button type="submit">Update</button>
        </form>
    </div>           
</div>
</section>
</body>
</html>
