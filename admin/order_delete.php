<?php
    include "class/order_class.php";
    $order = new order;

    if(!isset($_GET['order_id']) || $_GET['order_id'] == NULL){
        echo "<script>window.location = 'order_list.php'</script>";
     }else{
         $order_id = $_GET['order_id'];
     }
 
     $get_order = $order -> delete_order_list($order_id);
?>