
<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php"
?>

<?php
   $product = new product;
   if($_SERVER['REQUEST_METHOD']=== 'POST'){
        // var_dump($_POST, $_FILES);
        // echo '<pre>';
        // echo print_r($_POST);
        // echo '</pre>';

       $insert_product = $product -> insert_product($_POST, $_FILES);
   }
?>


<div class="admin-content-right">
            <div class="admin-content-right-product-add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập Tên Sản Phẩm <span style="color:red;">*</span></label>
                    <input name="product_name" type="text" required>

                    <label for="">Chọn Danh Mục <span style="color:red;">*</span></label>
                    <select name="cartegory_id" id="">
                        <option value="">--Chon--</option>
                        <?php
                            $show_cartegory = $product -> show_cartegory();
                            if($show_cartegory){
                                while($_result = $show_cartegory -> fetch_assoc()){                        
                        ?>
                        <option value="<?php echo $_result['cartegory_id']?>"><?php echo $_result['cartegory_name']?></option>
                        <?php
                             }
                            }
                        ?>
                    </select>

                    <label for="">Chọn Loại Sản Phẩm <span style="color:red;">*</span></label>
                    <select name="brand_id" id="">
                    <option value="">--Chon--</option>
                    <?php
                            $show_brand = $product -> show_brand();
                            if($show_brand){
                                while($_result = $show_brand -> fetch_assoc()){                        
                        ?>
                        <option value="<?php echo $_result['brand_id']?>"><?php echo $_result['brand_name']?></option>
                        <?php
                             }
                            }
                        ?>
                    </select>

                    <label for="">Giá Sản Phẩm <span style="color:red;">*</span></label> 
                    <input required name="product_price" type="text" placeholder="">

                    <label for="">Giá Khuyễn Mãi<span style="color:red;">*</span></label> 
                    <input required name="product_price_sale" type="text" placeholder="">

                    <label for="">Mô Tả Sản Phẩm<span style="color:red;">*</span></label>  
                    <textarea required name="product_desc" id="" cols="30" rows="10"></textarea>

                    <label for="">Ảnh Sản Phẩm<span style="color:red;">*</span></label>
                    <input required name="product_img" type="file">

                    <label for="">Ảnh Mô Tả<span style="color:red;">*</span></label>
                    <input name="product_img_desc" multiple type="file">
                    <button type="submit">Add</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html> 