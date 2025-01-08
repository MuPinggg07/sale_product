<?php
include('config.php'); // เชื่อมต่อฐานข้อมูล

if (isset($_GET['mook_id'])) {
    $mook_id = $_GET['mook_id'];

    // ดึงข้อมูลรูปภาพเพื่อลบไฟล์ในเซิร์ฟเวอร์
    $sql = "SELECT mook_img FROM mook_tb WHERE mook_id = '$mook_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = 'mook_img/' . $row['mook_img'];

        // ลบไฟล์รูปภาพในเซิร์ฟเวอร์
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // ลบข้อมูลในฐานข้อมูล
        $delete_sql = "DELETE FROM mook_tb WHERE mook_id = '$mook_id'";
        if ($conn->query($delete_sql) === TRUE) {
            // ลบสำเร็จ
            header("Location: all_mook.php?status=delete_success");
        } else {
            // เกิดข้อผิดพลาดระหว่างการลบ
            header("Location: all_mook.php?status=delete_error");
        }
    } else {
        // ไม่มีข้อมูลที่ต้องการลบ
        header("Location: all_mook.php?status=not_found");
    }
} else {
    // ไม่มี `mook_id` ที่ส่งมา
    header("Location: all_mook.php?status=invalid_request");
}

$conn->close();
?>
