<?php
session_start();
include('config.php');

// ตรวจสอบว่า session ของตะกร้าสินค้า ('cart') ถูกสร้างขึ้นหรือยัง ถ้ายังให้สร้างใหม่
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// ตรวจสอบว่ามีการส่ง action 'add' มาจากฟอร์มหรือไม่
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $product_id = $_GET['product_id']; // รับค่า product_id
    $quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;  // กำหนดค่า quantity เริ่มต้นเป็น 1 ถ้าไม่มีส่งมา

    // ถ้าสินค้านั้นมีอยู่แล้วในตะกร้า ให้เพิ่มจำนวน
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // ถ้าไม่มีสินค้านั้นอยู่ในตะกร้า ให้เพิ่มใหม่
        $_SESSION['cart'][$product_id] = $quantity;
    }
    
    // หลังจากเพิ่มสินค้าแล้ว กลับไปยังหน้า us_cart.php
    header("Location: us_cart.php");
    exit(); // หยุดการทำงานเพื่อป้องกันการทำงานส่วนอื่น
}

// ตรวจสอบว่ามีการยืนยันคำสั่งซื้อ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    // ตรวจสอบว่ามีการอัปโหลดหลักฐานการชำระเงินหรือไม่
    if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['payment_proof']['tmp_name'];
        $file_name = basename($_FILES['payment_proof']['name']);
        $upload_dir = 'uploads/'; // โฟลเดอร์สำหรับเก็บไฟล์ที่อัปโหลด

        // สร้างโฟลเดอร์ถ้ายังไม่มี
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // ย้ายไฟล์ที่อัปโหลดไปยังโฟลเดอร์ที่กำหนด
        $file_path = $upload_dir . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        // ดำเนินการบันทึกคำสั่งซื้อ
        $order_id = uniqid(); // สร้าง order_id ใหม่
        $product_details = json_encode($_SESSION['cart']);
        $total = $_POST['total'];
        $reservation_time = $_POST['reservation_time'];
        $order_status = 'รอดำเนินการ'; // กำหนดสถานะเริ่มต้น

        // บันทึกข้อมูลลงใน history_tb
        $insert_sql = "INSERT INTO history_tb (user_id, order_id, product_details, total, reservation_time, order_status, payment_proof_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("issssss", $user_id, $order_id, $product_details, $total, $reservation_time, $order_status, $file_path);
        $insert_stmt->execute();
        $insert_stmt->close();

        // เคลียร์ตะกร้าหลังจากสั่งซื้อเสร็จ
        $_SESSION['cart'] = array();

        // เปลี่ยนเส้นทางไปยังหน้า us_home.php พร้อมข้อความ "สั่งซื้อเสร็จสิ้นแล้ว"
        $_SESSION['success_message'] = "สั่งซื้อเสร็จสิ้นแล้ว";
        header("Location: us_home.php");
        exit();
    } else {
        // หากไม่ได้อัปโหลดหลักฐานการชำระเงิน ให้แสดงข้อความแจ้งเตือน
        echo "<script>alert('กรุณาอัปโหลดหลักฐานการชำระเงิน'); window.history.back();</script>";
        exit();
    }
}

