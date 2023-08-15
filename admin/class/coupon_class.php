<?php
    include 'database.php';

class coupon {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_coupon($id, $code, $amount, $expiry_date, $created_at) {
        $query = "INSERT INTO coupon (id, code, amount, expiry_date, created_at) 
                  VALUES ('$id', '$code', '$amount', '$expiry_date', '$created_at')";

        $result = $this->db->insert($query);
        // header('Location: coupon.php');
        return $result;
    }

    public function show_coupon() {
        $query = "SELECT id, code, amount, expiry_date, created_at FROM coupon ORDER BY id ASC";
        $result = $this->db->select($query);

        return $result;
    }

    public function get_coupon_by_id($id) {
        $query = "SELECT id, code, amount, expiry_date, created_at FROM coupon WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_coupon($id, $code, $amount, $expiry_date) {
        $query = "UPDATE coupon SET 
                  id = '$id',
                  code = '$code', 
                  amount = '$amount', 
                  expiry_date = '$expiry_date'  
                  WHERE id = '$id'";

        $result = $this->db->update($query);
        // header('Location: coupon.php');
        return $result;
    }

    public function delete_coupon($id) {
        $query = "DELETE FROM coupon WHERE id = '$id'";
        $result = $this->db->delete($query);
        header('Location: coupon.php');
        return $result;
    }
    // ... (Các phương thức khác)

    
}
?>
