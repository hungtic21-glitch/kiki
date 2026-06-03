<?php
// db.php - File kết nối cơ sở dữ liệu (chỉ cung cấp kết nối, không tự xuất JSON)
$host = 'localhost';
$db   = '268_gaming';
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
    // Ném lỗi để API xử lý, không xuất trực tiếp
    throw new \PDOException("Lỗi kết nối database: " . $e->getMessage());
}
?>