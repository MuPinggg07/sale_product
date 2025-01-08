<?php
include('config.php'); // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mook_name = mysqli_real_escape_string($conn, $_POST['mook_name']);
    $mook_price = mysqli_real_escape_string($conn, $_POST['mook_price']);
    
    // จัดการอัปโหลดไฟล์
    $target_dir = "mook_img/"; // โฟลเดอร์สำหรับเก็บรูปภาพ
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบไฟล์ภาพ
    if (isset($_FILES["img"]) && $_FILES["img"]["size"] > 0) {
        // ตรวจสอบประเภทไฟล์
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            header("Location: add_mook.php?status=invalid_file");
            exit();
        }
        // ตรวจสอบขนาดไฟล์ (ไม่เกิน 2MB)
        if ($_FILES["img"]["size"] > 2097152) {
            header("Location: add_mook.php?status=file_too_large");
            exit();
        }
        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $mook_img = basename($_FILES["img"]["name"]);
        } else {
            header("Location: add_mook.php?status=error");
            exit();
        }
    } else {
        $mook_img = null;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO mook_tb (mook_name, mook_price, mook_img) VALUES ('$mook_name', '$mook_price', '$mook_img')";
    if (mysqli_query($conn, $sql)) {
        header("Location: add_mook.php?status=success");
    } else {
        header("Location: add_mook.php?status=error");
    }
}
?>
