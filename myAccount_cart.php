<?php
include "header.php";
include "navbar.php";

$order_query = "SELECT * FROM tbl_order where user_id = $user_id";
$order_result = $database->select($order_query);
if ($order_result) {
    while ($row = $order_result->fetch_assoc()) {
        $orderItems[] = array(
            'order_id' => $row['order_id'],
            'order_date' => $row['order_date'],
            'payment_method' => $row['payment_method'],
            'order_status' => $row['order_status'],
            'fullname' => $row['fullname'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'province' => $row['province'],
            'district' => $row['district'],
            'ward' => $row['ward'],
            'address' => $row['address'],
            'status_payment' => $row['status_payment'],
            'total_order' => $row['total_order']
        );
    }
}
?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>My Account</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Purchase Order</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            <a href="#" class="list-group-item list-group-item-action active">Purchase</a>
                            <a href="#" class="list-group-item list-group-item-action">Complete</a>
                            <a href="#" class="list-group-item list-group-item-action">Cancelled</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Receiver's Information</th>
                                    <th>Payment Method</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($orderItems)) {
                                    foreach ($orderItems as $item) {
                                ?>
                                        <tr>
                                            <td class="info">
                                                <?php echo '<b>Name:</b> ' . $item['fullname'] . ' <br> <b>Phone:</b> ' . $item['phone'] . ' <br> <b>Email:</b> ' . $item['email'] . ' <br> <b>Address:</b> ' . $item['address'] . ', ' . $item['ward'] . ', <br> ' . $item['district'] . ', ' . $item['province'] ?>
                                            </td>
                                            <td class="name-pr">
                                                <b><?php echo $item['payment_method'] ?></b>
                                            </td>
                                            <td class="name-pr">
                                                <b><?php echo $item['order_date'] ?></b>
                                            </td>
                                            <td class="name-pr">
                                                <b><?php echo $item['order_status'] ?></b>
                                            </td>
                                            <td class="name-pr">
                                                <b><?php echo $item['status_payment'] ?></b>
                                            </td>
                                            <td class="price-pr">
                                                <p>$ <?php echo number_format($item['total_order']); ?></p>
                                            </td>
                                            <td class="remove-pr">
                                                <button class="btn btn-primary view-details" data-order-id="<?php echo $item['order_id']; ?>">View Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                           <td colspan="7" align="right">
                                                <button class="btn btn-primary view-details" data-order-id="<?php echo $item['order_id']; ?>">Cancel Order</button>
                                                <button class="btn btn-primary view-details" data-order-id="<?php echo $item['order_id']; ?>">Received Order</button>
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
        </div>
    </div>
</div>
<!-- End Shop Page -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle click event for the "View Details" button
        $(".view-details").click(function() {
            var orderId = $(this).data("order-id");

            // Make an AJAX request to fetch the details from get_order_details.php
            $.ajax({
                url: "../admin/order_details.php",
                method: "GET",
                data: {
                    order_id: orderId
                },
                success: function(response) {
                    // Create a Bootstrap modal
                    var modal = `
                    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${response}
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                    // Append the modal to the body and show it
                    $("body").append(modal);
                    $("#orderDetailsModal").modal("show");
                },
                error: function() {
                    console.log("Error fetching order details.");
                }
            });
        });
    });
</script>
<?php
include "footer.php";
?>