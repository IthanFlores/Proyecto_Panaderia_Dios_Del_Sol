<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Panes - Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_panes_css/borrar.css">
</head>

<body class="screen_principal">

    <h2>Eliminación de Panes</h2>
    <h3>Precaución: Esta acción no se puede deshacer</h3>

    <form action="../../acciones.php" method="POST" onsubmit="return confirm('¿Está seguro de querer borrar este registro del sistema?')">
        <input type="hidden" name="accion" value="borrar_pan">

        <label>ID del pan a borrar:</label>
        <input type="text" name="id_pan" placeholder="Ej: PAN-01" required>

        <div class="contenedor-botones">
            <button type="submit" class="btn-borrar">Borrar Permanentemente</button>
            <button type="button" class="btn-cancelar" onclick="location.href='../panes.php'">Cancelar</button>
        </div>
    </form>

</body>
</html>