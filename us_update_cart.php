<?php
session_start();
include('config.php');

if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id] = $quantity;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    echo json_encode(array("status" => "success", "cart" => $_SESSION['cart']));
} else {
    echo json_encode(array("status" => "error", "message" => "No quantity data received."));
}
?>