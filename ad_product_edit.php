<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One|Kanit">
    <link rel="stylesheet" href="css/style.css">
    <title>ADMIN PAGE</title>
    <style>
        .custom-font5 {
            font-family: 'Kanit', serif;
            color: #663300;
        }
        .custom-font6 {
            font-family: 'Kanit', serif;
            color: #663300;
        }
    </style>
</head>
<body class="adbg">
            <?php
            include('config.php');
            include('session.php');
            include('ad_navbar.php');

            $product_id = $_REQUEST['product_id'];
            $sql = "SELECT * FROM product_tb WHERE product_id ='$product_id'";
            $query = $conn->query($sql);
            $row = mysqli_fetch_array($query);
            ?>

<div class="text-center custom-font5">
    <div class="container custom-font5" style="width: 25%">
    
        <center>
            <h2 class=" custom-font6 mt-5" styl="">Edit Product Details</h2>
        </center>
        <form action="fn_product_edit.php" method="post" enctype="multipart/form-data">
             <div class="form-floating mt-3">
                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="กรุณาหรอกชื่อสินค้า" value = "<?=$row['product_name']?>" required>
                <label for="product_name"><font face="Bahnschrift SemiBold">ชื่อสินค้า</font></label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" class="form-control" name="product_detail" id="product_detail" placeholder="กรุณาหรอกชื่อสินค้า" value = "<?=$row['product_detail']?>" required>
                <label for="product_detail"><font face="Bahnschrift SemiBold">รายละเอียดสินค้า</font></label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="กรุณากรอกชื่อสินค้า"  value = "<?=$row['product_price']?>" required>
                <label for="product_price"><font face="Bahnschrift SemiBold">ราคา</font></label>
            </div>
            <div class="form-floating mt-3 mb-3">
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
             <input type="hidden" name="product_id" value ="<?=$product_id?>">  
             <div class="form-floating ">  
            </div>
            <div class="d-flex justify-content-end mt-3 mb-3">
                <input type="submit" class=" btn btn-warning w-25 mt-2" value="Update">&nbsp;&nbsp;
                <a href="ad_allproduct.php" class="btn btn-danger w-25 mt-2">กลับ</a>
            </div>
            
        </form>
    </div>  
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>