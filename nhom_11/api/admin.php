<?php
// admin.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
require_once 'db.php';

// Bảo mật cơ bản: Thường kiểm tra quyền trước khi hiển thị dữ liệu admin
/* if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}
*/

// 1. Thống kê cơ bản đơn hàng và doanh thu
$stmtStats = $conn->query("SELECT COUNT(order_id) as total_orders, SUM(total_amount) as total_revenue FROM Orders");
$stats = $stmtStats->fetch(PDO::FETCH_ASSOC);

// 2. Lấy danh sách 10 đơn hàng mới nhất hệ thống
$stmtOrders = $conn->query("SELECT * FROM Orders ORDER BY created_at DESC LIMIT 10");
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - 268 Gaming</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .dashboard-container { max-width: 1200px; margin: 0 auto; }
        .stat-cards { display: flex; gap: 20px; margin-bottom: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .card h3 { margin: 0 0 10px 0; color: #666; font-size: 14px; }
        .card .value { font-size: 24px; font-weight: bold; color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #35495e; color: #fff; font-weight: 600; }
        tr:hover { background: #f9f9f9; }
        .status-pending { color: #f39c12; font-weight: bold; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Dashboard Quản Lý - 268 Gaming</h1>
        
        <div class="stat-cards">
            <div class="card">
                <h3>Tổng Đơn Hàng</h3>
                <div class="value"><?= number_format($stats['total_orders'] ?? 0, 0, ',', '.') ?></div>
            </div>
            <div class="card">
                <h3>Tổng Doanh Thu</h3>
                <div class="value"><?= number_format($stats['total_revenue'] ?? 0, 0, ',', '.') ?> đ</div>
            </div>
        </div>

        <h2>Đơn Hàng Mới Nhất</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Số ĐT</th>
                    <th>Tổng Tiền</th>
                    <th>Thanh Toán</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                    <td><?= number_format($order['total_amount'], 0, ',', '.') ?> đ</td>
                    <td><?= htmlspecialchars($order['payment_method']) ?></td>
                    <td class="status-pending"><?= $order['order_status'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($orders)): ?>
                <tr><td colspan="7" style="text-align:center;">Chưa có đơn hàng nào!</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>