<?php

require_once __DIR__ . "/../Modelos/Master.php";

class MasterController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Master();
    }

    public function inicio() {
        // Si no existe contraseña, mostrar creación
        if (!$this->modelo->existe()) {
            include __DIR__ . "/../Vistas/maestra_crear.php";
        } else {
            include __DIR__ . "/../Vistas/login.php";
        }
    }

    public function guardar($post) {
        $password = $post["password"];
        $this->modelo->crear($password);

        header("Location: index.php");
    }

    public function login($post) {
        $password = $post["password"];

        if ($this->modelo->verificar($password)) {
            session_start();
            $_SESSION["logueado"] = true;

            header("Location: index.php?action=index");
        } else {
            echo "Contraseña incorrecta";
        }
    }
}