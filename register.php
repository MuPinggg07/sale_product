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
    <title>สมัคสมาชิก</title>
    
    <style type="text/css">
img.resize  {
	width: 200px;
	height: 200px;
	border: 0;
}
.custom-font { 
    font-family: Mochiy Pop One, serif;
    font-size: 40px;
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
    color: #FFFF;
}
.connection{
    max-width: 1140px;
    margin: 0 auto;
}
</style>
</head>
<body style="background-color:#FFF8DC ">
    <center><div class=" w-30 " style="background-color:#FFF8DC"><img src="https://production-shopdit.s3.ap-southeast-1.amazonaws.com/ckm-logo-rec%404x-1659073848350" alt="animate" class="resize" /></div></center>
        <center>
            <h2 class="mt-3 custom-font">Register</h2>
        </center>
        <form action="fn_Register.php" method="post" enctype="multipart/form-data">
    <div class="connection">
        <div class="form-floating mt-3 custom-font2">
            <input type="text" class="form-control" name="user_fname" id="user_fname" placeholder="user_fname" required>
            <label for="user_fname">Firstname</label>
        </div>
        
        <div class="form-floating mt-3 custom-font2">
            <input type="text" class="form-control" name="user_sname" id="user_sname" placeholder="user_sname" required>
            <label for="user_sname">Sername</label>
        </div>

        <div class="form-floating mt-3 custom-font2">
            <input type="text" class="form-control" name="user_username" id="user_username" placeholder="user_username" required>
            <label for="user_username">Username</label>
        </div> 
        
        <div class="form-floating mt-3 custom-font2">
            <input type="text" class="form-control" name="user_tel" id="user_tle" placeholder="user_tel" required>
            <label for="user_tle">Telephone number</label>
        </div>

        <div class="form-floating mt-3 custom-font2">
            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="user_password" required>
            <label for="user_password">Password</label>
        </div>

        <div class="form-floating mt-3 custom-font2">
            <input type="password" class="form-control" name="user_password2" id="user_password2" placeholder="user_password2" required>
            <label for="user_password2">Confirm password</label>
        </div>

        <div class="form-floating mt-3 custom-font2">
            <input type="file" class="form-control" name="img" id="img" placeholder="img" required>
        </div>
    </div>
    <center>
    <div class="d-flex justify-content-center mt-3">
        <a href="index.php" class="btn btn-primary me-2 w-25 custom-font3">cancel</a>
        <input href="index.php" type="submit" value="next" class="btn btn-success w-25 custom-font3">
    </div>
        </form>
    </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>