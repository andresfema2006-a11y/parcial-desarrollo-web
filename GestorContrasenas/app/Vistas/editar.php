<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Credencial</title>
</head>
<body>

    <h1>Editar Credencial</h1>

    <form action="index.php?action=actualizar" method="POST">

        <input type="hidden" name="id" value="<?= $credencial['id'] ?>">

        <label>Servicio:</label>
        <input type="text" name="servicio" value="<?= $credencial['servicio'] ?>" required><br><br>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?= $credencial['usuario'] ?>" required><br><br>

        <label>Contraseña:</label>
        <input type="text" name="contrasena" placeholder="Nueva contraseña" required><br><br>

        <button type="submit">Actualizar</button>

    </form>

    <br>
    <a href="index.php?action=index">← Volver</a>

</body>
</html>