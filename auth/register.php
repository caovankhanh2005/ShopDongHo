<?php

@include 'config.php';

if (isset($_POST['submit'])) {

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_sdt = filter_var($_POST['sdt'], FILTER_SANITIZE_STRING);
   $sdt = mysqli_real_escape_string($conn, $filter_sdt);
   $filter_diachi = filter_var($_POST['diachi'], FILTER_SANITIZE_STRING);
   $diachi = mysqli_real_escape_string($conn, $filter_diachi);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'tên người dùng đã tồn tại !';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Mật khẩu không trùng khớp ! !';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password,sdt,diachi) VALUES('$name', '$email', '$pass','$sdt','$diachi')") or die('query failed');
         $message[] = 'đăng kí thành công !';
         header('location:login.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
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
         <h3>Tạo tài khoản</h3>
         <input type="text" name="name" class="box" placeholder="Tên Đăng Nhập" required>
         <input type="email" name="email" class="box" placeholder="Email" required>
         <input type="password" name="pass" class="box" placeholder="Mật khẩu" required>
         <input type="password" name="cpass" class="box" placeholder="Nhập lại mật khẩu" required>
         <input type="sdt" name="sdt" class="box" placeholder="Nhập số điệnn thoại" required>
         <input type="diachi" name="diachi" class="box" placeholder="Nhập địa chỉ" required>
         <input type="submit" class="btn" name="submit" value="Đăng kí">
         <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
      </form>

   </section>

</body>

</html>