<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include('config.php'); // เปลี่ยนไฟล์นี้หากต้องการเชื่อมต่อกับฐานข้อมูลที่แตกต่าง
include('session.php'); // ไฟล์นี้ควรเป็นส่วนที่จัดการเซสชันผู้ใช้
include('fn_uploadbanner.php'); // รวมฟังก์ชันการอัปโหลด
include('fn_deleteBanner.php');

// ตรวจสอบการอัปโหลดไฟล์
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['bannerImage'])) {
    // เรียกใช้ฟังก์ชันเพื่ออัปโหลดรูปภาพ
    $uploadResult = uploadBanner($_FILES['bannerImage'], $conn);
    if ($uploadResult === true) {
        header("Location: ad_uploadbanner_main.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>{$uploadResult}</div>";
    }
}

// ตรวจสอบการลบรูปภาพ
if (isset($_GET['delete'])) {
    $img_id = $_GET['delete'];
    $deleteResult = deleteBanner($img_id, $conn);
    $alertMessage = $deleteResult === true ? "ลบรูปภาพสำเร็จ!" : $deleteResult;
    echo "<div class='alert alert-success text-center' id='alert'>{$alertMessage}</div>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: จัดการรูปภาพแบนเนอร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <style>
        .container {
            max-width: 900px;
            font-family: 'Noto Sans Thai', sans-serif;
        }
        img.resize {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin: 0 auto;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100%;
        }
    </style>
</head>
<body>
    <?php include('ad_navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="text-center">Upload Banner</h2>

        <!-- ฟอร์มสำหรับอัปโหลดรูปภาพ -->
        <form action="ad_uploadbanner_main.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="bannerImage" class="form-label">เลือกรูปภาพ:</label>
                <input type="file" name="bannerImage" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">อัปโหลดรูปภาพ</button>
        </form>

        <!-- แสดงรายการรูปภาพที่มีอยู่ -->
        <div class="mt-5">
            <h3>รูปภาพแบนเนอร์ที่มีอยู่</h3>
            <div class="d-flex flex-wrap">
                <?php
                $sql = "SELECT * FROM banner_system_tb";
                $result = $conn->query($sql);
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <div class="card me-2 mb-2" style="width: 13rem;">
                            <img src="banner_image/<?php echo $row['banner_image']; ?>" class="resize card-img-top">
                            <div class="card-body">
                                <a href="ad_uploadbanner_main.php?delete=<?php echo $row['banner_id']; ?>" class="btn btn-danger btn-sm mt-auto">ลบ</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>ไม่มีรูปภาพแบนเนอร์</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <script>
        setTimeout(() => {
            const alertElement = document.getElementById('alert');
            if (alertElement) {
                alertElement.style.transition = "transform 0.5s, opacity 0.5s";
                alertElement.style.transform = "translateY(-20px)";
                alertElement.style.opacity = "0";
                setTimeout(() => {
                    alertElement.style.display = 'none';
                }, 500);
            }
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
