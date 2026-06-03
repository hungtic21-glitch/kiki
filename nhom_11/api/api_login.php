<?php
// api_login.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start(); // Khởi tạo session để lưu trạng thái đăng nhập
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    try {
        $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$data->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu khớp với mã băm trong cơ sở dữ liệu không
        if ($user && password_verify($data->password, $user['password_hash'])) {
            // Lưu trạng thái vào Session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];

            echo json_encode(["status" => "success", "message" => "Đăng nhập thành công!", "user_name" => $user['full_name']]);
        } else {
            echo json_encode(["status" => "error", "message" => "Email hoặc mật khẩu không chính xác!"]);
        }
    } catch(PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Lỗi server: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin!"]);
}
?>