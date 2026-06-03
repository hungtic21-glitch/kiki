<?php
// Bật hiển thị lỗi để dễ tìm nguyên nhân nếu có lỗi xảy ra
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Gọi file cấu hình database của bạn
    require_once 'db.php'; 

    // Kiểm tra xem biến kết nối $conn (hoặc biến bạn đặt trong db.php) có tồn tại và hoạt động không
    if (isset($conn)) {
        echo "<h2 style='color: green;'>Chúc mừng! Website đã kết nối Database thành công.</h2>";
        
        // Thử chạy một câu lệnh lấy dữ liệu đơn giản để chắc chắn
        $stmt = $conn->query("SELECT DATABASE()");
        $dbName = $stmt->fetchColumn();
        echo "Bạn đang kết nối tới database có tên là: <strong>" . $dbName . "</strong>";
    } else {
        echo "<h2 style='color: orange;'>Biến kết nối (\$conn) không tồn tại. Hãy kiểm tra lại file db.php!</h2>";
    }
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Kết nối thất bại!</h2>";
    echo "Lỗi: " . $e->getMessage();
}
?>