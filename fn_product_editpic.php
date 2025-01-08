<?php
    include('config.php');

    $product_id = $_POST ['product_id'];

    if(isset($_FILES['img']['name'])){
        $img = uniqid().".".pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
        $path = "product_img/";
        move_uploaded_file($_FILES['img']['tmp_name'],$path.$img);
    }

    $sql = "UPDATE product_tb SET product_img = '$img' WHERE product_id = '$product_id'";
    $conn->query($sql);

    echo"
    <script>
        alert('แก้ไขรูปภาพเรียบร้อยแล้วครับ');
        window.location = 'ad_allproduct.php';
        </script>
        ";
?>