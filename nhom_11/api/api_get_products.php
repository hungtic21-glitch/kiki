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

// Kết nối database
try {
    require_once __DIR__ . '/../db.php'; // dùng __DIR__ để đường dẫn tuyệt đối
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
    exit;
}

try {
    // Lấy toàn bộ sản phẩm từ bảng `products` (chú ý tên bảng viết thường)
    $stmt = $conn->prepare("SELECT product_id, product_name, price, image FROM products");
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Trả về dữ liệu (kể cả khi rỗng)
    echo json_encode([
        "status" => "success",
        "data" => $products
    ]);
} catch(PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi truy vấn: " . $e->getMessage()
    ]);
}
?>