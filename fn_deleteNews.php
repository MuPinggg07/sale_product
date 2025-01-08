<?php
function deleteNews($news_id, $conn) {
    // ดึงข้อมูลรูปภาพจากฐานข้อมูล
    $sql = "SELECT news_image FROM news_tb WHERE news_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $img_path = "news_image/" . $row['news_image']; // กำหนดเส้นทางของรูปภาพที่ต้องลบ

        // ลบรูปภาพจากเซิร์ฟเวอร์
        if (file_exists($img_path)) {
            unlink($img_path); // ลบไฟล์
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM news_tb WHERE news_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $news_id);
        
        if ($stmt->execute()) {
            return true; // การลบสำเร็จ
        } else {
            return "เกิดข้อผิดพลาดในการลบข้อมูลในฐานข้อมูล: " . $conn->error; // ข้อความเมื่อเกิดข้อผิดพลาด
        }
    } else {
        return "ไม่พบข่าวที่ต้องการลบ"; // ข้อความเมื่อไม่พบข่าว
    }
}
?>
