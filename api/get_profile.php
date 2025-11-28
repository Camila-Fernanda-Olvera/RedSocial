<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['user_id'])) {
    try {
        $query = "SELECT id, nombre, correo, foto_perfil, foto_portada, descripcion, fecha_registro FROM users WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_GET['user_id']);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode($row);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Usuario no encontrado."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Falta el ID de usuario."]);
}
?>