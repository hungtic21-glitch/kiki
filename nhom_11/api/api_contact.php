<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// 1. Kết nối Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "268_gaming";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Kết nối Database thất bại"]);
    exit();
}
$conn->set_charset("utf8mb4");

// 2. Nhận dữ liệu JSON từ Frontend gửi lên
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['fullname']) && isset($input['email']) && isset($input['phone']) && isset($input['message'])) {
    
    $fullname = $conn->real_escape_string($input['fullname']);
    $email = $conn->real_escape_string($input['email']);
    $phone = $conn->real_escape_string($input['phone']);
    $message = $conn->real_escape_string($input['message']);
    
    // Kiểm tra dữ liệu rỗng
    if (empty($fullname) || empty($email) || empty($phone) || empty('message')) {
        echo json_encode(["status" => "error", "message" => "Vui lòng điền đầy đủ thông tin!"]);
        exit();
    }

    // 3. Chèn vào bảng dữ liệu contacts
    $sql = "INSERT INTO contacts (fullname, email, phone, message) VALUES ('$fullname', '$email', '$phone', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success", 
            "message" => "Cảm ơn phản hồi của bro! Hệ thống đã lưu lại lời nhắn thành công.",
            "data" => [
                "fullname" => $fullname,
                "message" => $message
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi lưu dữ liệu: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Dữ liệu gửi lên không đúng định dạng!"]);
}

$conn->close();
?>