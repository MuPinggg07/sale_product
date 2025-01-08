<?php
session_start();
include 'db_connection.php'; // เชื่อมต่อฐานข้อมูล

if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่มี user_id แสดงแจ้งเตือน
    echo '<script>
        alert("คุณยังไม่ได้เป็นสมาชิก");
        if (confirm("ต้องการสมัครสมาชิกหรือไม่?")) {
            window.location.href = "index.php"; // ไปที่หน้าสมัครสมาชิก
        } else {
            window.location.href = "main.php"; // กลับไปยังหน้า main
        }
    </script>';
    exit();
}

// ถ้ามี user_id ให้ทำการเพิ่มสินค้าในตะกร้า
$product_id = $_POST['product_id'];
// เพิ่มโค้ดการเพิ่มสินค้าในตะกร้าของคุณที่นี่
// ...

// เปลี่ยนเส้นทางกลับไปยังหน้า main
header("Location: main.php");
exit();
?>
