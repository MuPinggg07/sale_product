<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="css/style.css">

    <title>User Profile</title>
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            padding: 20px;
            background: #FFF8DC;
            border-radius: 15px;
            box-shadow: 0 4px 8px #deb083;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .profile-image {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #ddd;
        }
        .profile-name {
            margin-top: 15px;
            font-size: 24px;
            font-weight: bold;
        }
        .profile-details {
            text-align: center;
            margin-top: 20px;
        }
        .profile-details p {
            margin: 10px 0;
        }
        .btn-profile {
            margin-top: 15px;
        }
        .font-family {
            font-family: 'Kanit', serif;
        }
    </style>
</head>
<body>
    
    <?php 
        include('config.php');
        include('session.php');
        include('us_navbar.php');

        $user_id = $_SESSION['user_id'];
    ?>

    <div class="container">
        <!-- User Profile -->
        <?php
            $sql = "SELECT * FROM user_tb WHERE user_id = '$user_id' ";
            $query = $conn->query($sql); 
                   
            while($row = mysqli_fetch_array($query)) {
        ?>

        <div class="profile-container">
            <img src="user_img/<?=$row['user_img'];?>" alt="User Image" class="profile-image">
            <div class="profile-details">
                <h4 class="font-family">
                    <p>ชื่อ : <td><?=$row['user_fname'];?></td></p>
                    <p>นามสกุล : <td><?=$row['user_sname'];?></td></p>
                    <p>เบอร์โทร : <td><?=$row['user_tel'];?></td></p>
                </h4>
                <a href="us_update_profile.php" class="btn btn-primary btn-profile font-family">Edit Profile</a>
                <a href="logout.php" class="btn btn-danger btn-profile font-family">Logout</a>
            </div>
        </div>

        <?php
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>