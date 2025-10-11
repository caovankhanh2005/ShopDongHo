<?php
@include 'config.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có phải là admin không
if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit;
}
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image_name = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $uploaded_image_path = 'flowers/' . $image_name; // Đường dẫn lưu ảnh

    if (!empty($name) && !empty($description) && !empty($price) && !empty($image_name)) {
        if (move_uploaded_file($image_temp, $uploaded_image_path)) {
            $insert_query = "INSERT INTO products (name, details, price, image) VALUES ('$name', '$description', '$price', '$image_name')";
            if (mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Product added successfully!'); window.location.href='manage_products.php';</script>";
            } else {
                echo "<script>alert('Failed to add product.');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image. Check file permissions and file size.');</script>";
        }
    } else {
        echo "<script>alert('All fields must be filled.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/add_product_style.css">
</head>
<body>
    <h2>Add New Product</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" required>

        <input type="submit" name="submit" value="Add Product">
    </form>
</body>
</html>
