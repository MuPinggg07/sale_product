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

    <title>Edit Profile</title>
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            padding: 20px;
            background: #FAF0E6;
            border-radius: 15px;
            box-shadow: 0 4px 8px #deb083;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .profile-image {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #ddd;
            margin-bottom: 15px;
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
        $sql = "SELECT * FROM user_tb WHERE user_id = '$user_id'";
        $query = $conn->query($sql);
        $user = mysqli_fetch_array($query);
    ?>

    <div class="container">
        <div class="profile-container">
            <img src="user_img/<?= htmlspecialchars($user['user_img']); ?>" alt="User Image" class="profile-image">

            <form action="fn_us_update_profile.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id); ?>">

                <div class="mb-3">
                    <label for="user_fname" class="form-label font-family">First Name</label>
                    <input type="text" class="form-control font-family" id="user_fname" name="user_fname" value="<?= htmlspecialchars($user['user_fname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="user_sname" class="form-label font-family">Last Name</label>
                    <input type="text" class="form-control font-family" id="user_sname" name="user_sname" value="<?= htmlspecialchars($user['user_sname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="user_tel" class="form-label font-family">Phone</label>
                    <input type="text" class="form-control font-family" id="user_tel" name="user_tel" value="<?= htmlspecialchars($user['user_tel']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="user_img" class="form-label font-family">Profile Image</label>
                    <input type="file" class="form-control font-family" id="user_img" name="user_img">
                </div>
                <center><button type="submit" class="btn btn-primary font-family">Update Profile</button></center>
            </form>
        </div>
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>