$cart = $_SESSION['cart'];
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Shopping Cart</title>
    <style>
        body {
            background-color: #FFF;
            padding-bottom: 100px; /* เพิ่มพื้นที่ด้านล่าง */
        }
        .container {
            margin-bottom: 50px; /* เพิ่มช่องว่างระหว่างเนื้อหาและขอบล่าง */
        }
        .custom-button {
            background-color: #CD853F;
            color: #FFFFFF;
        }
        .btn-secondary {
            background-color: #CD853F;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #663300;
        }
        .modal-dialog {
            margin: auto; /* ทำให้โมดัลอยู่กลางหน้าจอ */
            margin-top: 20%;
        }
        .font-family1 {
            font-family: 'Kanit', sans-serif; /* เพิ่มฟอนต์ Kanit */
        }
        .selected-mook-name {
            width: 250px; /* ขยายความกว้างของช่อง */
            white-space: nowrap; /* ป้องกันไม่ให้ข้อความตัดบรรทัด */
            overflow: hidden; /* ถ้าข้อความยาวเกินขนาดก็จะไม่ล้นออกไป */
            text-overflow: ellipsis; /* แสดง ... เมื่อข้อความยาวเกิน */
        }
        .selected-mook-name {
            padding-left: 15px; /* เพิ่มช่องว่างทางซ้าย */
            padding-right: 15px; /* เพิ่มช่องว่างทางขวา */
            padding-top: 5px; /* เพิ่มช่องว่างทางด้านบน */
            padding-bottom: 5px; /* เพิ่มช่องว่างทางด้านล่าง */
        }
        .message-box {
            flex: 0 0 300px; /* ขนาดคงที่สำหรับรายละเอียด */
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column; /* แนวตั้ง */
            justify-content: space-between; /* ให้เนื้อหาอยู่ในแนวตั้ง */
            background: #FFF8DC;
            font-family: 'Kanit', sans-serif; /* เพิ่มฟอนต์ Kanit */
        }
    </style>
