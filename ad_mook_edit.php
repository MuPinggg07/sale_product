<?php
include('config.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง `mook_id` มาหรือไม่
if (isset($_GET['mook_id'])) {
    $mook_id = $_GET['mook_id'];

    // ดึงข้อมูลของมุกจากฐานข้อมูล
    $sql = "SELECT * FROM mook_tb WHERE mook_id = '$mook_id'";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
    } else {
        // หากไม่พบข้อมูล ส่งกลับไปยังหน้าหลักพร้อมแจ้งข้อผิดพลาด
        header("Location: ad_mook.php?status=not_found");
        exit();
    }
} else {
    header("Location: ad_mook.php?status=invalid_request");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <title>Edit Mook</title>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .custom-title {
            color: #663300;
            font-size: 36px;
            font-weight: bold;
        }
        .form-label, .form-control, .alert {
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .btn-custom {
            background-color: #CD853F;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #663300;
        }
    </style>
</head>
<body>
    <?php
        include('session.php');
        include('ad_navbar.php');
    ?>
    <div class="container mt-5">
        <h2 class="text-center custom-title">แก้ไขข้อมูลมุก</h2>

        <!-- ฟอร์มสำหรับแก้ไขข้อมูล -->
        <form action="fn_mook_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="mook_id" value="<?= $row['mook_id']; ?>">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="mook_name" name="mook_name" value="<?= $row['mook_name']; ?>" required>
                <label for="mook_name">ชื่อมุก</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="mook_price" name="mook_price" value="<?= $row['mook_price']; ?>" required>
                <label for="mook_price">ราคา (บาท)</label>
            </div>
            <div class="mb-3">
                <label for="mook_img" class="form-label">รูปภาพปัจจุบัน</label><br>
                <img src="uploads/<?= $row['mook_img']; ?>" alt="Current Image" style="max-width: 200px; height: auto;"><br><br>
                <label for="mook_img" class="form-label">เปลี่ยนรูปภาพ</label>
                <input class="form-control" type="file" id="mook_img" name="img" accept=".jpg, .jpeg, .png">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom" href="all_mook.php">บันทึก</button>
                <a href="all_mook.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
