<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/order_class.php";
?>

<?php
$order = new order;
$show_order = $order->show_order_list();
$result = '';
if (isset($_SESSION["order_result"])) {
    $result = $_SESSION["order_result"];
    unset($_SESSION["order_result"]);
    echo "<script>
            alert('$result');
        </script>";
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Order User List</h6>
            <a href="#">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">User Info</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_order) {
                        $i = 0;
                        while ($result = $show_order->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td class="info"><?php echo $result['user_info'] ?></td>
                                <td><?php echo $result['order_date'] ?></td>
                                <td><?php echo $result['payment_method'] ?></td>
                                <td class="status">
                                    <form action="order_edit.php?order_id=<?php echo $result['order_id'] ?>" method="post">
                                        <select name="order_status">
                                            <option value="order_processing" <?php if ($result['order_status'] == 'order_processing') echo 'selected' ?>>Order processing</option>
                                            <!-- Thêm các option khác tương tự -->
                                        </select>
                                        <button type="submit">UPDATE</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="#" onclick="confirmDelete(<?php echo $result['order_id'] ?>)">Delete</a>
                                </td>
                                <td>
                                    <a href="order_details.php?order_id=<?php echo $result['order_id'] ?>">Details</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Function for order-delete
    function confirmDelete(order_id) {
        if (confirm('Are you sure you want to delete this order list?')) {
            window.location.href = 'order_delete.php?order_id=' + order_id;
        }
    }
</script>

<?php
include "footer.php";
?>
