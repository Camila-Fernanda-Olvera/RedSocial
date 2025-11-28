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
            $comment_id = $db->lastInsertId();

            // Get post owner to create notification
            $postQuery = "SELECT user_id FROM posts WHERE id = :post_id";
            $postStmt = $db->prepare($postQuery);
            $postStmt->bindParam(":post_id", $data->post_id);
            $postStmt->execute();
            $post = $postStmt->fetch(PDO::FETCH_ASSOC);

            // Create notification only if commenter is not the post owner
            if ($post && $post['user_id'] != $data->user_id) {
                $notifQuery = "INSERT INTO notifications (user_id, post_id, commenter_id, comment_id, type) 
                              VALUES (:user_id, :post_id, :commenter_id, :comment_id, 'comment')";
                $notifStmt = $db->prepare($notifQuery);
                $notifStmt->bindParam(":user_id", $post['user_id']);
                $notifStmt->bindParam(":post_id", $data->post_id);
                $notifStmt->bindParam(":commenter_id", $data->user_id);
                $notifStmt->bindParam(":comment_id", $comment_id);
                $notifStmt->execute();
            }

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