<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One|Noto+Sans+Thai">
    <title>ADMIN PAGE</title>

    <style type="text/css">
        img.resize {
            width: 100%;
            max-width: 200px;
            height: auto;
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
            font-family: Noto Sans Thai, serif;
            color: #FFE4B5;
        }
        .custom-font4 { 
            font-family: Noto Sans Thai, serif;
            color: #663300 ; 
        }
        .custom-font5 {
            font-family: Noto Sans Thai, serif;
            color: #fff;
        }
        .custom-font6 {
            font-family: Noto Sans Thai, serif;
            color: #663300;
        }
        .btn-success.custom-font5 {
            background-color: #CD853F; /* เปลี่ยนสีพื้นหลัง */
            color: #fff; /* เปลี่ยนสีข้อความ */
            border: none; /* หากต้องการไม่ให้มีขอบ */
        }

        .btn-success.custom-font5:hover {
            background-color: #663300; /* เปลี่ยนสีเมื่อวางเมาส์ */
        }
        
        @media (max-width: 576px) {
            .custom-font {
                font-size: 24px;
            }
            .custom-font1, .custom-font2, .custom-font4 {
                font-size: 18px;
            }
            .form-floating {
                width: 100%;
            }
            .btn {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>
<body class=" connection">

    <?php
    include('config.php');
    include('session.php');
    include('ad_navbar.php');
    ?>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<div id="alert-message" class="alert alert-success custom-font6 text-center">เพิ่มสินค้าสำเร็จ!</div>';
        } elseif ($_GET['status'] == 'error') {
            echo '<div id="alert-message" class="alert alert-danger custom-font6 text-center">เกิดข้อผิดพลาดในการเพิ่มสินค้า!</div>';
        } elseif ($_GET['status'] == 'upload_error') {
            echo '<div id="alert-message" class="alert alert-danger custom-font6 text-center">เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ!</div>';
        }
    }
    ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h2 class="text-center custom-font2">Add Product</h2>
                <form action="fn_addproduct.php" method="post" enctype="multipart/form-data">
                    <div class="form-floating mt-4 custom-font6">
                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="product_name" required>
                        <label for="product_name">ชื่อสินค้า</label>
                    </div>
                    <div class="form-floating mt-3 custom-font6">
                        <input type="text" class="form-control" name="product_detail" id="product_detail" placeholder="product_detail" required>
                        <label for="product_detail">รายละเอียดสินค้า</label>
                    </div>
                    <div class="form-floating mt-3 custom-font6">
                        <input type="text" class="form-control" name="product_price" id="product_price" placeholder="product_price" required>
                        <label for="product_price">ราคา</label>
                    </div>
                    <div class="form-floating mt-3 mb-3 custom-font6">
                        <select class="form-control" name="product_type_id" id="product_type_id">
                            <option value="0">กรุณาเลือกประเภทสินค้า</option>
                            <?php
                            $sql = "SELECT * FROM product_type_tb";
                            $query = $conn->query($sql);
                            while($row = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?=$row['product_type_id']?>"><?=$row['product_type_name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="product_type_id">ประเภทสินค้า</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control custom-font6" name="img" id="product_img" required>
                        <label for="product_img">เลือกรูปภาพ</label>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mb-3">
                        <input  type="submit" class="btn btn-success w-100 custom-font5" value="เพิ่มสินค้า">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    // Scroll down to the alert message
    window.onload = function() {
        var alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.scrollIntoView({ behavior: 'smooth' });

            // Set timeout to scroll back up after 3 seconds (3000 milliseconds)
            setTimeout(function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 3000);

            // Optionally, you can hide the alert message after scrolling up
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 6000); // Hides the alert after 6 seconds (3 seconds for scroll and 3 seconds to stay visible)
        }
    };
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
