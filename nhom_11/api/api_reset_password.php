<?php
// api_reset_password.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = new mysqli("localhost", "root", "", "268_gaming");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Lỗi DB: " . $conn->connect_error]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['email']) || empty($data['reset_code']) || empty($data['new_password'])) {
    echo json_encode(["status" => "error", "message" => "Thiếu thông tin!"]);
    exit();
}

$email = $conn->real_escape_string($data['email']);
$reset_code = $conn->real_escape_string($data['reset_code']);
$new_password = password_hash($data['new_password'], PASSWORD_DEFAULT);

// Kiểm tra mã
$check = $conn->query("SELECT id FROM users WHERE email = '$email' AND reset_code = '$reset_code' AND reset_expiry > NOW()");

if ($check->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Mã không đúng hoặc đã hết hạn!"]);
    exit();
}

// Cập nhật mật khẩu
$sql = "UPDATE users SET password = '$new_password', reset_code = NULL, reset_expiry = NULL WHERE email = '$email'";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Đặt lại mật khẩu thành công!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Lỗi: " . $conn->error]);
}

$conn->close();
?>