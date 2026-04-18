<?php

class Database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "gestor_contrasenas";
    public $conexion;

    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }
}