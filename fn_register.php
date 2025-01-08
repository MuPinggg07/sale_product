<?php
include("config.php");

$user_fname = $_POST['user_fname'];
$user_sname = $_POST['user_sname'];
$user_tel = $_POST['user_tel'];
$user_username = $_POST['user_username'];
$user_password = $_POST['user_password'];
$user_password2 = $_POST['user_password2'];

if($user_password == $user_password2){
    if(isset($_FILES['img']['name'])){
        $img = uniqid().".".pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
        $path = "user_img/";
        move_uploaded_file($_FILES['img']['tmp_name'],$path.$img);
    }

    $sql = "INSERT INTO user_tb VALUES(NULL, '$user_fname', '$user_sname', '$user_tel', '$user_username', '$user_password', '$img', 'wait')";
    mysqli_query($conn, $sql);

    echo "
        <script>
            alert('SUCCESS');
            window.location = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('PASSWORD NOT MATCH');
            history.back();
        </script>
    ";
}
?>