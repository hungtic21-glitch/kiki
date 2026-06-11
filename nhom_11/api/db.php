<?php
// db.php - File kết nối cơ sở dữ liệu
$host = 'localhost';
$db   = '268_gaming'; // Thay bằng tên database chính xác của bro nếu khác
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Trả về lỗi định dạng JSON nếu là một API request để Frontend dễ xử lý
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["status" => "error", "message" => "Lỗi kết nối database: " . $e->getMessage()]);
    exit;
}
?>