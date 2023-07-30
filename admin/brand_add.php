<?php
    include "header.php";
    include "slider.php";
    include "class/brand_class.php"
?>

<?php
    $brand = new brand;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $cartegory_main_id = $_POST['cartegory_main_id'];
        $cartegory_id = $_POST['cartegory_id'];
        $brand_name = $_POST['brand_name'];
        $insert_brand = $brand->insert_brand($cartegory_main_id, $cartegory_id, $brand_name);
    }
?>

<style>
    select {
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-category-add">
        <h1>ADD Brand</h1>
        <form action="" method="POST">
            <select name="cartegory_main_id" id="cartegory_main_select" required>
                <option value="">-- Select Category Main --</option>
                <?php
                $show_cartegory_main = $brand->show_cartegory_main();
                if ($show_cartegory_main) {
                    while ($result = $show_cartegory_main->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result['cartegory_main_id'] ?>"><?php echo $result['cartegory_main_name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <br>
            <select name="cartegory_id" id="cartegory_select" required>
                <option value="">-- Select Category --</option>
            </select>
            <br>
            <input required name="brand_name" type="text" placeholder="Enter Brand Name">
            <button type="submit">ADD</button>
        </form>
    </div>
</div>

<script>
    // Get the select element
    var cartegoryMainSelect = document.getElementById("cartegory_main_select");
    var cartegorySelect = document.getElementById("cartegory_select");

    // Add event listener to update the cartegory options when cartegory main is selected
    cartegoryMainSelect.addEventListener("change", function () {
    var cartegoryMainId = this.value;
    // Send an AJAX request to get cartegory options based on selected cartegory main
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            cartegorySelect.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "get_cartegories_by_cartegory_main_id.php?cartegory_main_id=" + cartegoryMainId, true);
    xhttp.send();
});
</script>

</section>
</body>
</html>
