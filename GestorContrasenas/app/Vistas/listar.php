<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Credenciales</title>
</head>
<body>

    <h1>Credenciales Guardadas</h1>

    <a href="index.php?action=crear">Agregar nueva credencial</a>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Servicio</th>
            <th>Usuario</th>
            <th>Contraseña (cifrada)</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($data as $fila): ?>
        <tr>
            <td><?= $fila["id"] ?></td>
            <td><?= $fila["servicio"] ?></td>
            <td><?= $fila["usuario"] ?></td>
            <td>
    <span class="oculta" id="pass<?= $fila['id'] ?>">••••••••</span>
    <button onclick="verContrasena(<?= $fila['id'] ?>)">Mostrar</button>
</td>

            <td>
                <a href="index.php?action=editar&id=<?= $fila['id'] ?>">Editar</a>
                |
                <a href="index.php?action=eliminar&id=<?= $fila['id'] ?>"
                   onclick="return confirm('¿Seguro que deseas eliminar?')">
                   Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
<script>
function verContrasena(id) {
    let span = document.getElementById("pass" + id);

    fetch("index.php?action=ver&id=" + id)
        .then(r => r.text())
        .then(data => {
            span.innerText = data;
        });
}
</script>
</body>
</html>