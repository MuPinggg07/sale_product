<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แผนที่ร้าน</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap; /* เพิ่ม flex-wrap เพื่อให้การจัดเรียงในแนวตั้ง */
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .map {
            flex: 1; /* ให้แผนที่มีความกว้างเต็มที่ */
            margin-right: 20px;
            min-width: 300px; /* ขนาดขั้นต่ำสำหรับแผนที่ */
        }
        .details {
            flex: 0 0 300px; /* ขนาดคงที่สำหรับรายละเอียด */
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column; /* แนวตั้ง */
            justify-content: space-between; /* ให้เนื้อหาอยู่ในแนวตั้ง */
            background: #FFF8DC;
        }
        h2 {
            margin: 0 0 10px;
        }
        p {
            margin: 5px 0;
        }
        .image-gallery {
            display: flex; /* ใช้ flexbox เพื่อเรียงรูปภาพในแนวนอน */
            justify-content: space-between; /* ช่องว่างระหว่างรูปภาพ */
            margin-top: auto; /* ให้รูปภาพอยู่ด้านล่างสุด */
        }
        .image-gallery img {
            width: 150px; /* กำหนดความกว้างของรูปภาพ */
            height: 150px; /* กำหนดความสูงของรูปภาพ */
            border-radius: 4px; /* เพิ่มมุมมนให้กับรูปภาพ */
            object-fit: cover; /* ให้รูปภาพไม่ผิดรูป */
            margin-left: 5px;
        }
        .font-family1 {
            font-family: 'Kanit', sans-serif; /* เพิ่มฟอนต์ Kanit */
        }

          /* Media Queries สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 932px) {
            .container {
                flex-direction: column; /* เปลี่ยนเป็นแนวตั้ง */
                align-items: center; /* จัดให้ตรงกลาง */
                margin-right: 40px;
            }
            .map {
                margin-right: 0; /* เอา margin ขวาออก */
                margin-bottom: 20px; /* เพิ่ม margin ด้านล่าง */
                width: 100%; /* ใช้ความกว้างเต็มที่ */
                max-width: 400px; /* ขีดจำกัดความกว้างสูงสุดสำหรับแผนที่ */
            }
            .details {
                margin-top: 0; /* เอา margin-top ออก */
                width: 100%; /* ใช้ความกว้างเต็มที่ */
                max-width: 400px; /* ขีดจำกัดความกว้างสูงสุดสำหรับรายละเอียด */
            }
            .image-gallery img {
                width: 100px; /* ลดความกว้างเมื่อหน้าจอเล็ก */
                height: 100px; /* ลดความสูงเมื่อหน้าจอเล็ก */
            }
        }

        @media (max-width: 600px) {
            .image-gallery img {
                width: 80px; /* ลดความกว้างมากขึ้นเมื่อหน้าจอเล็ก */
                height: 80px; /* ลดความสูงมากขึ้นเมื่อหน้าจอเล็ก */
            }
        }
    </style>
</head>
<body>

<header>
    <?php include('us_navbar.php'); // Include the navigation bar ?>
</header>

<div class="container font-family1">
    <div class="map">
        <!-- แผนที่ (ใช้ Google Maps Embed API) -->
        <iframe 
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d236.0359214800158!2d98.99212376446489!3d18.817095809420596!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3bbe74da344d%3A0xd9fe3d142edd49e8!2zQ2hha2FpbXVrLmNvbSDguKrguLLguILguLIg4Liq4Li44LiC4LmA4LiB4Lip4Lih!5e0!3m2!1sth!2sth!4v1727446302057!5m2!1sth!2sth" 
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
    <div class="details">
        <h2>CHAKAIMUK</h2>
        <p>คำอธิบาย: ร้านของเรานำเสนอสินค้าคุณภาพสูง พร้อมบริการที่ดีที่สุดสำหรับลูกค้าทุกคน</p>
        <p>ที่อยู่: 123 ถนนตัวอย่าง, กรุงเทพฯ, ประเทศไทย</p>
        <p>เบอร์โทรศัพท์: 012-345-6789</p>
        <p>เวลาทำการ: จันทร์ - เสาร์ 10:00 - 19:00</p>
        
        <!-- ส่วนของรูปภาพเรียงกัน -->
        <div class="image-gallery">
            <img src="https://via.placeholder.com/150" alt="รูปภาพ 1">
            <img src="https://via.placeholder.com/150" alt="รูปภาพ 2">
            <img src="https://via.placeholder.com/150" alt="รูปภาพ 3">
        </div>
    </div>
</div>

<footer>
    <!-- คุณสามารถเพิ่ม footer ของคุณที่นี่ -->
</footer>

</body>
</html>
