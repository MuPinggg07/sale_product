<?php
    include('config.php');

    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $sql = "SELECT * FROM user_tb 
            WHERE user_username = '$user_username'
            AND user_password = '$user_password'";
            
    $query = mysqli_query($conn,$sql);
    

    if(mysqli_num_rows($query) == 1)
    {
        $row = mysqli_fetch_array($query);
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_fname'] = $row['user_fname'];
        $_SESSION['user_sname'] = $row['user_sname'];
        $_SESSION['user_tel'] = $row['user_tel'];
        $_SESSION['user_username'] = $row['user_username'];
        $_SESSION['user_password'] = $row['user_password'];
        $_SESSION['user_img'] = $row['user_img'];
        $_SESSION['user_status'] = $row['user_status'];

        if($_SESSION['user_status'] == "admin")
        {
            echo 
        "
            <script>
                window.location = 'ad_home.php';
            </script>
        ";
        }
        elseif($_SESSION['user_status'] == "user")
        {
            echo 
        "
            <script>
                window.location = 'us_home.php';
            </script>
        ";
        }
        elseif($_SESSION['user_status'] == "wait")
        {
            echo 
        "
            <script>
                alert('Wait for admin accept')
                window.location = 'index.php';
            </script>
        ";
        }
        elseif($_SESSION['user_status'] == "block")
        {
            echo 
        "
            <script>
                alert('Im ban you')
                window.location = 'index.php';
            </script>
        ";
        }
    }
        else
        {
            echo 
        "
            <script>
                 alert('Username OR Password is not found ')
                window.location = 'index.php';
            </script>
        ";
        }
    
    
?>