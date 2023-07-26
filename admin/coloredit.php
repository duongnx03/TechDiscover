
<?php
    include "header.php";
    include "slider.php";
    include "class/color_class.php"
?>

<?php
 $color = new color;
    if(!isset($_GET['color_id']) || $_GET['color_id'] == NULL){
       echo "<script>window.location = 'colorlist.php'</script>";
    }else{
        $color_id = $_GET['color_id'];
    }

    $get_color = $color -> get_color($color_id);

    if($get_color){
        $result = $get_color -> fetch_assoc();
    }
?>

<?php
    $color = new color;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartgory_name = $_POST['cartgory_name'];
        $update_color = $color -> update_color($cartgory_name, $color_id);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Update Color</h1>
                <form action="" method="POST">
                    <input name="cartgory_name" type="text" placeholder="Nhap ten danh muc" required 
                    value="<?php echo $result['color_name']?>">
                    <button type="submit">Update</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>