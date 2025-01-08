<?php
    include('config.php');

    $user_id = $_REQUEST['user_id'];

    $sql = "UPDATE user_tb SET user_status = 'user' WHERE user_id = '$user_id' AND user_status = 'block'";
    $conn->query($sql);

    echo
    "
        <script>
            alert('ถือว่ากูให้โอกาศ');
            window.location = 'ad_user_manage.php';
        </script>
    ";
?>