<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    if ($user->login($data->email, $data->password)) {
        // Store user ID in session
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_nombre'] = $user->nombre;

        http_response_code(200);
        echo json_encode(array(
            "message" => "Login exitoso.",
            "user" => array(
                "id" => $user->id,
                "nombre" => $user->nombre
            )
        ));
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Credenciales incorrectas."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Datos incompletos."));
}
?>