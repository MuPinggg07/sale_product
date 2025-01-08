<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One|Kanit">
    <title>ADMIN PAGE</title>

<style type="text/css">
img.resize  {
	width: 200px;
	height: 200px;
	border: 0;
}
.custom-font { /* เป็นของ CHAKAIMUK */
    font-family: Mochiy Pop One, serif;
    font-size: 50px;
    font-weight: bold; 
    color: #663300;
}
.custom-font1 { /*เป็นของ login*/ 
    font-family: Mochiy Pop One, serif;
    font-size: 40px;
    color: #663300;
}
.custom-font2 { /*เป็นของ username and password*/
    font-family: Mochiy Pop One, serif;
    color: #663300;
}
.custom-font3 { /*สำหรับปุ่ม register กับ login*/
    font-family: 'Kanit', serif;
    color: #FFE4B5;
}
.custom-font4 { 
    font-family: 'Kanit', serif;
    color: #663300 !important; /* ใช้ !important เพื่อความมั่นใจว่าสีที่กำหนดจะถูกใช้ */
}
.custom-font5 { /*สำหรับปุ่ม register กับ login*/
    font-family: 'Kanit', serif;
    color: #fff;
}
.custom-font6 {
    font-family: 'Kanit', serif;
    color: #663300;
}
.table{
    border-radius: 10px; /* มุมมน */
    background: #FFEBCD;
}
.btn-success.custom-font5 {
    background-color: #CD853F; /* สีน้ำตาล */
    color: #ffffff; /* ข้อความสีขาว */
    border: none; /* ไม่ต้องการขอบ */
}

.btn-success.custom-font5:hover {
    background-color: #663300; /* สีฟ้าเข้มเมื่อวางเมาส์ */
}
</style>

</head> 
<body class="connection background-color:#FFF8DC">
    
    <?php 
        include('config.php');
        include('session.php');
        include('ad_navbar.php');
    ?>
    <div class="container w-50">
    <font face="Bahnschrift SemiBold">
        <h3 class="custom-font2">Add Product Types</h3>
        <p class="custom-font6">เพิ่มประเภทของสินค้า</p>
        
        <form action="fn_product_type.php" method="post" >
            <div class="form-floating mt-3 custom-font6">
                <input type="text" class="form-control" name="product_type_name" id="product_type_name" placeholder="product_type_name" required>
                <label for="product_type_name">ชื่อประเภทสินค้า</label>
             </div>
             <div class="text-end mt-2">
                <input type="submit" class="btn btn-success mt-2 custom-font5" value="เพิ่มประเภทสินค้า">
             </div>
        </form>

        <table class="table table-#663300 table-stripes text-center mt-5 custom-font6">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อประเภทสินค้า</th>
                    <th>จัดการ</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM product_type_tb";
                    $query = $conn->query($sql);

                    while($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?=$row['product_type_id'];?></td>
                    <td><?=$row['product_type_name'];?></td>
                    <td style="width: 25%">
                        <a href="ad_product_type_edit.php?product_type_id=<?=$row['product_type_id'];?>" class="btn btn-warning" style="width: 45%;" onclick="return comfirm('จะเปลี่ยนอะไรไอ่หนุ่ม');">Edit</a>
                        <a href="fn_product_type_Delete.php?product_type_id=<?=$row['product_type_id'];?>" class="btn btn-danger" style="width: 45%;" onclick="return comfirm('จบลบหรอพี่ลบทำพรือละพี่บ่าว!');">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </font>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>