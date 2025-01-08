<?php
function deleteBanner($banner_id, $conn) {
    // ดึงข้อมูลรูปภาพจากฐานข้อมูล
    $sql = "SELECT banner_image FROM banner_system_tb WHERE banner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $banner_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $img_path = "banner_image/" . $row['banner_image']; // กำหนดเส้นทางของรูปภาพที่ต้องลบ

        // ลบรูปภาพจากเซิร์ฟเวอร์
        if (file_exists($img_path)) {
            unlink($img_path); // ลบไฟล์
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM banner_system_tb WHERE banner_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $banner_id);
        
        if ($stmt->execute()) {
            return true; // การลบสำเร็จ
        } else {
            return "เกิดข้อผิดพลาดในการลบข้อมูลในฐานข้อมูล: " . $conn->error; // ข้อความเมื่อเกิดข้อผิดพลาด
        }
    } else {
        return "ไม่พบรูปภาพที่ต้องการลบ"; // ข้อความเมื่อไม่พบรูปภาพ
    }
}
?>