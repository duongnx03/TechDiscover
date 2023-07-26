
<?php
    include "header.php";
    include "slider.php";
    include "class/memory_ram_class.php"
?>

<?php
    $memory_ram = new memory_ram;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $memory_ram_name = $_POST['memory_ram_name'];
        $insert_memory_ram = $memory_ram -> insert_memory_ram($memory_ram_name);
    }
?>


<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>ADD Memory - Ram</h1>
                <form action="" method="POST">
                    <input name="memory_ram_name" type="text" placeholder="Nhap memory-ram " required>
                    <button type="submit">Add</button>
                </form>
            </div>           
        </div>
    </section>
</body>
</html>