</head>
<body>
    <?php include('us_navbar.php'); 
    $sql_mook = "SELECT * FROM mook_tb";
    $query_mook = $conn->query($sql_mook);
    $mooks = [];
    while ($mook = mysqli_fetch_assoc($query_mook)) {
        $mooks[] = $mook;
    }
    ?>

    <div class="container mt-5">
        <center><h2 class="font-family1" style="color: #663300;">Shopping Cart</h2></center>
        <?php if (empty($cart)) { ?>
            <center><p class="font-family1 color">Your cart is empty.</p></center>
        <?php } else { ?>
            <form id="cartForm" action="us_cart.php" method="post">
                <table class="table">
                <thead>
                    <tr class="font-family1">
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>ราคามุก</th>
                        <th>ราคารวม</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody class="font-family1">
                    <?php
                    $total = 0;
                    foreach ($cart as $product_id => $quantity) {
                        $sql = "SELECT * FROM product_tb WHERE product_id = '$product_id'";
                        $query = $conn->query($sql);
                        $product = mysqli_fetch_array($query);
                        $mookPrice = 0; 
                        $subtotal = ($product['product_price'] + $mookPrice) * (int)$quantity;  
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?=$product['product_name'];?></td>
                        <td>
                            <input type="number" name="quantity[<?=$product_id;?>]" value="<?=$quantity;?>" min="1" class="form-control quantity-input" data-price="<?=$product['product_price'];?>">
                        </td>
                        <td class="product-price font-family1"><?=$product['product_price'];?> ฿</td>
                        <td class="mook-price font-family1"><?=$mookPrice;?> ฿</td>
                        <td class="subtotal font-family1"><?=$subtotal;?> ฿</td>
                        <td>
                        <button type="button" class="btn btn-secondary btn-sm select-mook font-family1" data-product-id="<?=$product_id;?>">เลือกมุก</button>
                            <a href="fn_remove_shopping.php?product_id=<?=$product_id;?>" class="btn btn-danger btn-sm font-family1">Remove</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total</strong></td>
                        <td id="total"><?=$total;?> ฿</td>
                    </tr>
                </tbody>
                </table>

                <!-- Modal for selecting mook -->
                <div class="modal fade font-family1" id="mookSelectionModal" tabindex="-1" aria-labelledby="mookSelectionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mookSelectionModalLabel"><b>เลือกมุก</b></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="mookSelectionContainer">
                                    <?php foreach ($mooks as $mook) { ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="additional_product" id="mook_<?=$mook['mook_id']; ?>" value="<?=$mook['mook_id']; ?>" data-price="<?=$mook['mook_price']; ?>">
                                                <label class="form-check-label" for="mook_<?=$mook['mook_id']; ?>">
                                                    <strong><?=$mook['mook_name']; ?></strong><br>
                                                    <span class="text-muted"><?=$mook['mook_price']; ?> ฿</span><br>
                                                    <!-- แสดงรูปภาพมุก -->
                                                    <img src="<?=$mook['mook_img'];?>" alt="<?=$mook['mook_name'];?>" style="width: 10px; height: 10px; object-fit: cover; border-radius: 20%;">
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="confirmMookSelection">ยืนยันการเลือก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div>
                <div class="mb-3 font-family1">
                    <label for="reservation_time" class="form-label"><b>เลือกเวลาในการจอง</b></label>
                    <input type="datetime-local" id="reservation_time" name="reservation_time" class="form-control">
                    <div id="reservation_warning" class="text-danger mt-2 font-family1" style="display: none;">กรุณาเลือกเวลาจองที่ไม่เป็นเวลาที่ผ่านมา</div>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="mt-5">
                <h2 class="custom-font font-family1">QR Code สำหรับการชำระเงิน</h2>
                <center><img src="img/HEARTROCK_qrcode.png" alt="QR Code" class="img-fluid" width="200px" height="200px" /></center>
                <div class="mt-4">
                    <h3 class="font-family1">กรุณาอัปโหลดหลักฐานการชำระเงิน</h3>
                    <form id="paymentForm" method="POST" enctype="multipart/form-data" class="font-family1">
                        <input type="hidden" name="product_details" value="<?= htmlspecialchars(json_encode($_SESSION['cart'])) ?>" />
                        <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>" />
                        <input type="hidden" name="reservation_time" value="<?= htmlspecialchars($_POST['reservation_time'] ?? '') ?>" />
                        <input type="file" id="payment_proof_image" name="payment_proof_image" accept="image/*" required />
                    </form>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button id="confirm_order" class="btn custom-button font-family1">ยืนยันการสั่งซื้อ</button>
                </div>

            <!-- Image Preview Modal -->
            <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-family1">ภาพสินค้า</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="modalImage" src="" alt="Product Image" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>
    <br>
    <div class="message-box">
        <h2 style="color: red;">คำเตือนก่อนกดสั่งซื้อ</h2>
        <p><b>-</b> ตอนนี้ทางเรายังไม่มีระบบในการคืนเงินเมื่อท่านสั่งซื้อ เช่น เมื่อท่านทำการกดสั่งซื้อแล้วท่านอยากยกเลิกการสั่งออเดอร์ทางเราจะไม่ได้มีการคืนเงินแต่อย่างใด</p>   
        <p><b>-</b> กรุณาตรวจเช็คออเดอร์ของตนเองให้ดีก่อนกดสั่งซื้อ</p>  
        <p><b>-</b> กรุณาตรวจสอบรูปภาพก่อนส่งหรือสั่งออเดอร์</p> 
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Update total and subtotal on quantity change
        $('.quantity-input').on('input', function() {
            var row = $(this).closest('tr');
            var quantity = parseInt($(this).val());
            var price = parseFloat(row.find('.product-price').text());
            var mookPrice = parseFloat(row.find('.mook-price').text());
            
            // Calculate new subtotal
            var newSubtotal = (price + mookPrice) * quantity;
            row.find('.subtotal').text(newSubtotal.toFixed(2) + ' ฿');

            // Update total price
            var total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total.toFixed(2) + ' ฿');
        });

        $(document).ready(function() {
            $('.select-mook').on('click', function() {
                var productId = $(this).data('product-id');
                $('#mookSelectionContainer').empty(); // Clear previous selections

                // Populate modal with mooks for the selected product
                <?php foreach ($mooks as $mook) { ?>
                    $('#mookSelectionContainer').append(
                        '<div class="col-md-4 mb-3">' +
                            '<div class="form-check">' +
                                '<input class="form-check-input" type="radio" name="additional_product_<?php echo $mook['mook_id']; ?>" id="mook_<?php echo $mook['mook_id']; ?>" value="<?php echo $mook['mook_id']; ?>" data-price="<?php echo $mook['mook_price']; ?>" />' +
                                '<label class="form-check-label" for="mook_<?php echo $mook['mook_id']; ?>">' +
                                    '<strong><?php echo $mook['mook_name']; ?></strong><br>' +
                                    '<span class="text-muted"><?php echo $mook['mook_price']; ?> ฿</span>' +
                                '</label>' +
                            '</div>' +
                        '</div>'
                    );
                <?php } ?>

                $('#mookSelectionModal').data('product-id', productId).modal('show');
            });
        });
    });

    
    $(document).ready(function() {
    $('#confirm_order').off('click').on('click', function(e) {
        e.preventDefault();

        var reservationTime = $('#reservation_time').val();
        if (!reservationTime) {
            alert('กรุณาเลือกเวลาจอง');
            return;
        }

        // อัปเดตข้อมูล quantity จาก input fields
        var updatedCart = {};
        $('.quantity-input').each(function() {
            var productId = $(this).attr('name').replace('quantity[', '').replace(']', '');
            var quantity = parseInt($(this).val());
            updatedCart[productId] = quantity;  // เก็บจำนวนสินค้า
        });

        var formData = new FormData();
        var mookSelection = {};
        $('.select-mook').each(function() {
            var productId = $(this).data('product-id');
            var mookName = $(this).closest('tr').find('.mook-price').text().trim() || 'ไม่มีมุก';
            mookSelection[productId] = mookName;
        });
        formData.append('cart', JSON.stringify(updatedCart));
        formData.append('mook', JSON.stringify(mookSelection));
        formData.append('total', $('#total').text().replace(' ฿', '').trim());
        formData.append('reservation_time', reservationTime);
        formData.append('payment_proof_image', $('input[name="payment_proof_image"]')[0].files[0]);

        // ส่งข้อมูลไปที่ save_order.php
        $.ajax({
            url: 'save_order.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response); // ดูข้อมูลตอบกลับจากเซิร์ฟเวอร์
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('สั่งซื้อสำเร็จแล้ว');
                    window.location.href = 'us_home.php'; // เปลี่ยนไปหน้า us_home.php
                } else {
                    alert('เกิดข้อผิดพลาด: ' + result.message);
                }
            },
            error: function() {
                alert('ไม่สามารถสั่งซื้อได้');
            }
        });
    });
});


