<?php
include 'database.php';

class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function show_categories()
    {
        // Giữ lại phương thức hiển thị danh mục blog nếu cần
        $query = "SELECT * FROM tbl_blog_category ORDER BY blog_cate_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_blog($blog_id)
    {
        $query = "SELECT * FROM tbl_blog WHERE blog_id = '$blog_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCategories()
    {
        $query = "SELECT * FROM tbl_blog_category";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBlogsByCategory($category_id, $limit)
    {
        $query = "SELECT * FROM tbl_blog WHERE blog_cate_id = '$category_id' ORDER BY blog_id DESC LIMIT $limit";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_blog()
    {
        // Giữ lại phương thức hiển thị blog nếu cần
        $query = "SELECT * FROM tbl_blog ORDER BY blog_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_blog($post_data)
    {
        // Sửa lại hàm thêm blog dựa trên dữ liệu đầu vào
        // Bạn cần thay đổi tên bảng và tên cột dựa trên cấu trúc của bảng tbl_blog
        $blog_title = $post_data['blog_title'];
        $blog_cate_id = $post_data['blog_cate_id'];
        $blog_author = $post_data['blog_author'];
        $blog_date = $post_data['blog_date'];
        $blog_content = $post_data['blog_content'];
        $blog_tags = $post_data['blog_tags'];
        $blog_image = $_FILES['blog_image']['name'];
        move_uploaded_file($_FILES['blog_image']['tmp_name'], "uploads/" . $_FILES['blog_image']['name']);

        $query = "INSERT INTO tbl_blog 
            (blog_title, blog_cate_id, blog_author, blog_date, blog_content, blog_tags, blog_image) 
            VALUES ('$blog_title', '$blog_cate_id', '$blog_author', '$blog_date', '$blog_content', '$blog_tags', '$blog_image')";
        $result = $this->db->insert($query);
        header('Location: bloglist.php');
        return $result;
    }

    public function get_blog_detail($blog_id)
    {
        // Giữ lại phương thức lấy chi tiết blog nếu cần
        $query = "SELECT * FROM tbl_blog WHERE blog_id = '$blog_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_blog($post_data, $blog_id)
    {
        $blog_title = $post_data['blog_title'];
        $blog_cate_id = $post_data['blog_cate_id'];
        $blog_author = $post_data['blog_author'];
        $blog_date = $post_data['blog_date'];
        $blog_content = $post_data['blog_content'];
        $blog_tags = $post_data['blog_tags'];

        // Lấy tên file ảnh hiện tại của blog
        $current_blog_image = $this->get_blog_image_by_id($blog_id);

        // Kiểm tra nếu người dùng đã chọn ảnh mới
        if (isset($_FILES['blog_image']['name']) && !empty($_FILES['blog_image']['name'])) {
            // Xóa ảnh blog cũ trước khi cập nhật ảnh mới
            $old_img_path = "uploads/" . $current_blog_image;
            if (file_exists($old_img_path)) {
                unlink($old_img_path);
            }

            // Tải lên ảnh mới
            $blog_image = $_FILES['blog_image']['name'];
            move_uploaded_file($_FILES['blog_image']['tmp_name'], "uploads/" . $_FILES['blog_image']['name']);
        } else {
            // Nếu người dùng không chọn ảnh mới, giữ nguyên tên ảnh cũ
            $blog_image = $current_blog_image;
        }


        $query = "UPDATE tbl_blog SET 
              blog_title = '$blog_title',
              blog_cate_id = '$blog_cate_id', 
              blog_date = '$blog_date', 
              blog_author = '$blog_author', 
              blog_content = '$blog_content', 
              blog_tags = '$blog_tags',
              blog_image = '$blog_image'
          WHERE blog_id = '$blog_id'";

        $result = $this->db->update($query);
        header('Location: bloglist.php');
        return $result;
    }
    public function delete_blog($blog_id)
    {
        // Giữ lại phương thức xóa blog nếu cần
        $query = "DELETE FROM tbl_blog WHERE blog_id = '$blog_id'";
        $result = $this->db->delete($query);
        header('Location: bloglist.php');
        return $result;
    }

    public function get_blog_image_by_id($blog_id)
    {
        // Giữ lại phương thức lấy hình ảnh của blog nếu cần
        $query = "SELECT blog_image FROM tbl_blog WHERE blog_id = '$blog_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['blog_image'];
        }
        return '';
    }

    public function searchBlogsByTitle($searchTerm)
    {
        // Sửa lại câu truy vấn để tìm kiếm blog theo tiêu đề
        $query = "SELECT * FROM tbl_blog WHERE blog_title LIKE '%$searchTerm%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function countBlogs()
    {
        $query = "SELECT COUNT(*) AS total FROM tbl_blog"; // Điều chỉnh bảng tên nếu cần
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function getBlogsPaginated($offset, $limit)
    {
        $query = "SELECT * FROM tbl_blog ORDER BY blog_id DESC LIMIT $offset, $limit";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCategoryNameById($category_id)
    {
        $query = "SELECT blog_cate_name FROM tbl_blog_category WHERE blog_cate_id = '$category_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['blog_cate_name'];
        }
        return '';
    }

    public function getRelatedBlogs($blogId, $limit = 8)
    {
        $query = "SELECT * FROM tbl_blog WHERE blog_id != '$blogId' ORDER BY RAND() LIMIT $limit";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCommentsByBlogId($blogId)
    {
        $query = "SELECT * FROM tbl_comments WHERE blog_id = '$blogId' ORDER BY comment_date DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
