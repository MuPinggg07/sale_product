<?php
// fn_uploadnews.php

// ฟังก์ชันสำหรับอัปโหลดข่าวสาร
function uploadNews($file, $title, $description, $conn) {
    // กำหนดที่เก็บไฟล์รูปภาพ
    $target_dir = "news_image/";
    // สร้างเส้นทางสำหรับไฟล์ที่อัปโหลด
    $target_file = $target_dir . basename($file["name"]);
    // รับนามสกุลไฟล์ (เช่น jpg, png)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าเป็นรูปภาพหรือไม่
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ.";
    }

    // อัปโหลดไฟล์    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลข่าวลงในฐานข้อมูล
        $sql = "INSERT INTO news_tb (news_title, news_description, news_image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
        }

        $stmt->bind_param("sss", $title, $description, $target_file);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return "เกิดข้อผิดพลาดในการบันทึกข้อมูลในฐานข้อมูล: " . $stmt->error;
        }
    } else {
        return "เกิดข้อผิดพลาดในการอัปโหลดไฟล์.";
    }
}
?>
