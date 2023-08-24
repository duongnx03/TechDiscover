<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/blog_class.php";
?>

<?php
$blog = new Blog;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$show_blogs = (!empty($searchTerm)) ? $blog->searchBlogsByTitle($searchTerm) : $blog->show_blog();
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Blog List</h6>
            <form class="form-inline row" action="bloglist.php" method="GET">
                <input class="form-control bg-dark border-0" type="search" placeholder="Search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="blogadd.php">ADD Blog</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
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
                                <td><?php echo $result['blog_id'] ?></td>
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
        </div>
    </div>
</div>

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