$('#confirmMookSelection').on('click', function() {
    var selectedMook = $('input[name^="additional_product"]:checked'); // ตรวจสอบว่ามีมุกถูกเลือกหรือไม่
    if (selectedMook.length > 0) {
        var mookName = selectedMook.closest('label').find('strong').text(); // ดึงชื่อมุก
        var mookPrice = parseFloat(selectedMook.data('price')); // ดึงราคามุก
        var productId = $('#mookSelectionModal').data('product-id'); // ดึง ID ของสินค้า

        // อัปเดตชื่อมุกในตาราง
        var row = $('button.select-mook[data-product-id="' + productId + '"]').closest('tr');
        row.find('.selected-mook-name').text(mookName);  // อัปเดตชื่อมุกใน td ที่มี class .selected-mook-name
        row.find('.mook-price').text(mookPrice.toFixed(2) + ' ฿');  // อัปเดตราคามุกใน td ที่มี class .mook-price

        // คำนวณราคารวมใหม่
        var quantity = parseInt(row.find('.quantity-input').val());
        var productPrice = parseFloat(row.find('.product-price').text());
        var newSubtotal = (productPrice + mookPrice) * quantity;
        row.find('.subtotal').text(newSubtotal.toFixed(2) + ' ฿');

        // อัปเดตราคารวมทั้งหมด
        var total = 0;
        $('.subtotal').each(function() {
            total += parseFloat($(this).text());
        });
        $('#total').text(total.toFixed(2) + ' ฿');

        // ปิดโมดัล
        $('#mookSelectionModal').modal('hide');
    } else {
        alert('กรุณาเลือกมุกก่อน');
    }
});


$(document).ready(function() {
        $('#confirm_order').on('click', function(e) {
            e.preventDefault();

            // ตรวจสอบว่าไฟล์หลักฐานการชำระเงินถูกอัปโหลดหรือไม่
            var paymentProofImage = $('#payment_proof_image')[0].files[0];
            if (!paymentProofImage) {
                alert('กรุณาอัปโหลดหลักฐานการชำระเงิน');
                return;
            }

            // ส่งฟอร์มเมื่อข้อมูลครบถ้วน
            $('#paymentForm').submit();
        });
    });

    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
