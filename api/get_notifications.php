<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if ($user_id) {
    try {
        $query = "SELECT n.*, 
                         u.nombre as commenter_name, 
                         u.foto_perfil as commenter_photo,
                         p.content as post_content
                  FROM notifications n
                  JOIN users u ON n.commenter_id = u.id
                  JOIN posts p ON n.post_id = p.id
                  WHERE n.user_id = :user_id
                  ORDER BY n.created_at DESC
                  LIMIT 20";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($notifications);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "user_id requerido."]);
}
?>