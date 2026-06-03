<?php
// api_get_products.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

try {
    // Lấy toàn bộ sản phẩm từ Database
    $stmt = $conn->prepare("SELECT * FROM Products");
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Trả về dữ liệu dạng JSON
    echo json_encode([
        "status" => "success",
        "data" => $products
    ]);
} catch(PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>