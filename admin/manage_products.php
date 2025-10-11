<?php
@include 'config.php';
session_start();

// Xác thực người dùng là admin
if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit;
}

// Xóa sản phẩm
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'");
    header('location: manage_products.php');
    exit;
}

// Lấy tháng và năm hiện tại
$current_month = date('m');
$current_year = date('Y');
$last_month = date('m', strtotime('-1 month'));
$last_year = date('Y', strtotime('-1 month'));

// Truy vấn doanh thu tháng hiện tại (Chuyển đổi `placed_on` thành DATE nếu cần)
$query_current = "SELECT SUM(total_price) as revenue 
                  FROM orders 
                  WHERE STR_TO_DATE(placed_on, '%d-%b-%Y') >= DATE_FORMAT(NOW(), '%Y-%m-01') 
                  AND STR_TO_DATE(placed_on, '%d-%b-%Y') < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)";
$result_current = mysqli_query($conn, $query_current);
$row_current = mysqli_fetch_assoc($result_current);
$current_revenue = $row_current['revenue'] ? $row_current['revenue'] : 0;

// Truy vấn doanh thu tháng trước (Chuyển đổi `placed_on` thành DATE nếu cần)
$query_last = "SELECT SUM(total_price) as revenue 
               FROM orders 
               WHERE STR_TO_DATE(placed_on, '%d-%b-%Y') >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH) 
               AND STR_TO_DATE(placed_on, '%d-%b-%Y') < DATE_FORMAT(NOW(), '%Y-%m-01')";
$result_last = mysqli_query($conn, $query_last);
$row_last = mysqli_fetch_assoc($result_last);
$last_revenue = $row_last['revenue'] ? $row_last['revenue'] : 0;

// Tính tỷ lệ thay đổi doanh thu
$percent_change = ($last_revenue > 0) ? (($current_revenue - $last_revenue) / $last_revenue) * 100 : 0;
$change_text = ($percent_change >= 0) ? "Tăng " . number_format(abs($percent_change), 2) . "%" : "Giảm " . number_format(abs($percent_change), 2) . "%";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/manage_products_style.css">
    <style>
        .button-group {
            text-align: center;
            margin-bottom: 20px;
        }
        .button-group a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
        }
        .button-group a.statistics {
            background-color: #007BFF;
        }
        .stats-box {
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            font-size: 18px;
        }
        .increase {
            color: green;
        }
        .decrease {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Manage Products</h1>
    <div class="button-group">
    <a href="add_product.php">Add New Product</a>
    <a href="admin_dashboard.php" class="statistics">Thống kê doanh thu</a>
</div>

    <div id="revenue" class="stats-box">
        <h3>Doanh thu tháng <?php echo $current_month; ?>/<?php echo $current_year; ?>: <strong><?php echo number_format($current_revenue); ?> VND</strong></h3>
        <h3>Doanh thu tháng <?php echo $last_month; ?>/<?php echo $last_year; ?>: <strong><?php echo number_format($last_revenue); ?> VND</strong></h3>
        <h3>
            So với tháng trước: 
            <strong class="<?php echo ($percent_change >= 0) ? 'increase' : 'decrease'; ?>">
                <?php echo $change_text; ?>
            </strong>
        </h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);
            while ($product = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td><img src='flowers/{$product['image']}' alt='{$product['name']}' style='width: 100px; height: auto;'></td>
                    <td>{$product['name']}</td>
                    <td>" . number_format($product['price']) . " VND</td>
                    <td>
                        <a href='edit_product.php?edit={$product['id']}'>Edit</a>
                        <a href='?delete={$product['id']}' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                    </td>
                  </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
