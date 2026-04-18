<?php

require_once __DIR__ . "/../../config/key.php";
require_once __DIR__ . "/../Modelos/Credencial.php";

class CredencialesController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Credencial();
    }

    // Mostrar lista de credenciales
    public function index() {
        $data = $this->modelo->listar();
        include __DIR__ . "/../Vistas/listar.php";
    }

    // Mostrar formulario de creación
    public function crear() {
        include __DIR__ . "/../Vistas/crear.php";
    }

    // Guardar nueva credencial
    public function guardar($post) {
        $servicio = $post["servicio"];
        $usuario  = $post["usuario"];
        $contrasena = $post["contrasena"];

        // CIFRAR antes de guardar
        $contrasena_cifrada = $this->cifrar($contrasena);

        $this->modelo->crear($servicio, $usuario, $contrasena_cifrada);

        header("Location: index.php?action=index");
    }

    // Mostrar formulario de edición
    public function editar($id) {
        $credencial = $this->modelo->obtener($id);
        include __DIR__ . "/../Vistas/editar.php";
    }

    // Actualizar credencial
    public function actualizar($post) {
        $id        = $post["id"];
        $servicio  = $post["servicio"];
        $usuario   = $post["usuario"];
        $contrasena = $post["contrasena"];

        $contrasena_cifrada = $this->cifrar($contrasena);

        $this->modelo->actualizar($id, $servicio, $usuario, $contrasena_cifrada);

        header("Location: index.php?action=index");
    }

    // Eliminar credencial
    public function eliminar($id) {
        $this->modelo->eliminar($id);
        header("Location: index.php?action=index");
    }

    // Mostrar contraseña descifrada
    public function ver($id) {
        $credencial = $this->modelo->obtener($id);
        return $this->descifrar($credencial["contrasena"]);
    }

    // -----------------------------
    // CIFRAR / DESCIFRAR
    // -----------------------------
    private function cifrar($texto) {
        $key = CIPHER_KEY;
        $method = CIPHER_METHOD;
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

        $cifrado = openssl_encrypt($texto, $method, $key, 0, $iv);

        return base64_encode($iv . $cifrado);
    }

    private function descifrar($texto_cifrado) {
        $key = CIPHER_KEY;
        $method = CIPHER_METHOD;

        $data = base64_decode($texto_cifrado);
        $iv_length = openssl_cipher_iv_length($method);
        $iv = substr($data, 0, $iv_length);
        $cifrado = substr($data, $iv_length);

        return openssl_decrypt($cifrado, $method, $key, 0, $iv);
    }
}