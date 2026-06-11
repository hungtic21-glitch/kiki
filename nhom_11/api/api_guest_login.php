<?php
// api_guest_login.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { exit(0); }

session_start();
header('Content-Type: application/json; charset=utf-8');

$_SESSION['user'] = [
    "email" => "guest@268gaming.com",
    "name" => "Khách Vãng Lai",
    "role" => "guest"
];

echo json_encode(["status" => "success", "message" => "Đã tạo phiên đăng nhập Khách!"]);
?>