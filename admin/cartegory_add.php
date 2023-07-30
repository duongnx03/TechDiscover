
<?php
    include "header.php";
    include "slider.php";
    include "class/cartegory_class.php";
?>

<?php
    $cartegory = new cartegory;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartegory_main_id = $_POST['cartegory_main_id'];
        $cartegory_name = $_POST['cartegory_name'];
        $insert_cartegory = $cartegory -> insert_cartegory($cartegory_main_id, $cartegory_name);
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
                <h1>ADD cartegory</h1>
                <form action="" method="POST">
                   <select name="cartegory_main_id" id="" required>
                        <option value="">--  Select  --</option>
                        <?php
                        $show_cartegory_main = $cartegory->show_cartegory_main();
                        if($show_cartegory_main){while($result = $show_cartegory_main -> fetch_assoc()){
                        ?>
                        <option value="<?php echo $result['cartegory_main_id']?>"><?php echo $result['cartegory_main_name']?></option>
                        <?php
                        }}
                        ?>
                   </select><br>
                   <input required name="cartegory_name" type="text" placeholder="Enter Cartegory Name">
                    <button type="submit">ADD</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>