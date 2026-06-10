<?php
// api_checkout.php
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

if (!empty($data->customer_name) && !empty($data->phone) && !empty($data->address) && !empty($data->cart)) {
    try {
        $conn->beginTransaction();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $total_amount = 0;

        // FIX: Truyền đủ 6 tham số vào execute bao gồm cả giá trị mặc định 0 cho total_amount
        $stmtOrder = $conn->prepare("INSERT INTO Orders (user_id, customer_name, customer_phone, shipping_address, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtOrder->execute([$user_id, $data->customer_name, $data->phone, $data->address, $data->payment_method, 0]);
        
        $order_id = $conn->lastInsertId();

        $stmtDetail = $conn->prepare("INSERT INTO Order_Details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        
        foreach ($data->cart as $item) {
            $stmtDetail->execute([$order_id, $item->id, $item->quantity, $item->price]);
            $total_amount += ($item->quantity * $item->price);
        }

        $stmtUpdateTotal = $conn->prepare("UPDATE Orders SET total_amount = ? WHERE order_id = ?");
        $stmtUpdateTotal->execute([$total_amount, $order_id]);

        $conn->commit();
        $_SESSION['cart'] = [];

        echo json_encode(["status" => "success", "message" => "Đặt hàng thành công!", "order_id" => $order_id]);
    } catch(PDOException $e) {
        $conn->rollBack();
        echo json_encode(["status" => "error", "message" => "Lỗi xử lý đơn hàng: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin giao hàng!"]);
}
?>