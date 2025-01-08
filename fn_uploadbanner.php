<?php
// fn_uploadbanner.php

// ฟังก์ชันสำหรับอัปโหลดรูปภาพแบนเนอร์
function uploadBanner($file, $conn) {
    // กำหนดที่เก็บไฟล์รูปภาพ
    $target_dir = "banner_image/";
    // สร้างเส้นทางสำหรับไฟล์ที่อัปโหลด
    $target_file = $target_dir . basename($file["name"]);
    // รับนามสกุลไฟล์ (เช่น jpg, png)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าเป็นรูปภาพหรือไม่
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ."; // หากไม่ใช่รูปภาพ คืนข้อความผิดพลาด
    }

    // อัปโหลดไฟล์    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลรูปภาพลงในฐานข้อมูล
        $sql = "INSERT INTO banner_system_tb (banner_image, upload_date, status) VALUES ('" . basename($file["name"]) . "', NOW(), 'active')";
        if ($conn->query($sql) === TRUE) {
            return true; // หากอัปโหลดและบันทึกสำเร็จ คืนค่าจริง
        } else {
            return "เกิดข้อผิดพลาดในการบันทึกข้อมูลในฐานข้อมูล: " . $conn->error; // หากเกิดข้อผิดพลาดในการบันทึกคืนค่าข้อความผิดพลาด
        }
    } else {
        return "เกิดข้อผิดพลาดในการอัปโหลดไฟล์."; // หากไม่สามารถอัปโหลดไฟล์คืนค่าข้อความผิดพลาด
    }
}
?>
