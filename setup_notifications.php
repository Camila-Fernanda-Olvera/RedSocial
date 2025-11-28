<?php
include_once 'config/db.php';

$database = new Database();
$db = $database->getConnection();

try {
    $sql = "CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        commenter_id INT NOT NULL,
        comment_id INT NOT NULL,
        type VARCHAR(50) DEFAULT 'comment',
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
        FOREIGN KEY (commenter_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE
    )";

    $db->exec($sql);
    echo "Tabla 'notifications' creada exitosamente.";
} catch (PDOException $e) {
    echo "Error al crear tabla: " . $e->getMessage();
}
?>