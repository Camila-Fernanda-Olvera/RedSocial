<?php
require_once 'config/db.php';

try {
    $database = new Database();
    $db = $database->getConnection();

    $sql = file_get_contents('database.sql');

    $db->exec($sql);
    echo "Base de datos actualizada correctamente.";
} catch (PDOException $e) {
    echo "Error al actualizar la base de datos: " . $e->getMessage();
}
?>