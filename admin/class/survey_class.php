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
         $timezone = new DateTimeZone('Asia/Ho_Chi_Minh'); // Tạo đối tượng múi giờ cho Việt Nam
        $current_date = new DateTime('now', $timezone); // Lấy thời gian hiện tại theo múi giờ Việt Nam

        // Truy vấn database để lấy một mã phiếu giảm giá ngẫu nhiên có thời hạn còn hiệu lực
        $query = "SELECT code, expiry_date FROM coupon WHERE expiry_date > ? ORDER BY RAND() LIMIT 1";
        $stmt = $this->db->link->prepare($query);
        $current_date_format = $current_date->format('Y-m-d H:i:s');
$stmt->bind_param("s", $current_date_format);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Chuyển đổi thời hạn của mã giảm giá thành đối tượng DateTime theo múi giờ Việt Nam
            $expiry_date = DateTime::createFromFormat('Y-m-d H:i:s', $row['expiry_date'], $timezone);

            if ($current_date < $expiry_date) {
                return $row['code']; // Trả về mã phiếu giảm giá ngẫu nhiên có thời hạn còn hiệu lực
            }
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