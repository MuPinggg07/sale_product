<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mook_id = $_POST['mook_id'];
    $mook_name = $_POST['mook_name'];
    $mook_price = $_POST['mook_price'];
    $new_image_name = null;

    // ตรวจสอบว่าผู้ใช้อัปโหลดรูปภาพใหม่หรือไม่
    if (!empty($_FILES['img']['name'])) {
        $target_dir = "mook_img/";
        $new_image_name = time() . "_" . basename($_FILES['img']['name']);
        $target_file = $target_dir . $new_image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ตรวจสอบประเภทไฟล์
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            header("Location: ad_mook_edit.php?mook_id=$mook_id&status=invalid_file");
            exit();
        }

        // ย้ายไฟล์ใหม่ไปยังโฟลเดอร์
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            header("Location: ad_mook_edit.php?mook_id=$mook_id&status=upload_error");
            exit();
        }

        // ลบรูปภาพเก่า
        $sql = "SELECT mook_img FROM mook_tb WHERE mook_id = '$mook_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $old_image_path = "mook_img/" . $row['mook_img'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $update_sql = "UPDATE mook_tb SET 
                   mook_name = '$mook_name',
                   mook_price = '$mook_price'" .
                   ($new_image_name ? ", mook_img = '$new_image_name'" : "") .
                   " WHERE mook_id = '$mook_id'";

    if ($conn->query($update_sql) === TRUE) {
        // หากอัปเดตสำเร็จ ให้กลับไปยังหน้า all_mook.php พร้อมแจ้งสถานะ
        header("Location: all_mook.php?status=edit_success");
    } else {
        // หากเกิดข้อผิดพลาด ให้กลับไปยังหน้าแก้ไข
        header("Location: ad_mook_edit.php?mook_id=$mook_id&status=edit_error");
    }
} else {
    header("Location: all_mook.php?status=invalid_request");
}

$conn->close();
?>
