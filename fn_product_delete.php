<?php
    include('config.php');

    $product_id = $_REQUEST['product_id'];

    $sql = "DELETE FROM product_tb WHERE product_id = '$product_id'";
    

   $DELETE = $conn->query($sql);

    echo
    "
        <script>
        alert('Delete success');
        window.location = 'ad_allproduct.php';
        </script>
    "
?>