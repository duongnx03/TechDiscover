<?php
include "database.php";
$db = new Database;
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $query = "select * from tbl_order_items where order_id = $order_id";
    $result = $db->select($query);
}
?>

<style>
    /* Custom CSS styles for the table */
    .table {
        background-color: white;
    }

    .table thead th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }
    .modal-dialog {
        max-width: 80%; /* Adjust the width as needed */
    }

    .modal-body {
        padding: 20px;
    }

    .modal-title {
        font-size: 18px;
    }

    .order-details-table {
        width: 100%;
    }

    .order-details-table th,
    .order-details-table td {
        padding: 10px;
    }

    .order-details-table th {
        background-color: #f2f2f2;
    }
</style>

<div class="container pt-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Item List</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Ram</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><img src="../admin/uploads/<?php echo $row['product_img'] ?>" alt="Product Image" style="max-width: 100px;"></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><?php echo $row['product_color'] ?></td>
                                <td><?php echo $row['product_memory_ram'] ?></td>
                                <td><?php echo $row['quantity'] ?></td>
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