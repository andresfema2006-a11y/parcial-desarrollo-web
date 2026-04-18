<?php

require_once __DIR__ . "/../../config/database.php";

class Master {

    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Verificar si ya existe una contraseña maestra
    public function existe() {
        $sql = "SELECT * FROM maestra LIMIT 1";
        $result = $this->conexion->query($sql);

        return $result->fetch_assoc(); 
    }

    // Crear la contraseña maestra (HASH)
    public function crear($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO maestra (password) VALUES (?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $hash);

        return $stmt->execute();
    }

    // Verificar login
    public function verificar($password) {
        $row = $this->existe();
        if (!$row) return false;

        return password_verify($password, $row["password"]);
    }
}