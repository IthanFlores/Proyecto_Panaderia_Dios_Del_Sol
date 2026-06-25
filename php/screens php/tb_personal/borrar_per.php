<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Personal - Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_personal_css/borrar_per.css">
</head>

<body class="screen_principal">

    <h2>Eliminación de Personal</h2>
    <h3>Precaución: Esta acción no se puede deshacer</h3>

    <form action="../../acciones.php" method="POST" onsubmit="return confirm('¿Está seguro de querer borrar este registro del sistema?')">
        <input type="hidden" name="accion" value="borrar_personal">

        <label>ID del pan a borrar:</label>
        <input type="text" name="id_personal" placeholder="Ej: PER01" required>

        <div class="contenedor-botones">
            <button type="submit" class="btn-borrar">Borrar Permanentemente</button>
            <button type="button" class="btn-cancelar" onclick="location.href='../personal.php'">Cancelar</button>
        </div>
    </form>

</body>
</html>