<?php 
// เริ่มการเชื่อมต่อฐานข้อมูล
include('config.php'); // เชื่อมต่อกับฐานข้อมูล
include('session.php'); // จัดการเซสชันผู้ใช้
include('fn_uploadnews.php'); // ฟังก์ชันการอัปโหลด
include('fn_deleteNews.php'); // ฟังก์ชันการลบ

// ตรวจสอบการอัปโหลดไฟล์
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['newsImage'])) {
    // ดึงข้อมูลจากฟอร์ม
    $newsTitle = $_POST['news_title'];
    $newsDescription = $_POST['news_description'];

    // เรียกใช้ฟังก์ชันเพื่ออัปโหลดรูปภาพ
    $uploadResult = uploadNews($_FILES['newsImage'], $newsTitle, $newsDescription, $conn);
    if ($uploadResult === true) {
        header("Location: ad_editnews_main.php"); // เปลี่ยนเส้นทาง
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>{$uploadResult}</div>";
    }
}

// ตรวจสอบการลบข่าว
if (isset($_GET['delete'])) {
    $news_id = $_GET['delete']; // ดึง ID ของข่าวที่ต้องการลบ
    $deleteResult = deleteNews($news_id, $conn); // เรียกใช้ฟังก์ชันลบ
    
    // ส่งข้อความไปที่ JavaScript
    $alertMessage = $deleteResult === true ? "ลบข่าวสำเร็จ!" : $deleteResult;
    echo "<div class='alert alert-success text-center' id='alert'>{$alertMessage}</div>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: จัดการข่าวสาร</title>
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
        }
        .card-body { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
        }
        .table {
            border-radius: 5px; /* ขอบมน */
            overflow: hidden; /* ป้องกันไม่ให้มุมแหลม */
            background-color: #F5DEB3; 
        }
        .table th, .table td {
            text-align: center; /* จัดให้อยู่กลาง */
        }
    </style>
</head>
<body>
    <?php
        include('ad_navbar.php');
    ?>
    <div class="container mt-5">
        <h2 class="text-center">Admin: จัดการข่าวสาร</h2>
        
        <!-- ฟอร์มสำหรับอัปโหลดรูปภาพ -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="newsTitle" class="form-label">ชื่อข่าว:</label>
                <input type="text" name="news_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="newsDescription" class="form-label">รายละเอียดข่าว:</label>
                <textarea name="news_description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="newsImage" class="form-label">เลือกรูปภาพ:</label>
                <input type="file" name="newsImage" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">อัปโหลดรูปภาพ</button>
        </form>

        <!-- แสดงรายการข่าวที่มีอยู่ -->
        <div class="mt-5">
            <h3>ข่าวสารที่มีอยู่</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ชื่อข่าว</th>
                        <th scope="col">รายละเอียดข่าว</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ดึงข้อมูลข่าวจากฐานข้อมูล
                    $sql = "SELECT * FROM news_tb";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0):
                        $index = 1; // ตัวแปรสำหรับลำดับ
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><?php echo htmlspecialchars($row['news_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['news_description']); ?></td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($row['news_image']); ?>" class="resize" alt="<?php echo htmlspecialchars($row['news_title']); ?>">
                                </td>
                                <td>
                                    <a href="?delete=<?php echo $row['news_id']; ?>" class="btn btn-danger btn-sm">ลบ</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">ไม่มีข่าวสาร</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
        }, 3000); // 3000 มิลลิวินาที = 3 วินาที
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
