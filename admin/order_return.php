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
            <h6 class="mb-0">Order return</h6>
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
                        <th scope="col">Status Return</th>
                        <th scope="col">Details item to return</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($show_order) {
                        $i = 0;
                        while ($result = $show_order->fetch_assoc()) {
                            if ($result['order_status'] == 'return_order') {
                                $i++;
                    ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $result['order_id'] ?></td>
                                    <td class="info"><?php echo $result['fullname'] . ' | ' . $result['phone'] . ' | ' . $result['email'] . ' | ' . $result['address'] . ', ' . $result['ward'] . ', ' . $result['district'] . ', ' . $result['province'] ?></td>
                                    <td><?php echo $result['order_date'] ?></td>
                                    <td><?php echo $result['payment_method'] ?></td>
                                    <td class="status">
                                        <?php echo $result['order_status'] ?>
                                    </td>
                                    <td>$<?php echo $result['total_order'] ?></td>
                                    <td><?php echo $result['status_payment'] ?></td>
                                    <td style="color: red;"><?php echo $result['return_status'] ?></td>
                                    <td>
                                        <button class="btn btn-link view-details" data-order-id="<?php echo $result['order_id']; ?>">View Details Return</button>
                                    </td>
                                    <td>
                                        <?php if ($result['return_status'] === 'processing') { ?>
                                            <form action="process-accept-return.php" method="post">
                                                <input type="hidden" name="order_id" value="<?php echo $result['order_id'] ?>">
                                                <button class="btn btn-link">Accept</button>
                                            </form>
                                            <form action="process-cancel-return.php" method="post">
                                                <input type="hidden" name="order_id" value="<?php echo $result['order_id'] ?>">
                                                <button class="btn btn-link">Cancel</button>
                                            </form>
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
                url: "get_order_details_return.php",
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