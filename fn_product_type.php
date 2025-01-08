<?php
    include('config.php');

    $product_type_name = $_POST['product_type_name'];

    $sql = "INSERT INTO product_type_tb VALUES (NULL, '$product_type_name')";
    $conn->query($sql);

    echo
    "
        <script>
            alert('เพิ่มประเภทสินค้าเรียบร้อยแล้ว..');
            window.location = 'ad_product_type.php';
        </script>
    ";
?>