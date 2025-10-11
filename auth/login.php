<?php
@include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));
    $login_as_admin = isset($_POST['login_as_admin']);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'");

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
        if ($login_as_admin && $row['user_type'] == 'admin') {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            header('location:manage_products.php');
            exit;
        } elseif (!$login_as_admin && $row['user_type'] == 'user') {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header('location:home.php');
            exit;
        } else {
            $message[] = 'Quyền truy cập không hợp lệ hoặc thông tin không đúng';
        }
    } else {
        $message[] = 'Email hoặc mật khẩu không đúng!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <section class="form-container">
        <form action="" method="post">
            <h3>Đăng nhập</h3>
            <input type="email" name="email" class="box" placeholder="Nhập email" required>
            <input type="password" name="pass" class="box" placeholder="Nhập password" required>
            <div class="admin-check">
                <input type="checkbox" name="login_as_admin" id="login_as_admin">
                <label for="login_as_admin">Đăng nhập như Admin</label>
            </div>
            <input type="submit" class="btn" name="submit" value="Đăng nhập">
            <p>Bạn đã có tài khoản chưa? <a href="register.php">Đăng ký ngay</a></p>
        </form>
    </section>
</body>
</html>
