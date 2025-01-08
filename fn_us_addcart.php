<?php
session_start();
include('config.php'); // เชื่อมต่อกับฐานข้อมูล

$response = array('status' => 'error');

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // ตรวจสอบว่าตะกร้าสินค้าอยู่ในเซสชันหรือไม่
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // เพิ่มสินค้าไปยังตะกร้า
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    $response['status'] = 'success';
}

echo json_encode($response);
?>