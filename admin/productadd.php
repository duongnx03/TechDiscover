
<?php
    include "header.php";
    include "slider.php";
    include "class"
?>

<?php
    $cartegory = new cartegory;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartgory_name = $_POST['cartgory_name'];
        $insert_cartegory = $cartegory -> insert_cartegory($cartgory_name);
    }
?>


<div class="admin-content-right">
            <div class="admin-content-right-product-add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
                    <input name="category_name" type="text">

                    <label for="">Chọn Danh Mục <span style="color:red;">*</span></label>
                    <select name="" id="">
                        <option value="">-- Chọn --</option>
                    </select>

                    <label for="">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
                    <select name="" id="">
                        <option value="">-- Chọn --</option>
                    </select>

                    <label for="">Giá Sản Phẩm <span style="color:red;">*</span></label> 
                    <input type="text" placeholder="">

                    <label for="">Giá Khuyễn Mãi<span style="color:red;">*</span></label> 
                    <input type="text" placeholder="">

                    <label for="">Mô Tả Sản Phẩm<span style="color:red;">*</span></label>  
                    <textarea name="" id="" cols="30" rows="10"></textarea>

                    <label for="">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
                    <input type="file">

                    <label for="">Ảnh Mô Tả<span style="color:red;">*</span></label>
                    <input multiple type="file">
                    <button type="submit">Add</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html> 