<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <title>ADMIN PAGE</title>
</head>
<body>
    
    <?php 
        include('config.php');
        include('session.php');
        include('ad_navbar.php');

        $product_type_id = $_REQUEST['product_type_id'];

        $sql = "SELECT * FROM product_type_tb WHERE product_type_id = '$product_type_id'";
        $query = $conn->query($sql);
        $row = mysqli_fetch_array($query);
        
    ?>
    <div class="container w-50">
    <font face="Bahnschrift SemiBold">
        <h2>Edit Product Types</h2>
        <p>แก้ไขประเภทสินค้า</p>
        
        <form action="fn_product_type.php" method="post">
            <div class="form-floating mt-3">
                <input type="text" class="form-control" name="product_type_name" id="product_type_name" placeholder="product_type_name" value="<?=$row['product_type_name'];?>" required>
                <label for="product_type_name">ชื่อสินค้า</label>
             </div>
             <input type="hidden" name="product_type_id" value="<?=$product_type_id?>">
             <input type="submit" class="btn btn-success mt-2" value="เสร็จสิ้น">
        </form>
    </font>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>