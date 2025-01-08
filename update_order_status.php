<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = "UPDATE order_tb SET status='$status' WHERE order_id='$order_id'";
    if (mysqli_query($conn, $query)) {
        echo "Order status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    header('Location: ad_order.php');
}
?>
