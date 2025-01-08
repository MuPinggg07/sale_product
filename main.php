<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sale_product_db";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// กำหนดตัวแปร $images เป็นอาร์เรย์ว่างก่อนการใช้งาน
$images = [];

// ดึงข้อมูลแบนเนอร์จากฐานข้อมูล
$sql = "SELECT banner_image FROM banner_system_tb WHERE status = 'active'";
$result = $conn->query($sql);



while ($row = $result->fetch_assoc()) {
    $images[] = $row['banner_image'];
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <title>CHAKAIMUK</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #FFF8DC;
            font-family: 'Kanit', sans-serif;
        }

        header {
            background: #f8f9fa;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        
        /**--------------------------------------------------------------------------- */
        .search-form {
            display: flex;
            align-items: center;
            margin: 0 auto;
            max-width: 340px;
            width: 100%;
        }

        .search-form input[type="text"] {
            padding: 8px;
            flex: 1;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form button {
            margin-left: 10px;
            padding: 8px 15px;
            border-radius: 6px;
            background-color: #663300;
            color: white;
            border: none;
            cursor: pointer;
        }
        /**--------------------------------------------------------------------------- */
        .container {
            color: #663300;
            display: flex; /* ใช้ Flexbox */
            justify-content: space-between; /* จัดให้มีระยะห่างระหว่างสองส่วน */
            align-items: flex-start; /* จัดให้อยู่ในแนวเดียวกันที่ด้านบน */
            gap: 20px; /* เพิ่มช่องว่างระหว่างสองส่วน */
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        /**--------------------------------------------------------------------------- */
        .banner-container {
            position: relative;
            width: 70%;
            height: 500px;
            overflow: hidden;
            margin: 20px 0;
            margin-left: 20px;
            border-radius: 15px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้กับกล่อง */
        }

        .banner-container img {
            height: 100%;
            width: auto;
            object-fit: cover;
            display: none; /* ซ่อนทุกภาพ */
        }

        .banner-container img.active {
            display: block; /* แสดงเฉพาะภาพที่มีคลาส active */
        }

        .banner-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1;
        }

        .banner-btn.left {
            background: #8B4513;
            color: #FFF8DC;
            left: 10px;
            border-radius: 50px;
        }

        .banner-btn.right {
            background: #8B4513;
            color: #FFF8DC;
            right: 10px;
            border-radius: 50px;
        }

        /**--------------------------------------------------------------------------- */
        .news {
            position: relative;
            width: 30%;
            height: 500px;
            overflow: hidden;
            margin: 20px 0;
            margin-left: 10px;
            border-radius: 15px;
            background: #fff;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้กับกล่อง */
        }

        .news h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: left;
            margin-left: 50px;
        }

        .news-item {
            display: flex;
            align-items: flex-start; /* จัดให้เนื้อหาอยู่ในแนวเดียวกันที่ด้านบน */
            margin-bottom: 30px;
            padding-bottom: 15px;
            margin-left: 100px;
        }

        .news-item img {
            width: 150px; /* กำหนดขนาดรูปภาพ */
            height: auto;
            margin-right: 15px; /* เพิ่มช่องว่างระหว่างรูปภาพและเนื้อหา */
            object-fit: cover;
        }

        .news-content h3 {
            font-size: 18px;
            margin: 0 0 10px 0;
        }

        .news-content p {
            font-size: 14px;
            color: #666;
        }

        /**--------------------------------------------------------------------------- */
        .carousel-container1 {
            width: 100%;
            overflow: hidden;
            margin: 20px 0;
        }

        .carousel {
            display: flex;
            gap: 10px;
            transition: transform 0.3s ease-in-out;
        }
        /**--------------------------------------------------------------------------- */
        .card {
            flex: 0 0 18%;
            margin: 0 10px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        /**--------------------------------------------------------------------------- */
        .btn {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            background: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 1.5rem;
            z-index: 1000;
        }

        .btn.left {
            left: 0;
        }

        .btn.right {
            right: 0;
        }

        .btn:hover {
            background: #555;
        }
        .custom-button1:hover {
            background-color: #663300; /* เปลี่ยนสีเมื่อ hover */
        }
        /**--------------------------------------------------------------------------- */
        .camera-products-container {
            display: flex;
            align-items: center;
        }

        .camera-products {
            display: flex;
            transition: transform 0.3s ease;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .camera-product {
            min-width: 220px;
            margin: 0 10px;
            text-align: center;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Media Queries สำหรับหน้าจอเล็ก */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* เปลี่ยนเป็นแนวตั้ง */
            }

            .banner-container, .news {
                flex: auto; /* ให้เต็มความกว้าง */
                height: auto; /* ปรับความสูงอัตโนมัติ */
                width: 90%;
                margin-left: 20px;
            }

            .search-form {
                max-width: 100%; /* ให้ใช้ความกว้างเต็ม */
            }

            .camera-products-container {
                height: auto; /* ปรับความสูงอัตโนมัติ */
            }
        }
        /* Media Query สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 768px) {
            .banner-container {
                height: auto; /* ปรับความสูงสำหรับหน้าจอเล็ก */
                width: 90%;
                flex: auto; /* ให้เต็มความกว้าง */
            }

            .banner-btn {
                padding: 8px; /* ปรับขนาดปุ่มให้เล็กลง */
            }
        }
    </style>
