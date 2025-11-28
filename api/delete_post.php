<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->post_id) && !empty($data->user_id)) {
    try {
        // Verify that the post belongs to the user
        $checkQuery = "SELECT user_id FROM posts WHERE id = :post_id";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(':post_id', $data->post_id);
        $checkStmt->execute();

        $post = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            http_response_code(404);
            echo json_encode(["message" => "Publicación no encontrada."]);
            exit();
        }

        if ($post['user_id'] != $data->user_id) {
            http_response_code(403);
            echo json_encode(["message" => "No tienes permiso para eliminar esta publicación."]);
            exit();
        }

        // Delete the post (comments will be deleted automatically due to CASCADE)
        $deleteQuery = "DELETE FROM posts WHERE id = :post_id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':post_id', $data->post_id);

        if ($deleteStmt->execute()) {
            http_response_code(200);
            echo json_encode(["message" => "Publicación eliminada exitosamente."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "No se pudo eliminar la publicación."]);
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