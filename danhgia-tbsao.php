<?php
class danhgia
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_danhgia($danhgia_id, $product_id, $user_id, $name, $email, $rating, $comment, $created_at)
    {
        $user_info_query = "SELECT fullname, email FROM users WHERE id = $user_id";
        $user_info_result = $this->db->select($user_info_query);
        $user_info = $user_info_result->fetch_assoc();

        $name = $user_info['fullname'];
        $email = $user_info['email'];
        $query = "INSERT INTO danhgia (danhgia_id, product_id, user_id, name, email, rating, comment, created_at) 
                  VALUES ('$danhgia_id', '$product_id', '$user_id', '$name', '$email', '$rating', '$comment', '$created_at')";

        $result = $this->db->insert($query);
        // header('Location: coupon.php');
        return $result;
    }
    public function show_danhgia()
    {
        $query = "SELECT danhgia_id, product_id, name, email, rating, comment, created_at FROM danhgia ORDER BY danhgia_id ASC";
        $result = $this->db->select($query);

        return $result;
    }
}
$danhgia = new danhgia();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'admin/database.php'; // Đảm bảo đường dẫn đúng

    $db = new Database();
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;
    $user_id = $_POST["user_id"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    $created_at = date('Y-m-d H:i:s');

    $user_id = $_SESSION['id'];
    // Kiểm tra xem người dùng đã submit đánh giá chưa cho sản phẩm này
    $submission_query = "SELECT danhgia_id FROM danhgia WHERE user_id = $user_id AND product_id = $product_id";
    $submission_result = $db->select($submission_query);
    if ($submission_result && $submission_result->num_rows > 0) {
        // Người dùng đã submit rồi, không thực hiện gì cả
        $hasSubmitted = true;
    } else {
        // Người dùng chưa submit, thực hiện lưu đánh giá mới
        $insert_result = $danhgia->insert_danhgia(null, $product_id, $user_id, '', '', $rating, $comment, $created_at);
        if ($insert_result) {
            $hasSubmitted = true;
        }
    }
}
$reviews = $danhgia->show_danhgia($product_id);
$reviewCount = 0;
$reviewArray = array();

if ($reviews) {
    // Truy vấn thành công
    $reviewArray = array_reverse(mysqli_fetch_all($reviews, MYSQLI_ASSOC));
    foreach ($reviewArray as $review) {
        // Chỉ đếm các đánh giá của sản phẩm có product_id trùng khớp
        if ($review['product_id'] == $product_id) {
            $reviewCount++;
        }
    }
}

?>
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
<style>

    div.stars {
        width: 270px;
        display: inline-block;
    }

    input.star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked~label.star:before {
        color: #F62;
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }

    span.star {
        color: #FFCC00;
    }
</style>
          <?php  if ($reviewCount > 0) {
    $totalRating = 0;

    foreach ($reviewArray as $review) {
        if ($review['product_id'] == $product_id) {
            $totalRating += intval($review['rating']);
        }
    }
    $averageRating = $totalRating / $reviewCount;
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $averageRating) {
            echo '<span class="star star-' . $i . '">&#9733;</span>';
        } else {
            echo '<span class="star star-' . $i . '">&#9734;</span>';
        }
    }

    echo "</p>";
}?>