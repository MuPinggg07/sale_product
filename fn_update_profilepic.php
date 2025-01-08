<?php
    include('config.php');

    $user_id = $_POST ['user_id'];

    if(isset($_FILES['img']['name'])){
        $img = uniqid().".".pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
        $path = "user_img/";
        move_uploaded_file($_FILES['img']['tmp_name'],$path.$img);
    }

    $sql = "UPDATE user_tb SET user_img = '$img' WHERE user_id = '$user_id'";
    $conn->query($sql);

    echo"
    <script>
        alert('แก้ไขรูปภาพเรียบร้อยแล้วครับ');
        window.location = 'us_profile.php';
        </script>
        ";
?>