<?php
session_start();

include('config.php');

// เปิดการแสดงข้อผิดพลาด (สำหรับ debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบการส่งข้อมูลผ่าน AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    header('Content-Type: application/json');

    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'] ?? '';

    if ($action === 'accept') {
        // ฟังก์ชันยอมรับ: อัปเดตสถานะใน `order_tb` เป็น 'accepted'
        $update_status = $conn->prepare("UPDATE order_tb SET order_status = 'accepted' WHERE order_id = ?");
        $update_status->bind_param("i", $order_id);

        if ($update_status->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'ออเดอร์ได้รับการยอมรับ']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถยอมรับออเดอร์ได้: ' . $conn->error]);
        }

        $update_status->close();
    } elseif ($action === 'delete') {
        // ฟังก์ชันยกเลิก: ลบออเดอร์จาก `order_tb`
        $delete_order = $conn->prepare("DELETE FROM order_tb WHERE order_id = ?");
        $delete_order->bind_param("i", $order_id);

        if ($delete_order->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'ออเดอร์ถูกยกเลิกเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถยกเลิกออเดอร์ได้: ' . $conn->error]);
        }

        $delete_order->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Action ไม่ถูกต้อง']);
    }

    $conn->close();
    exit();
}
$sql = "SELECT 
            order_tb.*, 
            user_tb.user_username, 
            GROUP_CONCAT(mook_tb.mook_name SEPARATOR ', ') AS mook_names
        FROM 
            order_tb
        JOIN 
            user_tb ON order_tb.user_id = user_tb.user_id
        LEFT JOIN 
            mook_tb ON FIND_IN_SET(mook_tb.mook_id, order_tb.mook_id)
        WHERE 
            order_tb.order_status = 'wait'
        GROUP BY 
            order_tb.order_id";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title class="">Order List</title>
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Kanit', sans-serif;
        }
        h2 { margin-top: 20px; text-align: center; }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #FFF8DC;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center; 
            padding: 12px; 
            vertical-align: middle;
        }
        .payment-proof { 
            cursor: pointer; 
            max-width: 100px; 
            max-height: 100px; 
        }
        .block-btn { 
            background-color: #ff4d4d;
            color: white; 
            border: none; 
            padding: 5px 15px; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        .block-btn:hover { 
            background-color: #e60000; 
        }
        .accept-btn {
            background-color: #28a745; 
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        td { text-align: center; vertical-align: middle; }
        .accept-btn:hover { 
            background-color: #218838; 
        }
        .button-group {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            gap: 15px; 
        }
    </style>
</head>
<body>
    <?php
    include('config.php');
    include('ad_navbar.php');

    // ดึงข้อมูลออเดอร์เพื่อแสดงผลในตาราง
        $sql = "SELECT order_tb.*, user_tb.user_username 
        FROM order_tb 
        JOIN user_tb ON order_tb.user_id = user_tb.user_id
        WHERE order_tb.order_status = 'wait'";
        $result = $conn->query($sql);
    ?>
    
    <div class="container">
        <h2>Order List</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>User Name</th>
                        <th>Product Details</th>
                        <th>Total</th>
                        <th>Reservation Time</th>
                        <th>Payment Proof</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { 
                        $imageSrc = 'payment_proof_image/' . htmlspecialchars($row['payment_proof_image']); ?>
                        <tr id="order-row-<?php echo $row['order_id']; ?>">
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['user_username']); ?></td>
                            <td>
                                <?php 
                                    // แยก product_name และ mook_name
                                    $product_names = explode(',', $row['product_name']);
                                    $mook_names = explode(',', $row['mook_name']);

                                    // ตรวจสอบให้แน่ใจว่า mook_name ไม่มีค่าผิดปกติ
                                foreach ($mook_names as &$mook_name) {
                                    $mook_name = trim($mook_name);
                                    if (!empty($mook_name) && !is_string($mook_name)) {
                                        $mook_name = 'ไม่มีมุก'; // หากมีค่าไม่ถูกต้อง ให้แสดงเป็น "ไม่มีมุก"
                                    }
                                }
                                    // รวมชื่อสินค้าและมุก
                                    $product_details = [];
                                    foreach ($product_names as $index => $product_name) {
                                        // ตรวจสอบว่ามุกมีอยู่หรือไม่
                                        $mook_name = isset($mook_names[$index]) ? trim($mook_names[$index]) : 'ไม่มีมุก';
                                        $product_details[] = htmlspecialchars(trim($product_name)) . ' (มุก: ' . htmlspecialchars(trim($row['mook_name'])) . ')';
                                    }

                                    // แสดงข้อมูลแต่ละรายการในบรรทัดใหม่
                                    echo implode('<br>', $product_details);
                                ?>
                            </td>
                            <td><?php echo $row['total']; ?> ฿</td>
                            <td><?php 
                                    list($date, $time) = explode(' ', $row['reservation_time']); 
                                    echo "<span><b>วันที่จอง:</b> $date</span><br>";
                                    echo "<span><b>เวลาจอง:</b> $time</span>";
                                ?>
                        </td>
                            <td>
                                <?php if (!empty($row['payment_proof_image']) && file_exists($imageSrc)) { ?>
                                    <img src="<?php echo $imageSrc; ?>" class="payment-proof" onclick='showImage("<?php echo $imageSrc; ?>")'>
                                <?php } else { echo "No Image"; } ?>
                            </td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td>
                                <div class="button-group">
                                <button class="accept-btn" onclick="acceptOrder(<?php echo $row['order_id']; ?>)">ยอมรับ</button>
                                <button class="block-btn" onclick="deleteOrder(<?php echo $row['order_id']; ?>)">ยกเลิก</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No orders found.</p>
        <?php } ?>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Proof</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="proofImage" src="" alt="Payment Proof" class="img-fluid rounded" style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showImage(src) {
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            document.getElementById('proofImage').src = src;
            imageModal.show();
        }  

        function acceptOrder(orderId) {
        if (confirm('คุณต้องการยอมรับออเดอร์นี้หรือไม่?')) {
            $.ajax({
                url: 'ad_order.php', // ไฟล์ PHP สำหรับจัดการคำขอ
                type: 'POST',
                data: { order_id: orderId, action: 'accept' },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // อัปเดตแถวในตาราง เช่น เปลี่ยนสถานะ
                        const row = document.getElementById('order-row-' + orderId);
                        if (row) {
                            const statusCell = row.querySelector('td:nth-child(7)');
                            if (statusCell) {
                                statusCell.textContent = 'accepted';
                            }
                            // ซ่อนปุ่มเมื่อยอมรับสำเร็จ
                            const buttons = row.querySelector('.button-group');
                            if (buttons) {
                                buttons.style.display = 'none';
                            }
                        }
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('เกิดข้อผิดพลาด');
                }
            });
        }
    }
    function acceptOrder(orderId) {
    if (confirm('คุณต้องการยอมรับออเดอร์นี้หรือไม่?')) {
        $.ajax({
            url: 'ad_order.php', // ไฟล์ PHP สำหรับจัดการคำขอ
            type: 'POST',
            data: { order_id: orderId, action: 'accept' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    // ลบแถวที่มี orderId ออกจากตาราง
                    const row = document.getElementById('order-row-' + orderId);
                    if (row) {
                        row.remove();
                    }
                } else {
                    alert('เกิดข้อผิดพลาด: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert('เกิดข้อผิดพลาด');
            }
        });
    }
}
function deleteOrder(orderId) {
    if (confirm('คุณต้องการยกเลิกออเดอร์นี้หรือไม่?')) {
        $.ajax({
            url: 'ad_order.php', // ไฟล์ PHP ที่จัดการคำขอ
            type: 'POST',
            data: { order_id: orderId, action: 'delete' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    // ลบแถวออกจากตาราง
                    const row = document.getElementById('order-row-' + orderId);
                    if (row) {
                        row.remove();
                    }
                } else {
                    alert('เกิดข้อผิดพลาด: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert('เกิดข้อผิดพลาด');
            }
        });
    }
}

    </script>
</body>
</html>
