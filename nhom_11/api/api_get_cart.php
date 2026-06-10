<?php
// api_get_cart.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    echo json_encode([
        "status" => "success",
        "data" => array_values($_SESSION['cart'])
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "data" => []
    ]);
}
?>