<?php
    include('config.php');

    $product_type_id = $_REQUEST['product_type_id'];

    $sql = "DELETE FROM product_type_tb WHERE product_type_id = '$product_type_id'";
    

   $DELETE = $conn->query($sql);

    echo
    "
        <script>
        alert('Delete success');
        window.location = 'ad_product_type.php';
        </script>
    "
?>