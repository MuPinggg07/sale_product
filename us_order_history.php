<?php
ob_start();
session_start();
include('config.php');
include('us_navbar.php');

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['user_id'])) {
    header('Location: us_login.php');
    exit();
}

// ยกเลิกคำสั่งซื้อ
if (isset($_GET['cancel_order_id'])) {
    $order_id = $_GET['cancel_order_id'];

    // ตรวจสอบค่าที่ได้รับจาก session และ order_id
    if (empty($order_id) || empty($_SESSION['user_id'])) {
        echo "<script>alert('เกิดข้อผิดพลาด: ข้อมูลไม่สมบูรณ์');</script>";
        exit();
    }

    $delete_sql = "DELETE FROM order_tb WHERE order_id = ? AND user_id = ? AND order_status = 'wait'";
    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param("si", $order_id, $_SESSION['user_id']);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('ยกเลิกออเดอร์สำเร็จ!');</script>";
            } else {
                echo "<script>alert('ไม่มีออเดอร์ที่ตรงกับเงื่อนไข');</script>";
            }
        } else {
            echo "<script>alert('ข้อผิดพลาด SQL: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('ไม่สามารถเตรียมคำสั่ง SQL ได้');</script>";
    }

    header('Location: us_order_history.php');
    exit();
}

// ดึงข้อมูลคำสั่งซื้อ
$sql = "SELECT order_tb.*, user_tb.user_username 
        FROM order_tb 
        JOIN user_tb ON order_tb.user_id = user_tb.user_id
        WHERE order_tb.order_status = 'wait'";
$result = $conn->query($sql);

if (!$result) {
    die('Error executing query: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center; 
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #FFF8DC;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .payment-proof {
            width: 100px;
            height: auto;
            cursor: pointer;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 14px;
                box-shadow: none;
            }
            thead {
                display: none;
            }
            tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 8px;
            }
            tbody td {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                border: none;
            }
            tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 10px;
                flex-shrink: 0;
            }
            .payment-proof {
                width: 80px;
                height: auto;
            }
            .btn-cancel {
                font-size: 12px;
                padding: 5px 8px;
            }
            .modal-body img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <h2>การสั่งซื้อ</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>รูปภาพการชำระเงิน</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>ยอดรวม (฿)</th>
                    <th>วันที่จอง</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php
                        $imageSrc = 'payment_proof_image/' . htmlspecialchars($row['payment_proof_image']); 
                        if (!empty($row['payment_proof_image']) && file_exists($imageSrc)) {
                            echo "<img src='$imageSrc' class='payment-proof' alt='Payment Proof' onclick='showImage(\"$imageSrc\")'>";
                        } else {
                            echo "No Image";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $product_details = json_decode($row['product_details'], true); 
                        if (!empty($product_details)) {
                            $product_ids_str = implode(",", array_map('intval', array_keys($product_details))); 
                            $product_query = "SELECT product_id, product_name FROM product_tb WHERE product_id IN ($product_ids_str)";
                            $product_result = $conn->query($product_query);

                            if ($product_result->num_rows > 0) {
                                while ($product_row = $product_result->fetch_assoc()) {
                                    $product_id = $product_row['product_id'];
                                    $product_name = $product_row['product_name'];
                                    $quantity = $product_details[$product_id];
                                    echo "$product_name x$quantity<br>";
                                }
                            } else {
                                echo "ไม่พบข้อมูลสินค้า";
                            }
                        } else {
                            echo "ไม่มีรายละเอียดสินค้า";
                        }
                        ?>
                    </td>
                    <td><?php echo $row['total']; ?>฿</td>
                    <td>
                        <?php 
                            list($date, $time) = explode(' ', $row['reservation_time']); 
                            echo "<span><b>วันที่จอง:</b> $date</span><br>";
                            echo "<span><b>เวลาจอง:</b> $time</span>";
                        ?>
                    </td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td>
                        <a href="us_order_history.php?cancel_order_id=<?php echo $row['order_id']; ?>" 
                           onclick="return confirm('คุณต้องการยกเลิกออเดอร์นี้หรือไม่?');">
                            <button class="btn-cancel font-family">ยกเลิกออเดอร์</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p style="text-align: center;">ยังไม่มีประวัติการสั่งซื้อ</p>
    <?php } ?>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ภาพการชำระเงิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Payment Proof" class="rounded" style="max-width: 80%; height: auto;">
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showImage(imageSrc) {
            $('#modalImage').attr('src', imageSrc);
            $('#imagePreviewModal').modal('show');
        }
    </script>
</body>
</html>
