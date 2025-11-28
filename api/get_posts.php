<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    try {
        $query = "SELECT p.id, p.content, p.image, p.created_at, u.id as user_id, u.nombre, u.foto_perfil 
                  FROM posts p 
                  JOIN users u ON p.user_id = u.id";

        if (isset($_GET['user_id'])) {
            $query .= " WHERE p.user_id = :user_id";
        }

        $query .= " ORDER BY p.created_at DESC";

        $stmt = $db->prepare($query);

        if (isset($_GET['user_id'])) {
            $stmt->bindParam(':user_id', $_GET['user_id']);
        }

        $stmt->execute();

        $posts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Fetch comments for this post
            $comment_query = "SELECT c.id, c.content, c.created_at, u.nombre, u.foto_perfil 
                              FROM comments c 
                              JOIN users u ON c.user_id = u.id 
                              WHERE c.post_id = :post_id 
                              ORDER BY c.created_at ASC";
            $comment_stmt = $db->prepare($comment_query);
            $comment_stmt->bindParam(':post_id', $row['id']);
            $comment_stmt->execute();
            $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

            $row['comments'] = $comments;
            $posts[] = $row;
        }

        echo json_encode($posts);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error al obtener publicaciones: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "No se pudo conectar a la base de datos."]);
}
?>