<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"], input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <!-- Ensure Bootstrap CSS is included -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        include('config.php');
        include('session.php');
        include('us_navbar.php');
    ?>
    <div class="container">
        <h1>Order Form</h1>
        <form action="payment_page.php" method="post" enctype="multipart/form-data">
            <!-- เลือกประเภท -->
            <div class="form-group">
                <label for="category" class="mt-4">Category:</label>
                <select id="category" name="category" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- เลือกสินค้า -->
            <div class="form-group">
                <label for="product">Product:</label>
                <select id="product" name="product" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo htmlspecialchars($product); ?>"><?php echo htmlspecialchars($product); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- สถานะสินค้า -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?php echo htmlspecialchars($status); ?>"><?php echo htmlspecialchars($status); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- เลือกเวลารับสินค้า -->
            <div class="form-group">
                <label for="pickup_time">Pickup Time:</label>
                <input type="datetime-local" id="pickup_time" name="pickup_time" required>
            </div>

            <!-- ช่องสำหรับใส่รูปภาพ -->
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <!-- ปุ่มยืนยันการสั่งจอง -->
            <div class="form-group">
                <input type="submit" value="Confirm Order">
            </div>
        </form>
    </div>
    <!-- Ensure Bootstrap JS and dependencies are included -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
