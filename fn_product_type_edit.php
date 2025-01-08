<?php
    include('config.php');

    $product_type_id = $_POST['product_type_id'];
    $product_type_id = $_POST['product_type_id'];

    $sql = "UPDATE product_type_tb SET product_type_name = '$product_type_name' WHERE  product_type_id = '$product_type_id'";
    $UPDATE = $conn->query($sql);

    echo
    "
        <script>
            alert('แก้ไขให้แล้วนะค้าบผม');
            window.location = 'ad_product_type.php';
        </script>
    ";
?>