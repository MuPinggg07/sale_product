<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One|Noto+Sans+Thai">
    <title>ADMIN PAGE</title>

<style type="text/css">
img.resize  {
	width: 200px;
	height: 200px;
	border: 0;
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
    font-family: Noto Sans Thai, serif;
    color: #663300;
}
.custom-font5 {
    font-family: Noto Sans Thai, serif;
    color: #fff;
}
.custom-font6 {
    font-family: Noto Sans Thai, serif;
    color: #663300;
}
.table {
    border-radius: 10px; /* มุมมน */
    background: #FFEBCD; /* สีพื้นหลัง */
    overflow: hidden; /* ซ่อนมุมที่เหลือ */
}
</style>

</head>
<body class="connection">
    
    <?php 
        include('config.php');
        include('session.php');
        include('ad_navbar.php');
    ?>
    <div class="container">
    <font face="Bahnschrift SemiBold">
        <h2 class="custom-font2">Accept User Register</h2>
        <p class="custom-font6">อนุญาติหรือยกเลิกผู้ใช้งานระบบที่สมัครสมาชิกใหม่</p>
        <table class="table custom-table table-striped text-center">
            <thead>
                <tr class="custom-font6">
                    <th>รหัสผู้ใช้</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทร</th>
                    <th>Username</th>
                    <th>รูปโปรไฟล์</th>
                    <th style="width: 10%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $sql = "SELECT * FROM user_tb WHERE user_status = 'wait'";
                   $query = $conn->query($sql); 
                   
                   while($row = mysqli_fetch_array($query)) {
                   ?>
                <tr>
                    <td><?=$row['user_id'];?></td>
                    <td><?=$row['user_fname'];?></td>
                    <td><?=$row['user_sname'];?></td>
                    <td><?=$row['user_tel'];?></td>
                    <td><?=$row['user_username'];?></td>
                    <td><img src="user_img/<?=$row['user_img'];?>" style="width: 150px"></td>
                    <td style="width: 10%">
                        <a href="fn_accept.php?user_id=<?=$row['user_id'];?>" class="btn btn-success w-100 custom-font5">อนุมัติ</a>
                        <a href="fn_cancel.php?user_id=<?=$row['user_id'];?>" class="btn btn-danger w-100 mt-2 custom-font5" onclick="return comfirm('ยืนยันการยกเลิกใช่ไหมครับ...แน่ใจนะ...เอาจริงหรอ..เค๊ๆ');">ยกเลิก</a>
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