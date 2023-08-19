<?php
include 'database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_user($email, $username, $password, $fullname, $address, $phone) {
        // Add code to hash the password before storing it into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, username, password, fullname, address, phone) 
                  VALUES ('$email', '$username', '$hashedPassword', '$fullname', '$address', '$phone')";

        $result = $this->db->insert($query);
        header('Location: userlist.php');
        return $result;
    }

    public function show_users() {
        $query = "SELECT id, email, username, password, fullname, address, phone, is_online FROM users ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_user_by_id($user_id) {
        $query = "SELECT id, email, username, password , fullname, address, phone FROM users WHERE id = '$user_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_user($user_id, $email, $username, $password, $fullname, $address, $phone) {
        // Add code to hash the password before updating it into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET 
                  email = '$email', 
                  username = '$username', 
                  password = '$hashedPassword', 
                  fullname = '$fullname', 
                  address = '$address', 
                  phone = '$phone' 
                  WHERE id = '$user_id'";

        $result = $this->db->update($query);

        return $result;
    }

    public function delete_user($user_id) {
        $query = "DELETE FROM users WHERE id = '$user_id'";
        $result = $this->db->delete($query);
        header('Location: userlist.php');
        return $result;
    }
    public function update_user_status($user_id, $is_online) {
        // Add code to update the user status
        $sql = "UPDATE users SET is_online = $is_online WHERE id = $user_id";
        $result = $this->db->update($sql);
        return $result;
    }
}
?>
