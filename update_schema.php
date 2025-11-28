<?php
include_once 'config/db.php';

$database = new Database();
$db = $database->getConnection();

try {
    // Update users table
    $sql1 = "ALTER TABLE users MODIFY foto_perfil LONGTEXT";
    $db->exec($sql1);
    echo "Columna 'foto_perfil' actualizada a LONGTEXT.<br>";

    $sql2 = "ALTER TABLE users MODIFY foto_portada LONGTEXT";
    $db->exec($sql2);
    echo "Columna 'foto_portada' actualizada a LONGTEXT.<br>";

    // Update posts table
    $sql3 = "ALTER TABLE posts MODIFY image LONGTEXT";
    $db->exec($sql3);
    echo "Columna 'image' en 'posts' actualizada a LONGTEXT.<br>";

    echo "Esquema de base de datos actualizado correctamente.";
} catch (PDOException $e) {
    echo "Error al actualizar esquema: " . $e->getMessage();
}
?>