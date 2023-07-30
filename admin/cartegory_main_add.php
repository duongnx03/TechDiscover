
<?php
    include "header.php";
    include "slider.php";
    include "class/cartegory_main_class.php"
?>

<?php
    $cartegory_main = new cartegory_main;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartegory_main_name = $_POST['cartegory_main_name'];
        $insert_cartegory_main = $cartegory_main -> insert_cartegory_main($cartegory_main_name);
    }
?>


<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>ADD Category-Main</h1>
                <form action="" method="POST">
                    <input name="cartegory_main_name" type="text" placeholder="Nhap ten danh muc" required>
                    <button type="submit">ADD</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>