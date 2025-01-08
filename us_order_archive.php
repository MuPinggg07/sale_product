<?php
session_start();
include('config.php');
include('us_navbar.php');

$user_id = $_SESSION['user_id'];

// Query for accepted orders
$sql = "SELECT order_tb.*, user_tb.user_username 
        FROM order_tb 
        JOIN user_tb ON order_tb.user_id = user_tb.user_id
        WHERE order_tb.order_status = 'accepted'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        .table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #FFF8DC !important; /* ใช้ !important เพื่อให้แน่ใจว่าค่านี้ถูกบังคับใช้ */
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
        }

        .table th, .table td {
            background-color: #FFF8DC !important; /* กำหนดสีพื้นหลังให้ตรงกับตาราง */
            text-align: center;
            vertical-align: middle;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .th, td {
            text-align: center; /* จัดข้อความให้อยู่ตรงกลางในแนวนอน */
            vertical-align: middle; /* จัดข้อความให้อยู่ตรงกลางในแนวตั้ง */
            padding: 12px;
            border: 1px solid #ddd;
        }
        .payment-proof {
            width: 100px;
            height: auto;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>ประวัติการสั่งซื้อ</h2>

    <?php if ($result->num_rows > 0) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th>รูปภาพการชำระเงิน</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>ยอดรวม (฿)</th>
                    <th>วันที่จอง</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php
                        $imageSrc = 'payment_proof_image/' . htmlspecialchars($row['payment_proof_image']);
                        if (!empty($row['payment_proof_image']) && file_exists($imageSrc)) {
                            echo "<img src='$imageSrc' class='payment-proof' onclick='showImage(\"$imageSrc\")'>";
                        } else {
                            echo "ไม่มีรูป";
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
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p style="text-align: center;">ยังไม่มีออเดอร์ในประวัติ</p>
    <?php } ?>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ภาพการชำระเงิน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Payment Proof" class="rounded" style="max-width: 80%; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showImage(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            var modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            modal.show();
        }
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
