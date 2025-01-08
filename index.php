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
    <title>เข้าสู่ระบบ</title>
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
    font-size: 30px;
    color: #663300;
}
.custom-font2 { /*เป็นของ username and password*/
    font-family: Mochiy Pop One, serif;
    color: #663300;
}
.custom-font3 { /*สำหรับปุ่ม register กับ login*/
    font-family: Mochiy Pop One, serif;
    color: #FFFF;
}
.connection{
    max-width: 1140px;
    margin: 0 auto;
}
</style>
</head>
<body style="background-color:#FFF8DC">
    <center>
    <div class="p-5"><img src="https://production-shopdit.s3.ap-southeast-1.amazonaws.com/ckm-logo-rec%404x-1659073848350"alt="animate" class="resize"></div>
    <div class="p-3 mb-3 w-30 custom-font"><b>CHAKAIMUK</b></div>
    <div class="container w-30 " style="width:25%">
    </center>
        <center>
            <h2 class="mt-2 custom-font1">LOGIN</h2>
        </center>
        <form action="fn_login.php" method="post">

    <div class="connection">
        <div class="form-floating mt-2 custom-font2">
            <input type="text" class="form-control" name="user_username" id="user_username" placeholder="user_username">
            <label for="user_username">username</label>
        </div>            
    
        <div class="form-floating mt-3 custom-font2">
            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="user_password">
            <label for="user_password">password</label>
        </div>
    </div>

    <center>
    <div class="d-flex justify-content-center mt-3">
        <a href="register.php" class="btn btn-primary me-2 w-25 custom-font3">register</a>
        <input type="submit" value="login" class="btn btn-success w-25 custom-font3">
    </div>
        </form>
    </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>