<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(array("message" => "No autorizado. Por favor inicia sesión."));
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user profile data
$userData = $user->getUserById($user_id);

if ($userData) {
    // Get user stats
    $stats = $user->getUserStats($user_id);

    http_response_code(200);
    echo json_encode(array(
        "user" => $userData,
        "stats" => $stats
    ));
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Usuario no encontrado."));
}
?>