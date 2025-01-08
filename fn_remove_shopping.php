<?php
session_start();
include('config.php');

// ตรวจสอบว่ามีการตั้งค่าตะกร้าในเซสชั่น
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// ลบสินค้าจากตะกร้า
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// เปลี่ยนเส้นทางไปยังหน้า cart.php หลังจากลบสินค้า
header("Location: us_cart.php");
exit();
?>
