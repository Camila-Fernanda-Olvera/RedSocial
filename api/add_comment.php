<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->post_id) && !empty($data->user_id) && !empty($data->content)) {
    try {
        $query = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(":post_id", $data->post_id);
        $stmt->bindParam(":user_id", $data->user_id);
        $stmt->bindParam(":content", $data->content);

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["message" => "Comentario agregado."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "No se pudo agregar el comentario."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Datos incompletos."]);
}
?>