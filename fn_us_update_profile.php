<?php
    include('config.php');

    $user_id = $_POST['user_id'];
    $user_fname = $_POST['user_fname'];
    $user_sname = $_POST['user_sname'];
    $user_tel = $_POST['user_tel'];
   

        $sql = "UPDATE user_tb SET 
                user_fname = '$user_fname',
                user_sname = '$user_sname',
                user_tel = '$user_tel'
                WHERE user_id = '$user_id'";
        $conn->query($sql);

    echo"
        <script>
        alert('แก้ไขรายละเอียดเรียบร้อยแล้วครับ');
        window.location = 'us_profile.php';
        </script>
    ";

?>