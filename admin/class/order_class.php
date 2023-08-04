<?php
    include 'database.php';
?>
<?php
    class order {
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }

        public function show_order_list() {
            $query = "SELECT * FROM tbl_order ORDER BY order_id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_order_list($order_id){
            $query = "DELETE FROM tbl_order WHERE order_id = '$order_id'";
            $result = $this->db->delete($query);
            header('Location: order_list.php');
            return $result; 
        }

        public function update_order_list($order_id, $order_status){
            $query = "UPDATE tbl_order SET order_status = '$order_status' WHERE order_id = '$order_id'";
            $result = $this->db->update($query);
            header('Location: order_list.php');
            return $result; 
        }
    }

   
?> 