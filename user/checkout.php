<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['order'])) {

    $name = trim($_POST['name']);
    $number = trim($_POST['number']);
    $email = trim($_POST['email']);
    $method = $_POST['method'];
    $address = trim($_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country']);
    $placed_on = date('d-M-Y');

    // Kiểm tra lỗi nhập
    $errors = [];

    if (!preg_match("/^[a-zA-ZÀ-Ỹà-ỹ\s]+$/u", $name)) {
        $errors[] = "Tên chỉ được chứa chữ cái và khoảng trắng!";
    }

    if (!preg_match("/^[0-9]{10}$/", $number)) {
        $errors[] = "Số điện thoại phải có đúng 10 chữ số!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ!";
    }

    $cart_total = 0;
    $cart_products = [];

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    if ($cart_total == 0) {
        $errors[] = "Giỏ hàng của bạn đang trống!";
    }

    if (empty($errors)) {
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) 
        VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');

        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

        $message[] = "Đơn hàng của bạn đã được đặt thành công!";
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .checkout-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .checkout-form h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .form-group input, .form-group select {
            width: 48%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.2);
            outline: none;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #28a745;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #218838;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Thanh toán</h3>
        <p><a href="home.php">Trang chủ</a> / Thanh toán</p>
    </section>

    <section class="checkout">
        <form action="" method="POST" class="checkout-form">
            <h3>Thông tin thanh toán</h3>

            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p class='error-message'>$error</p>";
                }
            }
            ?>

            <div class="form-group">
                <input type="text" name="name" placeholder="Nhập họ và tên" required>
                <input type="text" name="number" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Nhập email" required>
                <select name="method" required>
                    <option value="cash on delivery">Thanh toán khi nhận hàng</option>
                    <option value="credit card">Thẻ tín dụng</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank transfer">Chuyển khoản ngân hàng</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="flat" placeholder="Tên căn hộ / số nhà" required>
                <input type="text" name="street" placeholder="Tên đường" required>
            </div>
            <div class="form-group">
                <input type="text" name="city" placeholder="Thành phố" required>
                <input type="text" name="country" placeholder="Quốc gia" required>
            </div>

            <input type="submit" name="order" value="Đặt hàng ngay" class="btn-submit">
        </form>
    </section>

    <?php @include 'footer.php'; ?>
    <script src="js/script.js"></script>

</body>

</html>
