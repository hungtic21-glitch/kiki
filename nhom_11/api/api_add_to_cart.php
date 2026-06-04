<?php
// api_add_to_cart.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
header('Content-Type: application/json; charset=utf-8');

// Lấy dữ liệu sản phẩm gửi lên từ Frontend
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->name) && !empty($data->price)) {
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $product_id = $data->id;
    $found = false;

    // Nếu sản phẩm đã có trong giỏ, chỉ tăng số lượng (quantity)
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += isset($data->quantity) ? intval($data->quantity) : 1;
            $found = true;
            break;
        }
    }

    // Nếu là sản phẩm mới, thêm mới hoàn toàn vào mảng session
    if (!$found) {
        $_SESSION['cart'][] = [
            "id" => $product_id,
            "name" => $data->name,
            "price" => intval($data->price),
            "quantity" => isset($data->quantity) ? intval($data->quantity) : 1
        ];
    }

    echo json_encode(["status" => "success", "message" => "Đã thêm vào giỏ hàng thành công!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Dữ liệu sản phẩm không hợp lệ!"]);
}
?>