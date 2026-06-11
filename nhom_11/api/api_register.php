<?php
// api_register.php
// CẤU HÌNH CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header('Content-Type: application/json; charset=utf-8');
require_once 'db.php'; 

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->full_name) && !empty($data->email) && !empty($data->password)) {
    try {
        // 1. Kiểm tra xem email đã tồn tại hay chưa
        $stmt = $conn->prepare("SELECT user_id FROM Users WHERE email = ?");
        $stmt->execute([$data->email]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "Email này đã được đăng ký!"]);
            exit;
        }

        // 2. Mã hóa mật khẩu bảo mật cao bằng thuật toán mặc định của PHP
        $hashed_password = password_hash($data->password, PASSWORD_DEFAULT);

        // 3. Lưu tài khoản mới vào Database
        $insert = $conn->prepare("INSERT INTO Users (full_name, email, password_hash) VALUES (?, ?, ?)");
        $insert->execute([$data->full_name, $data->email, $hashed_password]);

        echo json_encode(["status" => "success", "message" => "Tạo tài khoản thành công!"]);
    } catch(PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Lỗi server: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin!"]);
}
?>