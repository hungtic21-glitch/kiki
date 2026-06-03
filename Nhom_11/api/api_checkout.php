<?php
// api_checkout.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

// Kiểm tra dữ liệu đầu vào
if (!empty($data->customer_name) && !empty($data->phone) && !empty($data->address) && !empty($data->cart)) {
    try {
        // Bắt đầu Transaction để bảo vệ toàn vẹn dữ liệu
        $conn->beginTransaction();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $total_amount = 0;

        // 1. Tạo Đơn Hàng Mới trong bảng Orders
        $stmtOrder = $conn->prepare("INSERT INTO Orders (user_id, customer_name, customer_phone, shipping_address, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtOrder->execute([$user_id, $data->customer_name, $data->phone, $data->address, $data->payment_method, 0]);
        
        // Lấy ID của đơn hàng vừa tạo
        $order_id = $conn->lastInsertId();

        // 2. Chèn từng món hàng vào bảng Order_Details
        $stmtDetail = $conn->prepare("INSERT INTO Order_Details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        
        foreach ($data->cart as $item) {
            $stmtDetail->execute([$order_id, $item->id, $item->quantity, $item->price]);
            $total_amount += ($item->quantity * $item->price);
        }

        // 3. Cập nhật lại tổng tiền chính xác vào bảng Orders
        $stmtUpdateTotal = $conn->prepare("UPDATE Orders SET total_amount = ? WHERE order_id = ?");
        $stmtUpdateTotal->execute([$total_amount, $order_id]);

        // Hoàn tất Transaction
        $conn->commit();

        // Xóa giỏ hàng sau khi đặt hàng xong thành công
        $_SESSION['cart'] = [];

        echo json_encode(["status" => "success", "message" => "Đặt hàng thành công!", "order_id" => $order_id]);
    } catch(PDOException $e) {
        // Nếu có lỗi, Hủy (Rollback) toàn bộ thao tác vừa làm để tránh rác DB
        $conn->rollBack();
        echo json_encode(["status" => "error", "message" => "Lỗi đặt hàng: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu thông tin đặt hàng!"]);
}
?>