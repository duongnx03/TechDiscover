<?php
    include 'admin/database.php';

class coupon {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // public function insert_survey($web, $gia, $spcu) {
    //     $query = "INSERT INTO survey(web, gia, spcu) 
    //               VALUES ('$web', '$gia', '$spcu')";

    //     $result = $this->db->insert($query);
    //     return $result;
    // }
    public function get_random_coupon_code() {
        $query = "SELECT code FROM coupon ORDER BY RAND() LIMIT 1";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['code'];
        } else {
            return null; // Hoặc giá trị mặc định khác nếu không có dữ liệu
        }
    }
    
}
?>