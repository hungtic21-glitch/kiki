<?php
// api_add_order.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();

$host = "localhost";
$db_name = "nhom_11";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    echo json_encode(array("status" => "error", "message" => "Lỗi kết nối MySQL: " . $exception->getMessage()));
    exit();
}

// Đọc dữ liệu JSON gửi lên từ Frontend
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->customer_name) && !empty($data->phone) && !empty($data->address)) {
    
    // LẤY GIỎ HÀNG TỪ SESSION THAY VÌ TỪ DATA GỬI LÊN
    $cart_source = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    if (empty($cart_source)) {
        echo json_encode(array("status" => "error", "message" => "Giỏ hàng trống, không thể đặt hàng!"));
        exit();
    }

    // Tính tổng tiền
    $total_amount = 0;
    foreach ($cart_source as $item) {
        $price = isset($item['price']) ? (float)$item['price'] : 0;
        $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
        $total_amount += ($price * $qty);
    }

    // Chuyển mảng chi tiết giỏ hàng thành chuỗi JSON
    $cart_details = json_encode($cart_source, JSON_UNESCAPED_UNICODE);

    try {
        // Kiểm tra và thêm cột cart_details nếu chưa có
        try {
            $conn->exec("ALTER TABLE `orders` ADD COLUMN `cart_details` TEXT DEFAULT NULL AFTER `total_amount`");
        } catch(Exception $col_ex) {
            // Cột đã tồn tại
        }

        $query = "INSERT INTO orders (customer_name, phone, address, payment_method, total_amount, cart_details) 
                  VALUES (:customer_name, :phone, :address, :payment_method, :total_amount, :cart_details)";
                  
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(":customer_name", $data->customer_name);
        $stmt->bindParam(":phone", $data->phone);
        $stmt->bindParam(":address", $data->address);
        $stmt->bindParam(":payment_method", $data->payment_method);
        $stmt->bindParam(":total_amount", $total_amount);
        $stmt->bindParam(":cart_details", $cart_details);

        if ($stmt->execute()) {
            // Xóa giỏ hàng sau khi đặt hàng thành công
            $_SESSION['cart'] = [];
            
            echo json_encode(array("status" => "success", "message" => "Đặt hàng thành công!"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Không thể lưu đơn hàng!"));
        }
    } catch(PDOException $e) {
        echo json_encode(array("status" => "error", "message" => "Lỗi MySQL: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Vui lòng điền đầy đủ thông tin họ tên, số điện thoại và địa chỉ!"));
}
?>