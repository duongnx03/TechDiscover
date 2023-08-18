<?php
    include 'database.php';

class coupon {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_coupon($coupon_id, $code, $amount, $expiry_date, $created_at) {
        $query = "INSERT INTO coupon (coupon_id, code, amount, expiry_date, created_at) 
                  VALUES ('$coupon_id', '$code', '$amount', '$expiry_date', '$created_at')";

        $result = $this->db->insert($query);
        // header('Location: coupon.php');
        return $result;
    }

    public function show_coupon() {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at FROM coupon ORDER BY coupon_id ASC";
        $result = $this->db->select($query);

        return $result;
    }

    public function get_coupon_by_id($coupon_id) {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at FROM coupon WHERE coupon_id = '$coupon_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_coupon($coupon_id, $code, $amount, $expiry_date) {
        $query = "UPDATE coupon SET 
                  coupon_id = '$coupon_id',
                  code = '$code', 
                  amount = '$amount', 
                  expiry_date = '$expiry_date'  
                  WHERE coupon_id = '$coupon_id'";

        $result = $this->db->update($query);
        // header('Location: coupon.php');
        return $result;
    }

    public function delete_coupon($coupon_id) {
        $query = "DELETE FROM coupon WHERE coupon_id = '$coupon_id'";
        $result = $this->db->delete($query);
        header('Location: coupon.php');
        return $result;
    }
    // ... (Các phương thức khác)

    public function get_coupon_by_code($code) {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at FROM coupon WHERE code = '$code'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>
