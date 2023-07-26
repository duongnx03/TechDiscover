<?php
include "header.php";
include "slider.php";
include "class/memory_ram_class.php";
?>

<?php
$memory_ram = new memory_ram;
if (!isset($_GET['memory_ram_id']) || $_GET['memory_ram_id'] == NULL) {
    echo "<script>window.location = 'memory_ramlist.php'</script>";
} else {
    $memory_ram_id = $_GET['memory_ram_id'];
}

$get_memory_ram = $memory_ram->get_memory_ram($memory_ram_id);

if ($get_memory_ram) {
    $result = $get_memory_ram->fetch_assoc();
}
?>

<?php
$memory_ram = new memory_ram;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Đảm bảo rằng biến $memory_ram_id đã được khai báo và có giá trị
    if (isset($_POST['memory_ram_id'])) {
        $memory_ram_id = $_POST['memory_ram_id'];
        $memory_ram_name = $_POST['memory_ram_name'];
        $update_memory_ram = $memory_ram->update_memory_ram($memory_ram_name, $memory_ram_id);
    }
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-category-add">
        <h1>Update Memory - Ram</h1>
        <form action="" method="POST">
            <!-- Đẩy giá trị của memory_ram_id vào form -->
            <input type="hidden" name="memory_ram_id" value="<?php echo $memory_ram_id; ?>">
            <input name="memory_ram_name" type="text" placeholder="Nhập tên danh mục" required value="<?php echo $result['memory_ram_name'] ?>">
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</section>
</body>

</html>
