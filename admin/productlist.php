<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/product_class.php";
?>

<?php
$product = new product;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$productsPerPage = 8; // Số lượng sản phẩm trên mỗi trang

// Tính tổng số sản phẩm
$totalProducts = $product->getTotalProducts();

// Tính tổng số trang dựa trên tổng số sản phẩm và số lượng sản phẩm trên mỗi trang
$totalPages = ceil($totalProducts / $productsPerPage);

// Đảm bảo trang hiện tại hợp lệ
if ($currentPage < 1 || $currentPage > $totalPages) {
    $currentPage = 1;
}

// Tính offset để lấy sản phẩm cho trang hiện tại
$offset = ($currentPage - 1) * $productsPerPage;

// Lấy danh sách sản phẩm phân trang
if (!empty($searchTerm)) {
    // Nếu có từ khóa tìm kiếm, sử dụng hàm tìm kiếm
    $show_product = $product->searchProductsByName($searchTerm);
    $totalProducts = $product->getTotalSearchProducts($searchTerm);
} else {
    // Ngược lại, lấy danh sách sản phẩm theo trang
    $show_product = $product->getPaginatedProducts($currentPage, $productsPerPage);
}

?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Product List</h6>
            <form class="d-none d-md-flex ms-4" method="GET" action="productlist.php">
                <input class="form-control bg-dark border-0" type="search" name="search" placeholder="Search">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <a href="productadd.php">ADD Product</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
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
                                    <img src="uploads/<?php echo $result['product_img'] ?>" alt="Product Image"
                                        style="max-width: 100px;">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Update</a>
                                    |
                                    <a class="btn btn-sm btn-primary" href="#"
                                        onclick="confirmDelete(<?php echo $result['product_id'] ?>)">Delete</a>
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
        </div><br>
        <div class="pagination-container">
            <div class="pagination">
                <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                    <a href="productlist.php?page=<?php echo $page; ?>&search=<?php echo $searchTerm; ?>"
                        class="<?php echo ($page === $currentPage) ? 'active' : ''; ?>"><?php echo $page; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Định dạng container chứa phân trang */
    .pagination-container {
        text-align: center;
        /* Căn giữa nội dung */
    }

    /* Định dạng nút phân trang */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        color: red;
        border: 1px solid red;
        margin: 2px;
        border-radius: 4px;
    }

    /* Định dạng nút phân trang hoạt động */
    .pagination a.active {
        background-color: red;
        color: white;
        border: 1px solid black;
    }

    /* Định dạng nút phân trang khi di chuột qua */
    .pagination a:hover {
        background-color: black;
        color: white;
    }
</style>

<script>
    function confirmDelete(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "productdelete.php?product_id=" + productId;
        }
    }
</script>

<?php include "footer.php"; ?>
