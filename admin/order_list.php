<?php
include "header.php";
include "sidebar.php";
include "navbar.php";
include "class/order_class.php";
$order = new order;
$show_order = $order->show_order_list();
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Order User List</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">User Info</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total Order</th>
                        <th scope="col">Status Payment</th>
                        <th scope="col">Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_order) {
                        $i = 0;
                        while ($result = $show_order->fetch_assoc()) {
                            if ($result['order_status'] == 'order_processing') {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['order_id'] ?></td>
                                <td class="info"><?php echo $result['fullname'] . ' | ' . $result['phone'] . ' | ' . $result['email'] . ' | ' . $result['address'] . ', ' . $result['ward'] . ', ' . $result['district'] . ', ' . $result['province'] ?></td>
                                <td><?php echo $result['order_date'] ?></td>
                                <td><?php echo $result['payment_method'] ?></td>
                                <td class="status">
                                    <form action="order_edit.php?order_id=<?php echo $result['order_id'] ?>" method="post">
                                        <select name="order_status" class="form-select">
                                            <option value="order_processing" <?php if ($result['order_status'] == 'order_processing') echo 'selected' ?>>Order processing</option>
                                            <option value="delivered_carrier" <?php if ($result['order_status'] == 'delivered_carrier') echo 'selected' ?>>Delivered to the carrier</option>
                                            <option value="delivered" <?php if ($result['order_status'] == 'delivered') echo 'selected' ?>>Delivered</option>
                                        </select>
                                        <button type="submit" class="btn btn-link view-details">UPDATE</button>
                                    </form>
                                </td>
                                <td>$<?php echo $result['total_order'] ?></td>
                                <td><?php echo $result['status_payment'] ?></td>
                                <td>
                                    <button class="btn btn-link view-details" data-order-id="<?php echo $result['order_id']; ?>">View Details</button>
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
<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle click event for the "View Details" button
        $(".view-details").click(function() {
            var orderId = $(this).data("order-id");

            // Make an AJAX request to fetch the details from get_order_details.php
            $.ajax({
                url: "get_order_details.php",
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
    });
</script>