<?php
header('Content-Type: application/json');

// Database connection
require_once '../config/db.php';
require_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->nombre) &&
    !empty($data->email) &&
    !empty($data->password)
) {
    // Basic validation
    if (strlen($data->password) < 6) {
        http_response_code(400);
        echo json_encode(array("message" => "La contraseña debe tener al menos 6 caracteres."));
        exit;
    }

    // Attempt to register
    if ($user->register($data->nombre, $data->email, $data->password)) {
        http_response_code(201);
        echo json_encode(array("message" => "Usuario registrado exitosamente."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "No se pudo registrar el usuario. El correo podría estar en uso."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Datos incompletos."));
}
?>