<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$host = "localhost";
$db_name = "nhom_11";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(array("status" => "error", "message" => "Lỗi kết nối: " . $e->getMessage()));
    exit();
}

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->old_password) && !empty($data->new_password)) {
    
    // Kiểm tra tài khoản và mật khẩu cũ xem đúng không
    $query = "SELECT id, password FROM users WHERE email = :email LIMIT 0,1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // So sánh mật khẩu cũ (Nếu DB của nhóm có mã hóa MD5 hay mã hóa password_hash thì chỉnh lại đoạn này nhé)
        if ($data->old_password === $row['password']) {
            
            // Cập nhật mật khẩu mới vào database
            $update_query = "UPDATE users SET password = :new_password WHERE email = :email";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(":new_password", $data->new_password);
            $update_stmt->bindParam(":email", $data->email);
            
            if ($update_stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Mật khẩu của tài khoản " . $data->email . " đã được cập nhật thành công!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Không thể cập nhật mật khẩu vào cơ sở dữ liệu."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Mật khẩu hiện tại không chính xác!"));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Tài khoản không tồn tại trên hệ thống!"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Vui lòng nhập đầy đủ tất cả các trường dữ liệu!"));
}
?>