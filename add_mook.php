<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <title>Add Mook</title>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .custom-title {
            color: #663300;
            font-size: 36px;
            font-weight: bold;
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .form-label, .form-control, .alert {
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .btn-custom {
            background-color: #CD853F;
            color: white;
            border: none;
            font-family: 'Noto Sans Thai', sans-serif;
        }
        .btn-custom:hover {
            background-color: #663300;
        }
    </style>
</head>
<body>
    <?php
    include('config.php'); // เชื่อมต่อฐานข้อมูล
    include('session.php');
    include('ad_navbar.php');
    
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<div class="alert alert-success text-center">เพิ่มข้อมูลมุกสำเร็จ!</div>';
        } elseif ($_GET['status'] == 'error') {
            echo '<div class="alert alert-danger text-center">เกิดข้อผิดพลาด! กรุณาลองใหม่อีกครั้ง</div>';
        } elseif ($_GET['status'] == 'invalid_file') {
            echo '<div class="alert alert-warning text-center">ไฟล์ต้องเป็น JPG, JPEG หรือ PNG เท่านั้น</div>';
        } elseif ($_GET['status'] == 'file_too_large') {
            echo '<div class="alert alert-warning text-center">ไฟล์มีขนาดใหญ่เกินไป (ไม่เกิน 2MB)</div>';
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center custom-title">เพิ่มมุกใหม่</h2>
                <form action="save_mook.php" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mook_name" name="mook_name" placeholder="ชื่อมุก" required>
                        <label for="mook_name">ชื่อมุก</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="mook_price" name="mook_price" placeholder="ราคามุก" required>
                        <label for="mook_price">ราคา (บาท)</label>
                    </div>
                    <div class="mb-3">
                        <label for="mook_img" class="form-label">เลือกรูปภาพ</label>
                        <input class="form-control" type="file" id="mook_img" name="img" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-custom">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ฟังก์ชันเพื่อเลื่อนข้อความขึ้นและซ่อน
        document.addEventListener("DOMContentLoaded", function () {
            const alert = document.querySelector(".alert");
            if (alert) {
                // ตั้งค่าให้ข้อความเลื่อนขึ้นหลัง 3 วินาที
                setTimeout(() => {
                    alert.style.transition = "opacity 1s ease-out";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 1000); // ลบข้อความหลังจากเลือนเสร็จ
                }, 3000); // แสดงข้อความเป็นเวลา 3 วินาที
            }
        });
    </script>
</body>
</html>
