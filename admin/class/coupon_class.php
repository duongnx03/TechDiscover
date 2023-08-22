<?php
    include 'database.php';

class coupon {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_coupon($coupon_id, $code, $amount, $expiry_date, $created_at, $quantity) {
        $query = "INSERT INTO coupon (coupon_id, code, amount, expiry_date, created_at, quantity) 
                  VALUES ('$coupon_id', '$code', '$amount', '$expiry_date', '$created_at', '$quantity')";

        $result = $this->db->insert($query);
        // header('Location: coupon.php');
        return $result;
    }

    public function show_coupon() {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at, quantity FROM coupon ORDER BY coupon_id ASC";
        $result = $this->db->select($query);

        return $result;
    }

    public function get_coupon_by_id($coupon_id) {
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at, quantity FROM coupon WHERE coupon_id = '$coupon_id'";
        $result = $this->db->select($query);
        $rows = [];
        if ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows[0];
    }

    public function update_coupon($coupon_id, $code, $amount, $expiry_date, $quantity) {
        $query = "UPDATE coupon SET 
                  coupon_id = '$coupon_id',
                  code = '$code', 
                  amount = '$amount', 
                  expiry_date = '$expiry_date',
                  quantity = '$quantity'  
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
        $query = "SELECT coupon_id, code, amount, expiry_date, created_at, quantity FROM coupon WHERE code = '$code'";
        $result = $this->db->select($query);
        return $result;
    }

    
}
?>
