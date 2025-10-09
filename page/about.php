<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Lựa Chọn Hàng Đầu</h3>
        <p><a href="home.php">Trang chủ</a> / Chi tiết</p>
    </section>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/s1t.png" alt="">
            </div>
            <div class="content">
                <h3>Tại Sao Chọn Watch Shop?</h3>
                <p>Watch Shop là địa chỉ đáng tin cậy dành cho những ai yêu thích đồng hồ chính hãng từ các thương hiệu danh tiếng như Rolex, Omega, Seiko, Tissot, Citizen, và nhiều thương hiệu cao cấp khác. Chúng tôi cam kết cung cấp sản phẩm chất lượng, bảo hành minh bạch, và dịch vụ hậu mãi tận tâm.</p>
            </div>
        </div>

        <div class="flex">
            <div class="content">
                <h3>Chúng Tôi Cung Cấp Gì?</h3>
                <p>Chúng tôi cung cấp đa dạng các dòng đồng hồ: từ đồng hồ cơ automatic, đồng hồ năng lượng ánh sáng, đến các dòng thể thao, thời trang và lặn chuyên dụng. Tất cả sản phẩm đều có chứng nhận chính hãng, đi kèm dịch vụ kiểm định và bảo hành uy tín.</p>
            </div>
            <div class="image">
                <img src="images/s4t.jpg" alt="">
            </div>
        </div>

        <div class="flex"> 
            <div class="image">
                <img src="images/s5t.jpg" alt="">
            </div>
            <div class="content">
                <h3>Vì Sao Khách Hàng Tin Tưởng Chúng Tôi?</h3>
                <p>Sự uy tín của Watch Shop đến từ việc chúng tôi luôn đặt khách hàng làm trung tâm. Với đội ngũ nhân viên hiểu biết sâu về đồng hồ, chính sách đổi trả linh hoạt, và hỗ trợ tư vấn tận tình 24/7, chúng tôi cam kết mang lại trải nghiệm mua sắm cao cấp và đáng tin cậy cho mọi khách hàng.</p>
            </div>
        </div>
    </section>

    <?php @include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
