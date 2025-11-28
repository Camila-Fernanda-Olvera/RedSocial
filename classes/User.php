<?php
class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $nombre;
    public $correo;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Login user
    public function login($correo, $password)
    {
        $query = "SELECT id, nombre, password_hash, foto_perfil FROM " . $this->table_name . " WHERE correo = :correo LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $correo = htmlspecialchars(strip_tags($correo));
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password_hash'])) {
                $this->id = $row['id'];
                $this->nombre = $row['nombre'];
                return true;
            }
        }
        return false;
    }

    // Register user (Basic implementation for future use)
    public function register($nombre, $correo, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, correo=:correo, password_hash=:password_hash";
        $stmt = $this->conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $correo = htmlspecialchars(strip_tags($correo));
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":password_hash", $password_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get user by ID
    public function getUserById($user_id)
    {
        $query = "SELECT id, nombre, correo, foto_perfil, foto_portada, fecha_registro FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    // Get user stats (friends count, posts count)
    public function getUserStats($user_id)
    {
        // For now, return mock data
        // TODO: Implement actual queries when posts and friends tables are created
        return array(
            "friends_count" => 0,
            "posts_count" => 0
        );
    }
}
?>