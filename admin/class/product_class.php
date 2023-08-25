<?php
include 'database.php';
?>

<?php
class product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand()
    {
        //$query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC ";
        $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name
              FROM tbl_brand
              INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
              ORDER BY tbl_brand.brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_cartegory_main()
    {
        $query = "SELECT * FROM tbl_cartegory_main ORDER BY cartegory_main_id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_color()
    {
        $query = "SELECT * FROM tbl_color ORDER BY color_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Hàm để lấy danh sách các bộ nhớ RAM từ bảng tbl_memory_ram
    public function show_memory_ram()
    {
        $query = "SELECT * FROM tbl_memory_ram ORDER BY memory_ram_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
        FROM tbl_product
        INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
        INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
        INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
        ORDER BY tbl_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_product($post_data, $files_data)
    {
        $product_name = $post_data['product_name'];
        $cartegory_main_id = $post_data['cartegory_main_id'];
        $cartegory_id = $post_data['cartegory_id'];
        $brand_id = $post_data['brand_id'];
        $product_price = $post_data['product_price'];
        $product_price_sale = $post_data['product_price_sale'];
        $product_color = isset($_POST['product_color']) ? implode(', ', $_POST['product_color']) : '';
        $product_memory_ram = isset($_POST['product_memory_ram']) ? implode(', ', $_POST['product_memory_ram']) : '';
        $product_quantity = $post_data['product_quantity'];
        $product_intro = $post_data['product_intro'];
        $product_detail = $post_data['product_detail'];
        $product_accessory = $post_data['product_accessory'];
        $product_guarantee = $post_data['product_guarantee'];
        $product_img = $_FILES['product_img']['name'];
        move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);

        $query = "INSERT INTO tbl_product 
                (product_name, 
                cartegory_main_id,
                cartegory_id, 
                brand_id, 
                product_price, 
                product_price_sale, 
                product_color,
                product_memory_ram,
                product_quantity,
                product_intro,
                product_detail,
                product_accessory,
                product_guarantee,
                product_img) VALUES (
                    '$product_name', 
                    '$cartegory_main_id',
                    '$cartegory_id',
                    '$brand_id',
                    '$product_price',
                    '$product_price_sale',
                    '$product_color',
                    '$product_memory_ram',
                    '$product_quantity',
                    '$product_intro',
                    '$product_detail',
                    '$product_accessory',
                    '$product_guarantee',
                    '$product_img')";
        $result = $this->db->insert($query);
        if ($result) {
            $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            $result = $this->db->select($query)->fetch_assoc();
            $product_id = $result['product_id'];

            // Xử lý upload ảnh mô tả cho từng sản phẩm
            if (isset($_FILES['product_img_desc'])) {
                $product_img_descs = $_FILES['product_img_desc'];

                // Sử dụng vòng lặp để xử lý từng ảnh mô tả
                foreach ($product_img_descs['tmp_name'] as $key => $tmp_name) {
                    // Kiểm tra xem có lỗi upload không
                    if ($product_img_descs['error'][$key] === UPLOAD_ERR_OK) {
                        // Lấy tên và đường dẫn tạm thời của ảnh mô tả
                        $filename = $product_img_descs['name'][$key];
                        $filetmp = $product_img_descs['tmp_name'][$key];

                        // Upload ảnh mô tả vào thư mục "uploads"
                        move_uploaded_file($filetmp, "uploads/" . $filename);

                        // Thêm thông tin ảnh mô tả vào cơ sở dữ liệu
                        $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$filename')";
                        $this->db->insert($query);
                    }
                }
            }
        }

        header('Location: productlist.php');
        return $result;
    }

    public function getProductsByCategory($category)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
    FROM tbl_product
    INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
    INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
    INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
    WHERE tbl_cartegory.cartegory_name = '$category'
    ORDER BY tbl_product.product_id DESC";

        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_detail($product_id)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name
                      FROM tbl_product
                      INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                      INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                      WHERE tbl_product.product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product($product_id)
    {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_imgs_desc($product_id)
    {
        $query = "SELECT product_img_desc FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($post_data, $files_data, $product_id)
    {
        $product_name = $post_data['product_name'];
        $cartegory_id = $post_data['cartegory_id'];
        $brand_id = $post_data['brand_id'];
        $product_price = $post_data['product_price'];
        $product_price_sale = $post_data['product_price_sale'];
        $product_color = isset($_POST['product_color']) ? implode(', ', $_POST['product_color']) : '';
        $product_memory_ram = isset($_POST['product_memory_ram']) ? implode(', ', $_POST['product_memory_ram']) : '';
        $product_quantity = $post_data['product_quantity'];
        $product_intro = $post_data['product_intro'];
        $product_detail = $post_data['product_detail'];
        $product_accessory = $post_data['product_accessory'];
        $product_guarantee = $post_data['product_guarantee'];

        // Kiểm tra nếu người dùng đã chọn ảnh sản phẩm mới
        if (isset($files_data['product_img']['name']) && !empty($files_data['product_img']['name'])) {
            // Xóa ảnh sản phẩm cũ trước khi cập nhật ảnh mới
            $old_img_path = "uploads/" . $this->get_product_img_by_id($product_id);
            if (file_exists($old_img_path)) {
                unlink($old_img_path);
            }

            $product_img = $files_data['product_img']['name'];
            move_uploaded_file($files_data['product_img']['tmp_name'], "uploads/" . $files_data['product_img']['name']);
        } else {
            // Nếu người dùng không chọn ảnh mới, giữ nguyên ảnh cũ
            $product_img = $this->get_product_img_by_id($product_id);
        }

        // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
        $query = "UPDATE tbl_product 
              SET product_name = '$product_name',
                  cartegory_id = '$cartegory_id',
                  brand_id = '$brand_id',
                  product_price = '$product_price',
                  product_price_sale = '$product_price_sale',
                  product_color = '$product_color',
                  product_memory_ram = '$product_memory_ram',
                  product_quantity = '$product_quantity',
                  product_intro = '$product_intro',
                  product_detail = '$product_detail',
                  product_accessory = '$product_accessory',
                  product_guarantee = '$product_guarantee',
                  product_img = '$product_img'
              WHERE product_id = '$product_id'";

        $result = $this->db->update($query);

        // Xóa các ảnh mô tả cũ trước khi cập nhật các ảnh mô tả mới
        if (isset($files_data['product_img_desc']['name'][0]) && !empty($files_data['product_img_desc']['name'][0])) {
            $this->delete_product_imgs_desc_by_product_id($product_id);
        }

        // Lưu các ảnh mô tả mới vào cơ sở dữ liệu
        if (isset($files_data['product_img_desc'])) {
            $product_img_descs = $files_data['product_img_desc'];

            foreach ($product_img_descs['tmp_name'] as $key => $tmp_name) {
                // Kiểm tra xem có lỗi upload không
                if ($product_img_descs['error'][$key] === UPLOAD_ERR_OK) {
                    // Lấy tên và đường dẫn tạm thời của ảnh mô tả
                    $filename = $product_img_descs['name'][$key];
                    $filetmp = $product_img_descs['tmp_name'][$key];

                    // Upload ảnh mô tả vào thư mục "uploads"
                    move_uploaded_file($filetmp, "uploads/" . $filename);

                    // Thêm thông tin ảnh mô tả vào cơ sở dữ liệu
                    $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$filename')";
                    $this->db->insert($query);
                }
            }
        }

        header('Location: productlist.php');
        return $result;
    }



    public function get_product_img_by_id($product_id)
    {
        $query = "SELECT product_img FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['product_img'];
        }
        return '';
    }

    // Hàm xóa các ảnh mô tả theo product_id
    public function delete_product_imgs_desc_by_product_id($product_id)
    {
        $query = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'";
        $result = $this->db->delete($query);
    }


    public function delete_product($product_id)
    {
        $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->delete($query);
        header('Location: productlist.php');
        return $result;
    }

    //ham lay cartegory_id de show brand 
    public function get_brands_by_category($cartegory_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_cartegories_by_cartegory_main_id($cartegory_main_id)
    {
        $query = "SELECT * FROM tbl_cartegory WHERE cartegory_main_id = '$cartegory_main_id' ORDER BY cartegory_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_colors_by_product_id($product_id)
    {
        $query = "SELECT product_color FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query)->fetch_assoc();
        return explode(', ', $result['product_color']);
    }


    public function get_memory_rams_by_product_id($product_id)
    {
        $query = "SELECT product_memory_ram FROM tbl_product WHERE product_id = '$product_id'";
        $result = $this->db->select($query)->fetch_assoc();
        return explode(', ', $result['product_memory_ram']);
    }

    public function get_color_name_by_id($color_id)
    {
        $query = "SELECT color_name FROM tbl_color WHERE color_id = '$color_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['color_name'];
        }
        return '';
    }

    public function get_all_colors()
    {
        $query = "SELECT * FROM tbl_color";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_memory_ram_name_by_id($memory_ram_id)
    {
        $query = "SELECT memory_ram_name FROM tbl_memory_ram WHERE memory_ram_id = '$memory_ram_id'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['memory_ram_name'];
        }
        return '';
    }

    public function getProductIDByName($product_name)
    {
        $query = "SELECT product_id FROM tbl_product WHERE product_name = '$product_name'";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['product_id'];
        }
        return null;
    }

    public function showProductOptions()
    {
        $query = "SELECT product_id, product_name FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductsForPage($limit, $offset)
{
    $query = "SELECT p.*, c.cartegory_name, b.brand_name, cm.cartegory_main_name
              FROM tbl_product AS p
              INNER JOIN tbl_cartegory AS c ON p.cartegory_id = c.cartegory_id
              INNER JOIN tbl_brand AS b ON p.brand_id = b.brand_id
              INNER JOIN tbl_cartegory_main AS cm ON c.cartegory_main_id = cm.cartegory_main_id
              ORDER BY p.product_id DESC LIMIT $limit OFFSET $offset";

    $result = $this->db->select($query);
    return $result;
}


    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) as total FROM tbl_product";
        $result = $this->db->select($query)->fetch_assoc();
        return $result['total'];
    }

    public function getTotalProductsByCategory($category)
    {
        $query = "SELECT COUNT(*) as total FROM tbl_product
              INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
              WHERE tbl_cartegory.cartegory_name = '$category'";

        $result = $this->db->select($query)->fetch_assoc();
        return $result['total'];
    }

    public function searchProductsByName($search_query)
    {
        // Sử dụng câu truy vấn SQL để tìm kiếm sản phẩm theo tên
        $query = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search_query%'";

        // Sử dụng phương thức select của lớp Database để thực hiện truy vấn
        $result = $this->db->select($query);

        return $result;
    }

    // Hàm để lấy tổng số sản phẩm từ kết quả tìm kiếm
    public function getTotalSearchProducts($search_query)
    {
        $query = "SELECT COUNT(*) as total FROM tbl_product WHERE product_name LIKE '%$search_query%'";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getProductsByBrand($selectedBrand)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
    FROM tbl_product
    INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
    INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
    INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
    WHERE tbl_brand.brand_name = '$selectedBrand'
    ORDER BY tbl_product.product_id DESC";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalProductsByBrand($selectedBrand)
    {
        $query = "SELECT COUNT(*) as total FROM tbl_product
    INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
    WHERE tbl_brand.brand_name = '$selectedBrand'";

        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getProductsByPriceLowToHigh($limit, $offset)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
              FROM tbl_product
              INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
              INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
              INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
              ORDER BY tbl_product.product_price ASC
              LIMIT $limit OFFSET $offset";

        $result = $this->db->select($query);
        return $result;
    }

    public function getProductsByPriceHighToLow($limit, $offset)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
              FROM tbl_product
              INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
              INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
              INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
              ORDER BY tbl_product.product_price DESC
              LIMIT $limit OFFSET $offset";

        $result = $this->db->select($query);
        return $result;
    }

    public function getSimilarProductsByCategory($product_id) {
        $query = "SELECT * FROM tbl_product WHERE cartegory_id = (SELECT cartegory_id FROM tbl_product WHERE product_id = '$product_id') AND product_id != '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSimilarProductsByBrand($product_id) {
        $query = "SELECT * FROM tbl_product WHERE brand_id = (SELECT brand_id FROM tbl_product WHERE product_id = '$product_id') AND product_id != '$product_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_products_by_brand($brand_name) {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
                  FROM tbl_product
                  INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                  INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                  INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
                  WHERE tbl_brand.brand_name = '$brand_name'
                  ORDER BY tbl_product.product_id DESC";
    
        $result = $this->db->select($query);
        return $result;
    }

    //pagination admin
    public function getPaginatedProducts($page, $productsPerPage)
{
    // Tính toán offset dựa trên trang hiện tại và số lượng sản phẩm trên mỗi trang.
    $offset = ($page - 1) * $productsPerPage;

    // Sử dụng offset và limit (số lượng sản phẩm trên mỗi trang) trong truy vấn SQL.
    $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
        FROM tbl_product
        INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
        INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
        INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
        ORDER BY tbl_product.product_id DESC
        LIMIT $productsPerPage OFFSET $offset";

    $result = $this->db->select($query);
    return $result;
}
    
}


?> 