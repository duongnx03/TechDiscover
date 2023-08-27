<?php
include "header.php";
include "navbar.php";

$order_query = "SELECT * FROM tbl_order where user_id = $user_id order by order_id desc";
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
            'delivery_time' => $row['delivery_time'],
            'total_order' => $row['total_order']
        );
    }
}
?>
<style>
    .return-details {
        display: none;
    }
</style>

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
                            <a href="myAccount_order.php" class="list-group-item list-group-item-action">Purchase</a>
                            <a href="myAccount_order_complete.php" class="list-group-item list-group-item-action active">Complete</a>
                            <a href="myAccount_order_cancel.php" class="list-group-item list-group-item-action">Cancel</a>
                            <a href="myAccount_order_return.php" class="list-group-item list-group-item-action">Return</a>
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
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $currentDate = date("Y-m-d");
                                if (!empty($orderItems)) {
                                    foreach ($orderItems as $item) {
                                        $order_id = $item['order_id'];
                                        if ($item['order_status'] == 'delivered') {
                                            $receivedDate = $item['delivery_time'];
                                            $daysPassed = floor((strtotime($currentDate) - strtotime($receivedDate)) / (60 * 60 * 24));
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
                                                    <b style="color: red;"><?php echo $item['order_status'] ?></b>
                                                </td>
                                                <td class="name-pr">
                                                    <b><?php echo $item['status_payment'] ?></b>
                                                </td>
                                                <td class="price-pr">
                                                    <p>$ <?php echo $item['total_order']; ?></p>
                                                </td>
                                                <td class="remove-pr">
                                                    <button class="btn btn-danger view-details" data-order-id="<?php echo $item['order_id']; ?>">View Details</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right">
                                                    <?php if ($daysPassed < 3) { ?>
                                                        <button class="btn btn-danger return-btn" data-order-id="<?php echo $item['order_id']; ?>">Return Order</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                <?php
                                        }
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
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Return Order</h5>
            </div>
            <div class="modal-body">
                <form id="returnForm" action="admin/process_return.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="order_id_input" name="order_id" value="<?php echo $order_id ?>">
                    <div id="returnProductsList"></div>
                    <!-- ... Other form fields ... -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="openSubmitBtn">Submit Return</button>
                    </div>
                </form>
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
                url: "admin/order_details.php",
                method: "GET",
                data: {
                    order_id: orderId
                },
                success: function(response) {
                    var modal = `
                        <div class="modal fade" id="orderDetailsModal${orderId}" tabindex="-1" aria-labelledby="orderDetailsModalLabel${orderId}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailsModalLabel${orderId}">Order Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ${response}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $("body").append(modal);
                    $(`#orderDetailsModal${orderId}`).modal("show");
                    $(`#orderDetailsModal${orderId}`).on("hidden.bs.modal", function() {
                        $(this).remove();
                    });
                },
                error: function() {
                    console.log("Error fetching order details.");
                }
            });
        });

        $(".return-btn").click(function() {
            var orderId = $(this).data("order-id");
            $("#order_id_input").val(orderId);

            // Make an AJAX request to fetch order items based on order_id
            $.ajax({
                url: "admin/checkbox_order_details.php",
                method: "GET",
                data: {
                    order_id: orderId
                },
                success: function(response) {
                    $("#returnProductsList").html(response);
                    $("#returnModal").modal("show");

                    // Attach event handler to checkboxes
                    $(".form-check-input").change(function() {
                        var isChecked = $(this).is(":checked");
                        var detailsContainer = $(this).closest(".form-check").find(".return-details");
                        if (isChecked) {
                            detailsContainer.show();
                        } else {
                            detailsContainer.hide();
                        }
                    });
                },
                error: function() {
                    console.log("Error fetching order items.");
                }
            });
        });
    });
</script>
<?php
include "footer.php";
?>