</head>
<body>

<?php include 'navbar_main.php'; ?>

<div class="container">

    <!-- แสดงแบนเนอร์รูปภาพ -->
    <div class="banner-container">
        <?php if (count($images) > 0): ?>
            <?php foreach ($images as $index => $img): ?>
                <img src="banner_image/<?php echo $img; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" alt="Banner Image">
            <?php endforeach; ?>
            <button class="banner-btn left" onclick="prevImage()">❮</button>
            <button class="banner-btn right" onclick="nextImage()">❯</button>
        <?php else: ?>
            <p>ไม่มีข้อมูลแบนเนอร์</p>
        <?php endif; ?>
    </div>

    <!-- ส่วนข่าวสาร -->
    <div class="news font-family1" style="margin-right: 20px;">
        <h2>ข่าวสาร</h2>

        <?php
        // ดึงข้อมูลข่าวสารจากฐานข้อมูล
        $sql_news = "SELECT * FROM news_tb"; // เปลี่ยนเป็นชื่อฐานข้อมูลที่ใช้งานจริง
        $result_news = $conn->query($sql_news);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result_news->num_rows > 0) {
            // วนลูปเพื่อแสดงข้อมูลข่าวสารแต่ละรายการ
            while($row_news = $result_news->fetch_assoc()) {
                echo '<div class="news-item">';
                echo '<img src="' . htmlspecialchars($row_news["news_image"]) . '" alt="' . htmlspecialchars($row_news["news_title"]) . '">';
                echo '<div>';
                echo '<h3>' . htmlspecialchars($row_news["news_title"]) . '</h3>';
                echo '<p>' . htmlspecialchars($row_news["news_description"]) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>ยังไม่มีข่าวสาร</p>";
        }
        ?>
    </div>
</div>

    <!-- ชานม -->
    <div>
        <h1 class="font-family1" style="text-align: center; margin-bottom: 10px; margin-left: 20px;">ชานม</h2>
    </div>
    <div class="container font-family1" style="margin-top: 20px; width: 100%;  margin-left: 0px;">
        <div class="camera-products-container" style="position: relative; width: 100%; height: 400px; overflow: hidden; padding: 0 20px;">
            <ul class="camera-products" id="cameraProducts" style="display: flex; height: 100%; transition: transform 0.3s ease; list-style-type: none; padding: 0; margin: 0;">
                <?php
                // ดึงข้อมูลสินค้าจาก product_tb
                $sql_products = "SELECT * FROM product_tb WHERE product_type_id = 1";
                $result_products = $conn->query($sql_products);

                if ($result_products->num_rows > 0) {
                    while($row = $result_products->fetch_assoc()) {
                        echo '<li class="camera-product" style="flex: none; width: 220px; height: 100%; text-align: center; background: #fff; padding: 10px; margin: 0 10px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); box-sizing: border-box;">';
                        echo '<img src="product_img/' . htmlspecialchars($row["product_img"]) . '" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">';
                        echo '<h3 style="font-size: 16px; margin: 5px 0;">' . htmlspecialchars($row["product_name"]) . '</h3>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">' . htmlspecialchars($row["product_detail"]) . '</p>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">ราคา: ' . htmlspecialchars($row["product_price"]) . ' บาท</p>';
                        
                        // ปุ่มตะกร้าสินค้า
                        echo '<form action="us_cart.php" method="get" class="d-inline" style="margin-top: 10px;">';
                        echo '<input type="hidden" name="action" value="add">';
                        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
                        echo '<button type="submit" class="custom-button1" style="border: none; background-color: #CD853F; color: white; padding: 5px 10px; border-radius: 5px; cursor:pointer;">';
                        echo '<i class="bi bi-cart4"></i>';
                        echo '</button>';
                        echo '</form>';
                        
                        echo '</li>';
                    }
                } else {
                    echo "<p>ไม่มีสินค้าในระบบ</p>";
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- บราวซูก้า -->
    <div>
        <h1 class="font-family1" style="text-align: center; margin-bottom: 10px; margin-left: 20px;">บราวซูก้า</h2>
    </div>
    <div class="container font-family1" style="margin-top: 20px; width: 100%;">
        <div class="camera-products-container" style="position: relative; width: 100%; height: 400px; overflow: hidden; padding: 0 20px;">
            <ul class="camera-products" id="cameraProducts" style="display: flex; height: 100%; transition: transform 0.3s ease; list-style-type: none; padding: 0; margin: 0;">
                <?php
                // ดึงข้อมูลสินค้าจาก product_tb
                $sql_products = "SELECT * FROM product_tb WHERE product_type_id = 20";
                $result_products = $conn->query($sql_products);

                if ($result_products->num_rows > 0) {
                    while($row = $result_products->fetch_assoc()) {
                        echo '<li class="camera-product" style="flex: none; width: 220px; height: 100%; text-align: center; background: #fff; padding: 10px; margin: 0 10px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); box-sizing: border-box;">';
                        echo '<img src="product_img/' . htmlspecialchars($row["product_img"]) . '" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">';
                        echo '<h3 style="font-size: 16px; margin: 5px 0;">' . htmlspecialchars($row["product_name"]) . '</h3>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">' . htmlspecialchars($row["product_detail"]) . '</p>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">ราคา: ' . htmlspecialchars($row["product_price"]) . ' บาท</p>';
                        
                        // ปุ่มตะกร้าสินค้า
                        echo '<form action="us_cart.php" method="get" class="d-inline" style="margin-top: 10px;">';
                        echo '<input type="hidden" name="action" value="add">';
                        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
                        echo '<button type="submit" class="custom-button1" style="border: none; background-color: #CD853F; color: white; padding: 5px 10px; border-radius: 5px; cursor:pointer;">';
                        echo '<i class="bi bi-cart4"></i>';
                        echo '</button>';
                        echo '</form>';
                        
                        echo '</li>';
                    }
                } else {
                    echo "<p>ไม่มีสินค้าในระบบ</p>";
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- ชา -->
    <div>
        <h1 class="font-family1" style="text-align: center; margin-bottom: 10px; margin-left: 20px;">ชา</h2>
    </div>
    <div class="container font-family1" style="margin-top: 20px; width: 100%;">
        <div class="camera-products-container" style="position: relative; width: 100%; height: 400px; overflow: hidden; padding: 0 20px;">
            <ul class="camera-products" id="cameraProducts" style="display: flex; height: 100%; transition: transform 0.3s ease; list-style-type: none; padding: 0; margin: 0;">
                <?php
                // ดึงข้อมูลสินค้าจาก product_tb
                $sql_products = "SELECT * FROM product_tb WHERE product_type_id = 21";
                $result_products = $conn->query($sql_products);

                if ($result_products->num_rows > 0) {
                    while($row = $result_products->fetch_assoc()) {
                        echo '<li class="camera-product" style="flex: none; width: 220px; height: 100%; text-align: center; background: #fff; padding: 10px; margin: 0 10px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); box-sizing: border-box;">';
                        echo '<img src="product_img/' . htmlspecialchars($row["product_img"]) . '" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">';
                        echo '<h3 style="font-size: 16px; margin: 5px 0;">' . htmlspecialchars($row["product_name"]) . '</h3>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">' . htmlspecialchars($row["product_detail"]) . '</p>';
                        echo '<p style="font-size: 14px; margin: 5px 0;">ราคา: ' . htmlspecialchars($row["product_price"]) . ' บาท</p>';
                        
                        // ปุ่มตะกร้าสินค้า
                        echo '<form action="us_cart.php" method="get" class="d-inline" style="margin-top: 10px;">';
                        echo '<input type="hidden" name="action" value="add">';
                        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
                        echo '<button type="submit" class="custom-button1" style="border: none; background-color: #CD853F; color: white; padding: 5px 10px; border-radius: 5px; cursor:pointer;">';
                        echo '<i class="bi bi-cart4"></i>';
                        echo '</button>';
                        echo '</form>';
                        
                        echo '</li>';
                    }
                } else {
                    echo "<p>ไม่มีสินค้าในระบบ</p>";
                }
                ?>
            </ul>
        </div>
    </div>




<!-- แจ้งเตือน -->
<div id="alert" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.8); color: white; padding: 30px; border-radius: 10px; z-index: 1000; text-align: center; width: 400px;">
    <p  class="font-family1" style="font-size: 21px; margin-bottom: 20px;">คุณยังไม่ได้เป็นสมาชิก</p>
    <div style="display: flex; justify-content: center; gap: 10px;">
        <button onclick="closeAlert()" style="border: none; background-color: #FF0000; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer;" class="font-family1">ปิด</button>
        <a href="register.php" style="text-decoration: none;">
            <button style="border: none; background-color: #CD853F; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer;" class="font-family1">สมัครสมาชิก</button>
        </a>
    </div>
</div>









<!-- ส่วนแสดงสินค้า -->
    
<script>
    const images = document.querySelectorAll('.banner-container img');
        let currentIndex = 0;
        
        function showNextImage() {
            images[currentIndex].classList.remove('active'); // ซ่อนภาพปัจจุบัน
            currentIndex = (currentIndex + 1) % images.length; // เปลี่ยนไปยังภาพถัดไป
            images[currentIndex].classList.add('active'); // แสดงภาพถัดไป
        }

        // เริ่มการแสดงภาพทุก 3 วินาที
        setInterval(showNextImage, 5000);
        // แสดงภาพปัจจุบัน
        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index); // แสดงภาพที่ตรงกับ index
            });
        }

        // ปุ่มถัดไป   
        document.getElementById('nextBtn').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length; // เปลี่ยนไปยังภาพถัดไป
            showImage(currentIndex);
        });

        // ปุ่มก่อนหน้า
        document.getElementById('prevBtn').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // เปลี่ยนไปยังภาพก่อนหน้า
            showImage(currentIndex);
        });
        

        // เริ่มต้นแสดงภาพแรก
        showImage(currentIndex);
        

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    }

    let scrollAmount = 0;

    function moveLeft() {
        const carousel = document.getElementById('carousel');
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        scrollAmount -= 300;
        if (scrollAmount < 0) {
            scrollAmount = 0;
        }
        carousel.style.transform = `translateX(-${scrollAmount}px)`;
    }

    function moveRight() {
        const carousel = document.getElementById('carousel');
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        scrollAmount += 300;
        if (scrollAmount > maxScroll) {
            scrollAmount = maxScroll;
        }
        carousel.style.transform = `translateX(-${scrollAmount}px)`;
    }

    let cameraScrollAmount = 0;

    function moveCameraLeft() {
        const cameraProducts = document.getElementById('cameraProducts');
        const maxScroll = cameraProducts.scrollWidth - cameraProducts.clientWidth;
        
        cameraScrollAmount -= 300; // ปรับค่าตามที่ต้องการ
        if (cameraScrollAmount < 0) {
            cameraScrollAmount = 0; // ไม่ให้เลื่อนเกินซ้ายสุด
        }
        cameraProducts.style.transform = `translateX(-${cameraScrollAmount}px)`; // เลื่อนภาพ
    }

    function moveCameraRight() {
        const cameraProducts = document.getElementById('cameraProducts');
        const maxScroll = cameraProducts.scrollWidth - cameraProducts.clientWidth;

        cameraScrollAmount += 300; // ปรับค่าตามที่ต้องการ
        if (cameraScrollAmount > maxScroll) {
            cameraScrollAmount = maxScroll; // ไม่ให้เลื่อนเกินขวาสุด
        }
        cameraProducts.style.transform = `translateX(-${cameraScrollAmount}px)`; // เลื่อนภาพ
    }

    function showAlert() {
        // ตรวจสอบสมาชิก
        <?php if (!isset($_SESSION['user_id'])): ?>
            document.getElementById('alert').style.display = 'block';
            return false; // ห้ามส่งฟอร์ม
        <?php endif; ?>
    }

    function closeAlert() {
    document.getElementById('alert').style.display = 'none';
}
</script>

</body>
</html>
__