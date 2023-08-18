<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/product_class.php";
?>

<?php
$product = new product;
$show_product = $product->show_product();
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Product List</h6>
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
                                <td><?php echo $result['product_color'] ?></td>
                                <td><?php echo $result['product_memory_ram'] ?></td>
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* ... */
</style>

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