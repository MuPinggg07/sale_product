<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .adbg {
            background-image: url('img/bg1.jpg');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: cover;
            height: 100vh;
            opacity: 0.7;
        }
        .adtext {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .custom-font {
            font-family: Mochiy Pop One, serif;
            font-size: 50px;
            font-weight: bold; 
            color: #663300;
        }
        @media (max-width: 576px) {
            .custom-font {
                font-size: 24px;
            }
            .adtext {
                height: auto;
                padding: 20px;
            }
        }
        @media (min-width: 577px) and (max-width: 768px) {
            .custom-font {
                font-size: 36px;
            }
        }
    </style>
    <title>ADMIN PAGE</title>
</head>
<body>
    
    <?php 
        include('config.php');
        include('session.php');
        include('ad_navbar.php');

        $user_fname = $_SESSION['user_fname'];
        $user_sname = $_SESSION['user_sname'];
    ?>
   
    <div class="adbg">
        <div class="adtext custom-font">
            <div>
                <font size="24" color="#663300"><b>WELCOME...</b></font>
                
                <font size="24" color="#663300"><?=$user_fname;?></font>
                
                <font size="24" color="#663300"><?=$user_sname;?></font>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>
