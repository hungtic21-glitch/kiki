<?php
// api_forgot_password.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// LẤY EMAIL TỪ CẢ 3 CÁCH
$email = '';

// Cách 1: Từ POST (form data)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
}

// Cách 2: Từ JSON
if (empty($email)) {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);
    if ($input && isset($input['email'])) {
        $email = trim($input['email']);
    }
}

// Cách 3: Từ GET
if (empty($email) && isset($_GET['email'])) {
    $email = trim($_GET['email']);
}

// Debug: Ghi log để kiểm tra
file_put_contents('debug_api.txt', date('Y-m-d H:i:s') . " - Email nhận được: '$email'\n", FILE_APPEND);

if (empty($email)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập email!"]);
    exit();
}

// Kết nối database
$conn = new mysqli("localhost", "root", "", "268_gaming");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Lỗi DB: " . $conn->connect_error]);
    exit();
}

// Kiểm tra email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Email không tồn tại!"]);
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// Tạo mã
$reset_code = rand(100000, 999999);
$expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

// Thêm cột nếu chưa có
$conn->query("ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_code VARCHAR(10)");
$conn->query("ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_expiry DATETIME");

// Cập nhật
$stmt = $conn->prepare("UPDATE users SET reset_code = ?, reset_expiry = ? WHERE email = ?");
$stmt->bind_param("sss", $reset_code, $expiry, $email);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Tạo mã thành công!",
        "reset_code" => $reset_code,
        "email" => $email
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Lỗi update: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>