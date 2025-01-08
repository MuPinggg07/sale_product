<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One|Kanit">
    <title>ADMIN PAGE</title>

    <style type="text/css">
        img.resize {
            width: 100%;
            max-width: 150px;
            height: auto;
        }
        .custom-font {
            font-family: Mochiy Pop One, serif;
            font-size: 50px;
            font-weight: bold; 
            color: #663300;
        }
        .custom-font1 {
            font-family: Mochiy Pop One, serif;
            font-size: 40px;
            color: #663300;
        }
        .custom-font2 {
            font-family: Mochiy Pop One, serif;
            color: #663300;
        }
        .custom-font3 {
            font-family: Mochiy Pop One, serif;
            color: #FFE4B5;
        }
        .custom-font4 { 
            font-family: 'Kanit', serif;
            color: #663300 !important; /* ใช้ !important เพื่อความมั่นใจว่าสีที่กำหนดจะถูกใช้ */
        }
        .custom-font5 {
            font-family: 'Kanit', serif;
            color: #663300;
        }
        .table{
            border-radius: 10px; /* มุมมน */
            background: #FFEBCD;
        }
        .custom-container {
        max-width: 1200px; /* ความกว้างสูงสุด */
        margin: 0 auto; /* จัดกลาง */
        padding: 20px; /* เพิ่ม padding */
        background-color: #f8f9fa; /* สีพื้นหลัง */
        border: 1px solid #dee2e6; /* ขอบ */
        border-radius: 8px; /* มุมมน */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* เงา */
        font-family: 'Kanit', sans-serif; /* ฟอนต์ */
    }
        @media (max-width: 576px) {
            .custom-font {
                font-size: 24px;
            }
            .custom-font1, .custom-font2, .custom-font4 {
                font-size: 18px;
            }
            .table th, .table td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body class="bg-light ">
    <?php 
        include('config.php');
        include('session.php');
        include('ad_navbar.php');
    ?>

    <div class="container mt-4">
        <h2 class="custom-font2">All Product</h2>
        <p class="custom-font5">รวมสินค้า</p>
        <div class="table-responsive">
            <table class="table table-striped text-center custom-font5">
                <thead>
                    <tr class="">
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>ราคา</th>
                        <th>รูปภาพสินค้า</th>
                        <th style="width: 10%">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $sql = "SELECT * FROM product_tb";
                       $query = $conn->query($sql); 
                       
                       while($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?=$row['product_id'];?></td>
                        <td><?=$row['product_name'];?></td>
                        <td><?=$row['product_detail'];?></td>
                        <td><?=$row['product_price'];?></td>
                        <td><img src="product_img/<?=$row['product_img'];?>" class="resize"></td>
                        <td>
                            <a href="ad_product_edit.php?product_id=<?=$row['product_id'];?>" class="btn btn-warning w-100 mb-2" onclick="return confirm('จะเปลี่ยนอะไรไอ่หนุ่ม');">Edit</a>
                            <a href="ad_product_editpic.php?product_id=<?=$row['product_id'];?>" class="btn btn-primary w-100 mb-2" onclick="return confirm('จะเปลี่ยนอะไรไอ่หนุ่ม');">Edit pic</a>
                            <a href="fn_product_delete.php?product_id=<?=$row['product_id'];?>" class="btn btn-danger w-100" onclick="return confirm('ยืนยันการยกเลิกใช่ไหมครับ...แน่ใจนะ...เอาจริงหรอ..เค๊ๆ');">ยกเลิก</a>
                        </td>
                    </tr>
                    <?php
                       }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
