<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id)) {
    try {
        // Mark all notifications as read for this user
        $query = "UPDATE notifications SET is_read = TRUE WHERE user_id = :user_id AND is_read = FALSE";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $data->user_id);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["message" => "Notificaciones marcadas como leídas."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "No se pudieron marcar las notificaciones."]);
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