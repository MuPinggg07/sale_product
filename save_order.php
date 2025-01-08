<?php
session_start();
$_SESSION['cart'] = array(); // เคลียร์ตะกร้า
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // หากไม่มีการเข้าสู่ระบบ รีไดเรกต์ไปหน้า login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจาก POST
    $cart = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];
    $total = isset($_POST['total']) ? $_POST['total'] : 0;
    $reservation_time = isset($_POST['reservation_time']) ? $_POST['reservation_time'] : '';
    $user_id = $_SESSION['user_id'];

    if (empty($cart) || empty($total) || empty($reservation_time)) {
        header('Location: us_home.php');  // หากข้อมูลไม่ครบ รีไดเรกต์ไปหน้า us_home.php
        exit();
    }

    // ตรวจสอบการอัปโหลดรูปหลักฐานการชำระเงิน
    if (!isset($_FILES['payment_proof_image']) || $_FILES['payment_proof_image']['error'] != UPLOAD_ERR_OK) {
        header('Location: us_home.php');  // หากมีข้อผิดพลาดในการอัปโหลด รีไดเรกต์ไปหน้า us_home.php
        exit();
    }

    // ตั้งชื่อไฟล์ที่ปลอดภัย
    $upload_dir = 'payment_proof_image/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_extension = pathinfo($_FILES['payment_proof_image']['name'], PATHINFO_EXTENSION);
    $payment_proof_image = uniqid('proof_') . '.' . $file_extension;

    if (!move_uploaded_file($_FILES['payment_proof_image']['tmp_name'], $upload_dir . $payment_proof_image)) {
        header('Location: us_home.php');  // หากอัปโหลดไฟล์ไม่สำเร็จ รีไดเรกต์ไปหน้า us_home.php
        exit();
    }

    // เตรียมข้อมูลสินค้า
    $product_ids = array_keys($cart);
    $product_ids_json = json_encode($cart);
    $product_names = [];

    $product_query = "SELECT product_id, product_name FROM product_tb WHERE product_id IN (" . implode(",", array_map('intval', $product_ids)) . ")";
    $product_result = $conn->query($product_query);

    if ($product_result) {
        while ($row = $product_result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $quantity = $cart[$product_id];
            $product_names[] = $row['product_name'] . ' x' . $quantity;
        }
    } else {
        header('Location: us_home.php');  // หากมีข้อผิดพลาดในการดึงข้อมูลสินค้าจากฐานข้อมูล รีไดเรกต์
        exit();
    }

    // เตรียมข้อมูลมุก (ถ้ามี)
    $mook_ids = isset($_POST['mook_ids']) ? json_decode($_POST['mook_ids'], true) : [];
    $mook_names = [];
    if (!empty($mook_ids)) {
        $mook_query = "SELECT mook_id, mook_name FROM mook_tb WHERE mook_id IN (" . implode(",", array_map('intval', $mook_ids)) . ")";
        $mook_result = $conn->query($mook_query);

        if ($mook_result) {
            while ($row = $mook_result->fetch_assoc()) {
                $mook_names[] = $row['mook_name'];
            }
        } else {
            header('Location: us_home.php');  // รีไดเรกต์หากมีข้อผิดพลาดในการดึงข้อมูลมุก
            exit();
        }
    }

    // รวมชื่อสินค้าและมุก
    $product_names_str = implode(', ', $product_names);
    $mook_names_str = implode(', ', $mook_names);
    $order_status = 'wait';

    // เพิ่มคำสั่งซื้อในฐานข้อมูล
    $sql_order_tb = "
        INSERT INTO order_tb 
        (user_id, product_details, total, reservation_time, payment_proof_image, order_status, product_name, mook_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt_order_tb = $conn->prepare($sql_order_tb);

    if (!$stmt_order_tb) {
        header('Location: us_home.php');  // หากไม่สามารถเตรียมคำสั่ง SQL รีไดเรกต์ไปหน้า us_home.php
        exit();
    }

    $stmt_order_tb->bind_param(
        "ssisssss",
        $user_id,
        $product_ids_json,
        $total,
        $reservation_time,
        $payment_proof_image,
        $order_status,
        $product_names_str,
        $mook_names_str
    );

    if ($stmt_order_tb->execute()) {
        header('Location: us_home.php');  // รีไดเรกต์ไปหน้า us_home.php เมื่อบันทึกสำเร็จ
        exit();
    } else {
        header('Location: us_home.php');  // รีไดเรกต์หากเกิดข้อผิดพลาดในการบันทึกคำสั่งซื้อ
        exit();
    }

    $stmt_order_tb->close();
    $conn->close();
    exit();
}
?>
