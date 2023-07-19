
<?php
    include "header.php";
    include "slider.php";
    include "class/cartegory_class.php"
?>

<?php
    $cartegory = new cartegory;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartgory_name = $_POST['cartgory_name'];
        $insert_cartegory = $cartegory -> insert_cartegory($cartgory_name);
    }
?>
<style>
    select{
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST">
                   <select name="" id="">
                        <option value="">--  Danh Mục  --</option>
                        <option value="">Điện Thoại</option>
                        <option value="">Laptop</option>
                        <option value=""></option>
                   </select><br>
                   <input require name="brand_name" type="text" placeholder="Nhập Tên Loại Sản Phẩm">
                    <button type="submit">Thêm</button>
                </form>
            </div>           
        </div>
    </session>
</body>
</html>