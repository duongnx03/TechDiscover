<?php
    include 'admin/database.php';

class coupon {
    private $db;
    private $conn;
    public function __construct() {
        $this->db = new Database();
    }

    // public function insert_survey($web, $gia, $spcu) {
    //     $query = "INSERT INTO survey(web, gia, spcu) 
    //               VALUES ('$web', '$gia', '$spcu')";

    //     $result = $this->db->insert($query);
    //     return $result;
    // }
    public function get_valid_coupon_code() {
        $current_date = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
    
        // Truy vấn database để lấy một mã phiếu giảm giá ngẫu nhiên có thời hạn còn hiệu lực
        $query = "SELECT code FROM coupon WHERE expiry_date > '$current_date' ORDER BY RAND() LIMIT 1";
        $result = $this->db->select($query);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['code']; // Trả về mã phiếu giảm giá ngẫu nhiên có thời hạn còn hiệu lực
        }
    
        return null; // Trả về null nếu không có mã phiếu giảm giá nào thỏa điều kiện
    }
    public function get_coupon_quantity($coupon_id) {
        $query = "SELECT quantity FROM coupon WHERE coupon_id = ?";
        $stmt = $this->db->link->prepare($query);
        $stmt->bind_param("i", $coupon_id);
        $stmt->execute();
        $stmt->bind_result($quantity);
        $stmt->fetch();
        $stmt->close();
        return $quantity;
    }

    // Cập nhật số lượng của mã giảm giá
    public function update_coupon_quantity($coupon_id, $quantity) {
        $query = "UPDATE coupon SET quantity = ? WHERE coupon_id = ?";
        $stmt = $this->db->link->prepare($query);
        $stmt->bind_param("i", $coupon_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function get_coupon_by_id($coupon_id) {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at, quantity FROM coupon WHERE coupon_id = '$coupon_id'";
        $result = $this->db->select($query);
        return $result;
    }    
}
?>