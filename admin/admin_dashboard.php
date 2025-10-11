<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit;
}

// Lọc tháng/năm từ người dùng
$filter_month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$filter_year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Thống kê chung
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE user_type='user'"))['total'];

// Doanh thu từng tháng
$monthly_data = [];
for ($i = 1; $i <= 12; $i++) {
    $q = "SELECT SUM(total_price) as revenue FROM orders 
          WHERE MONTH(STR_TO_DATE(placed_on, '%d-%b-%Y')) = $i 
          AND YEAR(STR_TO_DATE(placed_on, '%d-%b-%Y')) = $filter_year";
    $r = mysqli_query($conn, $q);
    $monthly_data[] = mysqli_fetch_assoc($r)['revenue'] ?? 0;
}

// Đơn hàng theo trạng thái
$status_data = [];
$status_query = mysqli_query($conn, "SELECT payment_status, COUNT(*) as total FROM orders GROUP BY payment_status");
while ($row = mysqli_fetch_assoc($status_query)) {
    $status_data[$row['payment_status']] = $row['total'];
}

// Dữ liệu đơn hàng chi tiết
$order_table = mysqli_query($conn, "
    SELECT id, name, number, email, method, address, total_price, placed_on, payment_status 
    FROM orders 
    WHERE MONTH(STR_TO_DATE(placed_on, '%d-%b-%Y')) = $filter_month 
    AND YEAR(STR_TO_DATE(placed_on, '%d-%b-%Y')) = $filter_year
");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
<div class="container py-4">
    <h2 class="text-center mb-4">📊 Bảng điều khiển quản trị</h2>

    <div class="row text-center mb-4">
        <div class="col-md-4 card-box">Sản phẩm<br><strong><?= $total_products ?></strong></div>
        <div class="col-md-4 card-box">Đơn hàng<br><strong><?= $total_orders ?></strong></div>
        <div class="col-md-4 card-box">Người dùng<br><strong><?= $total_users ?></strong></div>
    </div>

    <form method="GET" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label>Chọn tháng</label>
            <select name="month" class="form-select">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?= $m ?>" <?= ($m == $filter_month) ? 'selected' : '' ?>>Tháng <?= $m ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Chọn năm</label>
            <select name="year" class="form-select">
                <?php for ($y = 2022; $y <= date('Y'); $y++): ?>
                    <option value="<?= $y ?>" <?= ($y == $filter_year) ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Lọc</button>
        </div>
    </form>

    <div class="row g-4">
    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="text-center">Biểu đồ doanh thu theo tháng (<?= $filter_year ?>)</h5>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="text-center">Tỷ lệ đơn hàng theo trạng thái</h5>
            <canvas id="statusChart" style="max-height: 300px;"></canvas>
        </div>
    </div>
</div>

    <h5 class="mt-5">Danh sách đơn hàng tháng <?= $filter_month ?>/<?= $filter_year ?></h5>
    <button class="btn btn-success mb-2" onclick="exportToExcel()">📥 Xuất Excel</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="orderTable">
            <thead>
            <tr>
                <th>ID</th><th>Tên</th><th>SĐT</th><th>Email</th><th>PTTT</th><th>Địa chỉ</th>
                <th>Giá trị</th><th>Ngày đặt</th><th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($order_table)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['number'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['method'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= number_format($row['total_price']) ?> VND</td>
                    <td><?= $row['placed_on'] ?></td>
                    <td><?= $row['payment_status'] ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    // Biểu đồ doanh thu
    const revenueData = <?= json_encode($monthly_data) ?>;
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'],
            datasets: [{
                label: 'Doanh thu',
                data: revenueData,
                backgroundColor: 'rgba(255,165,0,0.2)',
                borderColor: 'orange',
                fill: true,
                tension: 0.3
            }]
        }
    });

    // Biểu đồ trạng thái đơn hàng
    const statusLabels = <?= json_encode(array_keys($status_data)) ?>;
    const statusValues = <?= json_encode(array_values($status_data)) ?>;
    const ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0']
            }]
        }
    });

    // Xuất Excel
    function exportToExcel() {
        const table = document.getElementById("orderTable");
        if (!table) {
            alert("Không tìm thấy bảng dữ liệu!");
            return;
        }

        const rows = Array.from(table.rows);
        const headers = rows[0].querySelectorAll("th");
        const colsToKeep = [0, 1, 2, 3, 4, 5, 6, 7, 8]; // Các cột cần giữ lại

        const data = rows.map(row => {
            const cells = row.querySelectorAll("th, td");
            return Array.from(cells)
                .filter((_, i) => colsToKeep.includes(i))
                .map(cell => cell.innerText.trim());
        });

        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "DonHang");
        XLSX.writeFile(wb, "don_hang_thang_<?= $filter_month ?>_<?= $filter_year ?>.xlsx");
    }
</script>

</body>
</html>
