<?php
// api_update_cart.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cart']) && is_array($data['cart'])) {
    $_SESSION['cart'] = $data['cart'];
    echo json_encode(["status" => "success", "message" => "Cập nhật giỏ hàng thành công"]);
} else {
    echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"]);
}
?>