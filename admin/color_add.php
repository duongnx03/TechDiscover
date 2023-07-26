
<?php
    include "header.php";
    include "slider.php";
    include "class/color_class.php"
?>

<?php
    $color = new color;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $color_name = $_POST['color_name'];
        $insert_color = $color -> insert_color($color_name);
    }
?>


<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>ADD Color</h1>
                <form action="" method="POST">
                    <input name="color_name" type="text" placeholder="Nhap ten mau " required>
                    <button type="submit">Add</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>