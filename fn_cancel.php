<?php
    include('config.php');

    $user_id = $_REQUEST['user_id'];

    $sql = "DELETE FROM user_tb WHERE user_id = '$user_id'";
    

   $DELETE = $conn->query($sql);

    echo
    "
        <script>
        alert('Delete success');
        window.location = 'ad_user_regis.php';
        </script>
    "
?>