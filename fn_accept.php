<?php
    include('config.php');

    $user_id = $_REQUEST['user_id'];

    $sql = "UPDATE user_tb SET user_status = 'user' WHERE user_id = '$user_id'";
    $conn->query($sql);

    echo
    "
        <script>
            alert('อนุมัติผู้สมัคเรียบร้อบแล้วนะฮ้าบฟุ้วว...');
            window.location = 'ad_user_regis.php';
        </script>
    ";
?>