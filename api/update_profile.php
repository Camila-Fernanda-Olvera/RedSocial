<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    try {
        // Construct query dynamically based on provided fields
        $fields = [];
        if (isset($data->nombre))
            $fields[] = "nombre = :nombre";
        if (isset($data->descripcion))
            $fields[] = "descripcion = :descripcion";
        if (isset($data->foto_perfil))
            $fields[] = "foto_perfil = :foto_perfil";
        if (isset($data->foto_portada))
            $fields[] = "foto_portada = :foto_portada"; // Added cover photo support

        if (empty($fields)) {
            http_response_code(400);
            echo json_encode(["message" => "No hay datos para actualizar."]);
            exit;
        }

        $query = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $data->id);
        if (isset($data->nombre))
            $stmt->bindParam(':nombre', $data->nombre);
        if (isset($data->descripcion))
            $stmt->bindParam(':descripcion', $data->descripcion);
        if (isset($data->foto_perfil))
            $stmt->bindParam(':foto_perfil', $data->foto_perfil);
        if (isset($data->foto_portada))
            $stmt->bindParam(':foto_portada', $data->foto_portada);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Perfil actualizado."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "No se pudo actualizar el perfil."]);
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