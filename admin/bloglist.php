<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/blog_class.php";
?>

<?php
$blog = new Blog;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$totalBlogs = $blog->countBlogs();
$blogsPerPage = 6;
$totalPages = ceil($totalBlogs / $blogsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($currentPage < 1 || $currentPage > $totalPages) {
    $currentPage = 1; // Đảm bảo trang hiện tại hợp lệ
}

$offset = ($currentPage - 1) * $blogsPerPage;
$show_blogs = (!empty($searchTerm)) ? $blog->searchBlogsByTitle($searchTerm) : $blog->getBlogsPaginated($offset, $blogsPerPage);
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Blog List</h6>
            <form class="d-none d-md-flex ms-4" method="GET" action="bloglist.php">
                <input class="form-control bg-dark border-0" type="search" name="search" placeholder="Search by Title">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <a href="blog_add.php">ADD Blog</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">Blog Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Author</th>
                        <th scope="col">Content</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_blogs->num_rows > 0) {
                        $i = 0;
                        while ($result = $show_blogs->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo htmlspecialchars($result['blog_title']) ?></td>
                                <td><?php echo $result['blog_date'] ?></td>
                                <td><?php echo htmlspecialchars($result['blog_author']) ?></td>
                                <td><?php echo substr(strip_tags($result['blog_content']), 0, 100) . '...' ?></td>
                                <td><?php echo htmlspecialchars($result['blog_tags']) ?></td>
                                <td>
                                    <img src="uploads/<?php echo $result['blog_image'] ?>" alt="Blog Image" style="max-width: 100px;">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="blogedit.php?blog_id=<?php echo $result['blog_id'] ?>">Update</a> |
                                    <a class="btn btn-sm btn-primary" href="#" onclick="confirmDelete(<?php echo $result['blog_id'] ?>)">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9">No blogs found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div><br>
        <div class="pagination-container">
            <div class="pagination">
                <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                    <a href="bloglist.php?page=<?php echo $page; ?>&search=<?php echo $searchTerm; ?>" class="<?php echo ($page === $currentPage) ? 'active' : ''; ?>"><?php echo $page; ?></a>
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
    // Function for blog-delete
    function confirmDelete(blog_id) {
        if (confirm('Are you sure you want to delete this blog?')) {
            window.location.href = 'blogdelete.php?blog_id=' + blog_id;
        }
    }
</script>

<?php
include "footer.php";
?>