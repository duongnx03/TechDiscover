<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/product_class.php";

$product = new product;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$productsPerPage = 8;

// Sắp xếp và bộ lọc
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';
$filterColor = isset($_GET['color']) ? $_GET['color'] : '';
$filterMemory = isset($_GET['memory']) ? $_GET['memory'] : '';

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
    // Ngược lại, lấy danh sách sản phẩm theo trang với sắp xếp và bộ lọc
    $show_product = $product->getPaginatedProducts($currentPage, $productsPerPage, $sortOption, $filterColor, $filterMemory);
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
        <form method="GET" action="productlist.php">
            <label for="sort">Sort by: </label>
            <select name="sort" id="sort">
                <option value="price_asc">NONE</option>
                <option value="price_asc">Prices go up</option>
                <option value="price_desc">Prices go down</option>
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name(Z-A)</option>
            </select>

            <label for="color">Filter by color:</label>
            <select name="color" id="color">
                <option value="">ALL</option>
                <option value="black">Black</option>
                <option value="blue">Blue</option>
                <option value="blue">White</option>
                <option value="blue">Sliver</option>
                <option value="blue">Gold</option>
                <!-- Thêm các tùy chọn màu sắc khác -->
            </select>

            <label for="memory">Filter by RAM:</label>
            <select name="memory" id="memory">
                <option value="">ALL</option>
                <option value="8GB">64GB</option>
                <option value="16GB">128GB</option>
                <option value="16GB">256GB</option>
                <option value="16GB">512GB</option>
                <option value="16GB">1TB</option>
                <!-- Thêm các tùy chọn dung lượng RAM khác -->
            </select>

            <input type="submit" value="Filter and Sort">
        </form><br>

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
                                    <img src="uploads/<?php echo $result['product_img'] ?>" alt="Product Image" style="max-width: 100px;">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Update</a>
                                    |
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
        </div><br>
        <?php if ($totalPages > 1) : ?>
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="productlist.php?page=1<?php echo (!empty($searchTerm)) ? '&search=' . $searchTerm : ''; ?>&sort=<?php echo $sortOption; ?>&color=<?php echo $filterColor; ?>&memory=<?php echo $filterMemory; ?>" aria-label="First">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="productlist.php?page=<?php echo $currentPage - 1; ?><?php echo (!empty($searchTerm)) ? '&search=' . $searchTerm : ''; ?>&sort=<?php echo $sortOption; ?>&color=<?php echo $filterColor; ?>&memory=<?php echo $filterMemory; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($currentPage == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="productlist.php?page=<?php echo $i; ?><?php echo (!empty($searchTerm)) ? '&search=' . $searchTerm : ''; ?>&sort=<?php echo $sortOption; ?>&color=<?php echo $filterColor; ?>&memory=<?php echo $filterMemory; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="productlist.php?page=<?php echo $currentPage + 1; ?><?php echo (!empty($searchTerm)) ? '&search=' . $searchTerm : ''; ?>&sort=<?php echo $sortOption; ?>&color=<?php echo $filterColor; ?>&memory=<?php echo $filterMemory; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="productlist.php?page=<?php echo $totalPages; ?><?php echo (!empty($searchTerm)) ? '&search=' . $searchTerm : ''; ?>&sort=<?php echo $sortOption; ?>&color=<?php echo $filterColor; ?>&memory=<?php echo $filterMemory; ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>

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