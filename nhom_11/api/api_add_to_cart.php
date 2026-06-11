<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Không nhận được dữ liệu"]);
    exit();
}

if (empty($data['id']) || empty($data['name'])) {
    echo json_encode(["status" => "error", "message" => "Thiếu id hoặc tên sản phẩm"]);
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $data['id']) {
        $item['quantity'] += $data['quantity'] ?? 1;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        "id" => $data['id'],
        "name" => $data['name'],
        "price" => floatval($data['price']),
        "image" => $data['image'] ?? "",
        "quantity" => $data['quantity'] ?? 1
    ];
}

echo json_encode([
    "status" => "success",
    "message" => "Đã thêm vào giỏ hàng",
    "cart" => $_SESSION['cart']
]);
?>