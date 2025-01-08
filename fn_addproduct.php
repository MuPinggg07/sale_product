<?php
include('config.php');

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_detail = $_POST['product_detail'];
    $product_price = $_POST['product_price'];
    $product_type_id = $_POST['product_type_id'];
    $product_img = $_FILES['img']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($product_img);

    // อัปโหลดไฟล์ภาพ
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        // SQL สำหรับการเพิ่มสินค้า
        $sql = "INSERT INTO product_tb (product_name, product_detail, product_price, product_type_id, product_img) 
                VALUES ('$product_name', '$product_detail', '$product_price', '$product_type_id', '$product_img')";
        if ($conn->query($sql) === TRUE) {
            // ถ้าเพิ่มข้อมูลสำเร็จ ให้ redirect ไปหน้า ad_addproduct.php พร้อมแสดงข้อความสำเร็จ
            header("Location: ad_addproduct.php?status=success");
            exit();
        } else {
            // ถ้าเพิ่มข้อมูลไม่สำเร็จ ให้ redirect ไปหน้า ad_addproduct.php พร้อมแสดงข้อความข้อผิดพลาด
            header("Location: ad_addproduct.php?status=error");
            exit();
        }
    } else {
        // ถ้าอัปโหลดรูปภาพไม่สำเร็จ
        header("Location: ad_addproduct.php?status=upload_error");
        exit();
    }
} else {
    // ถ้าไม่มีข้อมูลส่งมาจากฟอร์ม ให้ redirect ไปหน้า ad_addproduct.php
    header("Location: ad_addproduct.php");
    exit();
}
?>
