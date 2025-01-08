<?php
    include('config.php');

    $user_id = $_REQUEST['user_id'];

    $sql = "UPDATE user_tb SET user_status = 'block' WHERE user_id = '$user_id'";
    $conn->query($sql);

    echo
    "
        <script>
            alert('มึงเตรียมตัวโดนทืบ');
            window.location = 'ad_user_manage.php';
        </script>
    ";
?>