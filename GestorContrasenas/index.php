<?php
session_start();

require_once "app/Controladores/MasterController.php";
require_once "app/Controladores/CredencialesController.php";

$master = new MasterController();

if (!isset($_SESSION["logueado"])) {
    if (isset($_GET["action"]) && $_GET["action"] === "guardar_maestra") {
        $master->guardar($_POST);
    } elseif (isset($_GET["action"]) && $_GET["action"] === "login") {
        $master->login($_POST);
    } else {
        $master->inicio();
    }
    exit;
}

$controller = new CredencialesController();

$action = $_GET["action"] ?? "index";

switch ($action) {

    case "crear":
        $controller->crear();
        break;

    case "guardar":
        $controller->guardar($_POST);
        break;

    case "editar":
        $controller->editar($_GET["id"]);
        break;

    case "actualizar":
        $controller->actualizar($_POST);
        break;

    case "eliminar":
        $controller->eliminar($_GET["id"]);
        break;
		
	case "ver":
    echo $controller->ver($_GET["id"]);
    break;

    default:
        $controller->index();
        break;
}