<?php
if (isset($_POST['shippingMethod'])) {
    $selectedShipping = $_POST['shippingMethod'];
    
    $shippingCosts = array(
        'Standard Delivery' => '$ 0',
        'Express Delivery' => '$ 10',
        'Next Business day' => '$ 20'
    );

    $shippingCost = isset($shippingCosts[$selectedShipping]) ? $shippingCosts[$selectedShipping] : 'N/A';

    echo $shippingCost;
} else {
    echo 'N/A';
}
?>