<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Xử lý thêm vào danh sách yêu thích
if (isset($_POST['add_to_wishlist'])) {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';

    if ($product_id && $product_name && $product_price && $product_image) {
        $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist) > 0) {
            $message[] = 'Sản phẩm này đã có trong danh sách yêu thích!';
        } elseif (mysqli_num_rows($check_cart) > 0) {
            $message[] = 'Sản phẩm này đã có trong giỏ hàng!';
        } else {
            mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) 
            VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'Đã thêm sản phẩm vào danh sách yêu thích!';
        }
    }
}

// Xử lý thêm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';
    $product_quantity = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : 1;

    if ($product_id && $product_name && $product_price && $product_image) {
        $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_cart) > 0) {
            $message[] = 'Sản phẩm này đã có trong giỏ hàng!';
        } else {
            $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

            if (mysqli_num_rows($check_wishlist) > 0) {
                mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
            }
            mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) 
            VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'Đã thêm sản phẩm vào giỏ hàng!';
        }
    }
}

// Lọc sản phẩm theo danh mục
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT * FROM `products`";
if ($category_filter != '' && $category_filter != 'all') {
    $query .= " WHERE category = '$category_filter'";
}
$select_products = mysqli_query($conn, $query) or die('query failed');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .category-selector {
            margin: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .category-selector label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }
        .category-selector select {
            width: 100%;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: white;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .category-selector select:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.25);
        }
    </style>
    <script>
        function filterCategory() {
            var category = document.getElementById("watch-category").value;
            window.location.href = "shop.php?category=" + category;
        }
    </script>
</head>

<body>
    <?php @include 'header.php'; ?>
    <section class="heading">
        <h3>Shop</h3>
        <p><a href="home.php">Trang chủ</a> / shop</p>
    </section>

    <section class="products">
        <h1 class="title">Các sản phẩm của chúng tôi</h1>
        <div class="category-selector">
    <label for="watch-category">Chọn loại đồng hồ:</label>
    <select id="watch-category" name="category" onchange="filterCategory()">
        <option value="all">Tất cả</option>
        <option value="Đồng hồ cơ Thụy Sĩ">Đồng hồ cơ Thụy Sĩ</option>
        <option value="Đồng hồ cơ Nhật Bản">Đồng hồ cơ Nhật Bản</option>
        <option value="Đồng hồ automatic">Đồng hồ automatic</option>
        <option value="Đồng hồ thể thao">Đồng hồ thể thao</option>
        <option value="Đồng hồ năng lượng mặt trời">Đồng hồ năng lượng mặt trời</option>
        <option value="Đồng hồ dresswatch">Đồng hồ dresswatch</option>
        <option value="Đồng hồ thời trang">Đồng hồ thời trang</option>
        <option value="Đồng hồ lặn">Đồng hồ lặn</option>
        <option value="Đồng hồ sang trọng">Đồng hồ sang trọng</option>
        <option value="Đồng hồ phổ thông">Đồng hồ phổ thông</option>
        <option value="Đồng hồ vintage">Đồng hồ vintage</option>
        <option value="Đồng hồ doanh nhân">Đồng hồ doanh nhân</option>
        <option value="Đồng hồ chronograph">Đồng hồ chronograph</option>
        <option value="Đồng hồ giá rẻ">Đồng hồ giá rẻ</option>
        <option value="Đồng hồ nam tính">Đồng hồ nam tính</option>
        <option value="Đồng hồ cao cấp">Đồng hồ cao cấp</option>
        <option value="Đồng hồ lộ cơ">Đồng hồ lộ cơ</option>
    </select>
</div>

        <div class="box-container">
            <?php while ($fetch_products = mysqli_fetch_assoc($select_products)) { ?>
                <form action="" method="POST" class="box">
                    <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                    <div class="price">$<?php echo $fetch_products['price']; ?></div>
                    <img src="./flowers/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <input type="submit" value="Thêm yêu thích" name="add_to_wishlist" class="option-btn">
                    <input type="submit" value="Thêm giỏ hàng" name="add_to_cart" class="btn">
                </form>
            <?php } ?>
        </div>
    </section>
</body>
</html>
