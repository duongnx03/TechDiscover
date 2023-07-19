
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


<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Them Danh Muc</h1>
                <form action="" method="POST">
                    <input name="cartgory_name" type="text" placeholder="Nhap ten danh muc" required>
                    <button type="submit">Them</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>