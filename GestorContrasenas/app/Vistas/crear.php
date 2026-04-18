<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Credencial</title>
</head>
<body>

    <h1>Agregar nueva credencial</h1>

    <form action="index.php?action=guardar" method="POST">

        <label>Servicio:</label>
        <input type="text" name="servicio" required><br><br>

        <label>Usuario:</label>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label>
        <input type="text" name="contrasena" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php?action=index">← Volver</a>

</body>
</html>