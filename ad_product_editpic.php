<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Mochiy+Pop+One">
    <title>Edit Picture's Product</Picture></title>

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
    font-family: Mochiy Pop One, serif;
    color: #fff;
}
</style>

</head>
<body class="adbg">
            <?php
            include('config.php');
            include('session.php');
            include('ad_navbar.php');

            $product_id = $_REQUEST['product_id'];
            $sql = "SELECT product_img FROM product_tb WHERE product_id = '$product_id'";
            $query = $conn->query($sql);
            $row = mysqli_fetch_array($query);
            ?>

<div class="text-center">
    <div class="container" style="width: 25%">
    
        <center>
            <h2 class="mt-5 custom-font2" styl="">Edit Picture's Product</h2>
            <hr>
            <img src="product_img/<?=$row['product_img'];?>" style="width: 300px" >
            <br>
            <br>
            <br>
        </center>
        <form action="fn_product_editpic.php" method="post" enctype="multipart/form-data">
            <input type="file" class="form-control" name="img" id="product_img" required>
            <input type="hidden" name="product_id" value ="<?=$product_id?>">
            <div class="d-flex justify-content-end mt-3 mb-3">
                <input type="submit" class=" btn btn-success w-10 " value="Edit">
            </div>    
        </form>
    </div>  
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>