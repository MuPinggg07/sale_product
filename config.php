<?php
    $host = "localhost";
    $config_user = "root";
    $config_password = "";
    $config_db = "sale_product_db";

    //config
    $conn = mysqli_connect($host, $config_user, $config_password, $config_db);
    mysqli_set_charset($conn, "utf8");

    //set time
    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-M-D"); 
    $time = date("H:I:S");

    //No DB
    if(!$conn)
    {
        echo "no connect DB";
    }
?>
