<?php
    include 'database.php';
?>
<?php
    class product{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }
        
        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_brand(){
            //$query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC ";
              $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name
              FROM tbl_brand
              INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
              ORDER BY tbl_brand.brand_id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_product() {
            $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name
                      FROM tbl_product
                      INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                      INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                      ORDER BY tbl_product.product_id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_product(){
            $product_name = $_POST['product_name'];
            $cartegory_id = $_POST['cartegory_id'];
            $brand_id = $_POST['brand_id'];
            $product_price = $_POST['product_price'];
            $product_price_sale = $_POST['product_price_sale'];
            $product_desc = $_POST['product_desc'];
            $product_img = $_FILES['product_img']['name'];
            move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/".$_FILES['product_img']['name']);

            $query = "INSERT INTO tbl_product 
            (product_name, 
            cartegory_id, 
            brand_id, 
            product_price, 
            product_price_sale, 
            product_desc, 
            product_img) VALUES (
                '$product_name', 
                '$cartegory_id',
                '$brand_id',
                '$product_price',
                '$product_price_sale',
                '$product_desc',
                '$product_img')";
            $result = $this->db->insert($query);
            if($result){
                $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
                $result = $this->db->select($query)->fetch_assoc();
                $product_id = $result['product_id'];
                
                // Xử lý upload ảnh mô tả cho từng sản phẩm
                if(isset($_FILES['product_img_desc'])){
                    $product_img_descs = $_FILES['product_img_desc'];
                    
                    // Sử dụng vòng lặp để xử lý từng ảnh mô tả
                    foreach($product_img_descs['tmp_name'] as $key => $tmp_name){
                        // Kiểm tra xem có lỗi upload không
                        if($product_img_descs['error'][$key] === UPLOAD_ERR_OK){
                            // Lấy tên và đường dẫn tạm thời của ảnh mô tả
                            $filename = $product_img_descs['name'][$key];
                            $filetmp = $product_img_descs['tmp_name'][$key];
                            
                            // Upload ảnh mô tả vào thư mục "uploads"
                            move_uploaded_file($filetmp, "uploads/".$filename);
                            
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

        public function get_product($product_id){
            $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->select($query);
            return $result; 
        }

        public function get_product_imgs_desc($product_id) {
            $query = "SELECT product_img_desc FROM tbl_product_img_desc WHERE product_id = '$product_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($post_data, $files_data, $product_id){
            $product_name = $post_data['product_name'];
            $cartegory_id = $post_data['cartegory_id'];
            $brand_id = $post_data['brand_id'];
            $product_price = $post_data['product_price'];
            $product_price_sale = $post_data['product_price_sale'];
            $product_desc = $post_data['product_desc'];
            
            // Kiểm tra nếu người dùng đã chọn ảnh sản phẩm mới
            if(isset($files_data['product_img']['name']) && !empty($files_data['product_img']['name'])){
                // Xóa ảnh sản phẩm cũ trước khi cập nhật ảnh mới
                $old_img_path = "uploads/".$this->get_product_img_by_id($product_id);
                if(file_exists($old_img_path)){
                    unlink($old_img_path);
                }
        
                $product_img = $files_data['product_img']['name'];
                move_uploaded_file($files_data['product_img']['tmp_name'], "uploads/".$files_data['product_img']['name']);
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
                          product_desc = '$product_desc',
                          product_img = '$product_img'
                      WHERE product_id = '$product_id'";
            
            $result = $this->db->update($query);
        
            // Xóa các ảnh mô tả cũ trước khi cập nhật các ảnh mô tả mới
            $this->delete_product_imgs_desc_by_product_id($product_id);
        
            // Lưu các ảnh mô tả mới vào cơ sở dữ liệu
            $filename = $files_data['product_img_desc']['name'];
            $filetmp = $files_data['product_img_desc']['name'];
            foreach($filename as $key => $value){
                move_uploaded_file( $filetmp [$key], "uploads/".$value);
                $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$value')";
                $result = $this->db->insert($query);
            }
        
            header('Location: productlist.php');
            return $result; 
        }

        public function get_product_img_by_id($product_id){
    $query = "SELECT product_img FROM tbl_product WHERE product_id = '$product_id'";
    $result = $this->db->select($query);
    if($result){
        $row = $result->fetch_assoc();
        return $row['product_img'];
    }
    return '';
}

// Hàm xóa các ảnh mô tả theo product_id
public function delete_product_imgs_desc_by_product_id($product_id){
    $query = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'";
    $result = $this->db->delete($query);
}
        

        public function delete_product($product_id){
            $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->delete($query);
            header('Location: productlist.php');
            return $result; 
        }
         
        //ham lay cartegory_id de show brand co id do
        public function get_brands_by_category($cartegory_id) {
            $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->select($query);
            return $result;
        }
    }

   
?> 