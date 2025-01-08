<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <style>
    /* โครงสร้างพื้นฐาน */
    body {
        font-family: 'Kanit', Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #FFF8DC;
        color: #663300;
        padding: 10px 20px;
    }

    /* แถบด้านบน */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .contact-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .contact-info i,
    .contact-info a {
        color: #663300;
    }

    .social-icons {
        margin-left: auto; /* ทำให้ social-icons ไปอยู่ด้านขวาสุด */
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: 1520px;
    }

    .social-icons a {
        color: #663300;
        font-size: 20px;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icons a:hover {
        transform: translateY(-5px);
        color: #663300;
    }

    /* แถบเมนู */
    nav {
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
    }

    .logo {
        text-align: center;
        margin-bottom: 10px;
    }

    .logo img {
        width: 80px;
        height: auto;
    }

    nav ul {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #663300;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    nav ul li a:hover {
        color: #FAF0E6;
    }

    .nav-container .nav-link i {
        font-size: 1.4rem;
        color: #663300;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .top-bar {
            flex-direction: column;
            align-items: center;
        }

        .social-icons {
            margin-left: 0; /* Reset margin-left ในหน้าจอเล็ก */
            justify-content: center;
        }

        nav ul {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
</head>

<body>

    <!-- ส่วน Header -->
    <header>
        <div class="top-bar">
            <!-- ข้อมูลติดต่อ -->
            <div class="contact-info">
                <i class="fas fa-phone"></i>
                <a>เบอร์โทร</a>
                <i class="fas fa-envelope"></i>
                <a>CHAKAIMUK</a>
            </div>

            <!-- ไอคอน Social Media -->
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-line"></i></a>
                <a href="#"><i class="bi bi-tiktok"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </header>
<!-- ส่วนของเมนูหลัก -->
<nav>
    <div class="logo">
    <img src="https://production-shopdit.s3.ap-southeast-1.amazonaws.com/ckm-logo-rec%404x-1659073848350" alt="Logo" style="width: 10%; height: 17%;">
    </div>
    <ul>
        <li><a href="#home" class="font-family1">หน้าหลัก</a></li>
        <li><a href="#about" class="font-family1">เกี่ยวกับเรา</a></li>
        <li><a href="#contact" class="font-family1">ติดต่อเรา</a></li>
        <li><a href="us_map.php" class="font-family1">ที่ตั้งร้าน</a></li>
        <li><a href="index.php" class="font-family1">เข้าสู่ระบบ</a></li>
        <!-- สามารถเพิ่มการแจ้งเตือนจำนวนสินค้าตะกร้าได้ที่นี่ -->
        <div class="nav-container">
            <a class="nav-link" href="us_cart.php">
                <i class="bi bi-cart3"></i>
            </a>
        </div>
    </ul>
</nav>

</body>
</html>
