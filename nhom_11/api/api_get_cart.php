<?php
// api_get_cart.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start(); // Khởi động session để đọc/ghi giỏ hàng
header('Content-Type: application/json; charset=utf-8');

// Nếu chưa có giỏ hàng trong session, tự động khởi tạo một mảng rỗng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Trả về danh sách sản phẩm trong giỏ hàng cho Frontend dưới dạng JSON
echo json_encode([
    "status" => "success",
    "data" => $_SESSION['cart']
]);
?>