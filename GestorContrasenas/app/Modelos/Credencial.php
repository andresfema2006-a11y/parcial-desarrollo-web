<?php

require_once __DIR__ . "/../../config/database.php";

class Credencial {

    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Crear una credencial
    public function crear($servicio, $usuario, $contrasena_cifrada) {
        $sql = "INSERT INTO credenciales (servicio, usuario, contrasena, creado_en)
                VALUES (?, ?, ?, NOW())";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", $servicio, $usuario, $contrasena_cifrada);

        return $stmt->execute();
    }

    // Listar credenciales
    public function listar() {
        $sql = "SELECT * FROM credenciales ORDER BY id DESC";
        $result = $this->conexion->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener una credencial (para editar)
    public function obtener($id) {
        $sql = "SELECT * FROM credenciales WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar
    public function actualizar($id, $servicio, $usuario, $contrasena_cifrada) {
        $sql = "UPDATE credenciales 
                SET servicio = ?, usuario = ?, contrasena = ?
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $servicio, $usuario, $contrasena_cifrada, $id);

        return $stmt->execute();
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM credenciales WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}