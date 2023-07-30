
<?php
    include "header.php";
    include "slider.php";
    include "class/cartegory_main_class.php"
?>

<?php
 $cartegory_main = new cartegory_main;
    if(!isset($_GET['cartegory_main_id']) || $_GET['cartegory_main_id'] == NULL){
       echo "<script>window.location = 'cartegory_mainlist.php'</script>";
    }else{
        $cartegory_main_id = $_GET['cartegory_main_id'];
    }

    $get_cartegory_main = $cartegory_main -> get_cartegory_main($cartegory_main_id);

    if($get_cartegory_main){
        $result = $get_cartegory_main -> fetch_assoc();
    }
?>

<?php
    $cartegory_main = new cartegory_main;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartegory_main_main_name = $_POST['cartegory_main_main_name'];
        $update_cartegory_main = $cartegory_main -> update_cartegory_main($cartegory_main_main_name, $cartegory_main_id);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Update Category-Main</h1>
                <form action="" method="POST">
                    <input name="cartegory_main_main_name" type="text" placeholder="Enter the main category name" required 
                    value="<?php echo $result['cartegory_main_name']?>">
                    <button type="submit">Update</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>