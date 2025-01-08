<?php
include('config.php');

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_detail = $_POST['product_detail'];
$product_price = $_POST['product_price'];
$product_type_id = $_POST['product_type_id'];

// ตรวจสอบว่าประเภทสินค้าถูกเลือก
if ($product_type_id == 0) {
    echo "
        <script>
            alert('กรุณาเลือกประเภทสินค้่า');
            history.back();
        </script>
    ";
} else {
    // เตรียมคำสั่ง SQL เพื่ออัปเดต
    $sql = "UPDATE product_tb SET 
            product_name = ?, 
            product_detail = ?, 
            product_price = ?, 
            product_type_id = ?
            WHERE product_id = ?";
    
    // ใช้ prepared statements เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $product_name, $product_detail, $product_price, $product_type_id, $product_id);

    // ทำการอัปเดต
    if ($stmt->execute()) {
        echo "
            <script>
            alert('แก้ไขรายละเอียดเรียบร้อยแล้วครับ');
            window.location = 'ad_allproduct.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');
            history.back();
            </script>
        ";
    }

    // ปิด statement
    $stmt->close();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
