<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query)) {
    echo json_encode([]);
    exit();
}

try {
    $searchQuery = "SELECT id, nombre, foto_perfil 
                    FROM users 
                    WHERE nombre LIKE :query 
                    ORDER BY nombre ASC 
                    LIMIT 5";

    $stmt = $db->prepare($searchQuery);
    $searchTerm = "%{$query}%";
    $stmt->bindParam(':query', $searchTerm);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
}
?>