<?php
session_start();
include('config.php'); // Connect to database

$response = array('status' => 'error');

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Check if the cart is already in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Add product to cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    $response['status'] = 'success';
    
    // Redirect back to the previous page
    header("Location: us_home.php");
    exit();
}

echo json_encode($response);
?>
