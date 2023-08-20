<?php
    include 'database.php';
?>
<?php
class danhgia {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_danhgia($danhgia_id, $product_id, $user_id, $name, $email, $rating, $comment, $created_at) {
        $query = "INSERT INTO danhgia (danhgia_id, product_id, user_id, name, email, rating, comment, created_at) 
                  VALUES ('$danhgia_id', '$product_id', '$user_id', '$name', '$email', '$rating', '$comment', '$created_at')";

        $result = $this->db->insert($query);
        // header('Location: coupon.php');
        return $result;
    }
    public function show_danhgia() {
        $query = "SELECT danhgia_id, name, rating, comment, created_at FROM danhgia ORDER BY danhgia_id ASC";
        $result = $this->db->select($query);

        return $result;
    }
}
?>