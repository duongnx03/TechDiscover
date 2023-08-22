<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/product_class.php";
?>

<?php
$product = new product;
$show_product = $product->show_product();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($searchTerm)) {
    $show_product = $product->searchProductsByName($searchTerm);
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Product List</h6>
            <form class="form-inline row" action="productlist.php" method="GET">
                <input class="form-control bg-dark border-0" type="search" placeholder="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> 
            <a href="productadd.php">ADD Product</a>          
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Promotional Price</th>
                        <th scope="col">Color</th>
                        <th scope="col">Memory-Capacity</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_product) {
                        $i = 0;
                        while ($result = $show_product->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['product_id'] ?></td>
                                <td><?php echo $result['product_name'] ?></td>
                                <td><?php echo $result['product_price'] ?></td>
                                <td><?php echo $result['product_price_sale'] ?></td>
                                <td>
                                    <?php
                                    $product_colors = $product->get_colors_by_product_id($result['product_id']);
                                    foreach ($product_colors as $color_id) {
                                        $color_name = $product->get_color_name_by_id($color_id);
                                        echo '<span class="badge badge-primary">' . $color_name . '</span> ';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $product_memory_rams = $product->get_memory_rams_by_product_id($result['product_id']);
                                    foreach ($product_memory_rams as $memory_ram_id) {
                                        $memory_ram_name = $product->get_memory_ram_name_by_id($memory_ram_id);
                                        echo '<span class="badge badge-primary">' . $memory_ram_name . '</span> ';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $result['product_quantity'] ?></td>
                                <td>
                                    <img src="uploads/<?php echo $result['product_img'] ?>" alt="Product Image" style="max-width: 100px;">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Update</a> |
                                    <a class="btn btn-sm btn-primary" href="#" onclick="confirmDelete(<?php echo $result['product_id'] ?>)">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="10">No products found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Function for product-delete
    function confirmDelete(product_id) {
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = 'productdelete.php?product_id=' + product_id;
        }
    }
</script>

<?php
include "footer.php";
?>
