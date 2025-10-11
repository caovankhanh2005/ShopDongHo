<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_GET['edit'])) {
    header('location:login.php');
    exit;
}

$product_id = $_GET['edit'];
$product_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
$product = mysqli_fetch_assoc($product_query);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        move_uploaded_file($image_tmp, "flowers/$image");
    } else {
        $image = $product['image']; // Use existing image if no new one is uploaded
    }

    mysqli_query($conn, "UPDATE products SET name = '$name', price = '$price', details = '$details', image = '$image' WHERE id = '$product_id'");
    header('location: manage_products.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/edit_product_style.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">

        <label for="details">Details:</label>
        <textarea id="details" name="details"><?php echo htmlspecialchars($product['details']); ?></textarea>

        <label for="image">Product Image:</label>
        <img src="flowers/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="width: 100px;">
        <input type="file" id="image" name="image">

        <input type="submit" value="Update Product" name="update">
        <a href="manage_products.php" class="btn">Back to Manage Products</a>
    </form>
</body>
</html>
