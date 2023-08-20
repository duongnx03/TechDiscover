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

    public function get_all_colors() {
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

    function Pagination($number, $page, $addition){
        if ($number >1){
            echo '<ul class="pagination">';			
            if($page>1){
                echo '<li class="page-item"><a class="page-link" href="?page='.($page-1).$addition.'">Previous</a></li>';
            }
    
            $avaiablePage = [1,$page-1,$page,$page+1,$number]; //mảng gồm trang đầu, trang cuối, trang hiện tại và 2 trang kế trang hiện tại 
            $isFirst = $isLast = false; // 2 biến này để kiếm tra có dấu ... trước và sau trang hiện tại chưa
            for($i=0; $i<$number; $i++){
                if(!in_array($i+1,$avaiablePage)){ //nếu không có trong mảng thì ra khỏi vòng for
                    if(!$isFirst && $page >3){//nếu chưa có dấu ... và số trang phải lớn hơn 3
                        echo'<li class="page-item"><a class="page-link" href="?page='.($page-2).$addition.'">...</a></li>';
                        $isFirst = true; //xác nhận đã có dấu ...
                    }
                    if(!$isLast && $i >$page){//nếu chưa có dấu ... và số trang phải lớn hơn 3
                        echo'<li class="page-item"><a class="page-link" href="?page='.($page+2).$addition.'">...</a></li>';
                        $isLast = true; //xác nhận đã có dấu ...
                    }
                    continue;
                }
                if($page==$i+1){
                    echo'<li class="page-item active"><a class="page-link" href="#">'.($i+1).'</a></li>';
                }else{
                    echo'<li class="page-item"><a class="page-link" href="?page='.($i+1).$addition.'">'.($i+1).'</a></li>';
                }		
            }
            if($page<$number){
                echo '<li class="page-item"><a class="page-link" href="?page='.($page+1).$addition.'">Next</a></li>';
            }
            echo '</ul>';    			
        
        }
    }

    public function getProductsForPage($limit, $offset)
    {
        $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name, tbl_cartegory_main.cartegory_main_name
        FROM tbl_product
        INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
        INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
        INNER JOIN tbl_cartegory_main ON tbl_cartegory.cartegory_main_id = tbl_cartegory_main.cartegory_main_id
        ORDER BY tbl_product.product_id DESC LIMIT $limit OFFSET $offset";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) as total FROM tbl_product";
        $result = $this->db->select($query)->fetch_assoc();
        return $result['total'];
    }
}


?> 