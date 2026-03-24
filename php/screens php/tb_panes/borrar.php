<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar panes Panaderia Dios del Sol</title>
</head>

<body>
    <h2>Eliminacion de Panes</h2>
    <form action="../../acciones.php" method="POST" onsubmit="return confirm('Esta seguro de querer borrar est registro del sistema?')">
    <input type="hidden" name="accion" value="borrar_pan">

    <label>ID del pana a borrar</label>
    <input type="text" name="id_pan" placeholder="Ej: PAN-01" required>

    <br><br>
    <button type="submit">Borrar Permanentemente </button>
    <button type="button" onclick="location.href='../panes.php'">Cancelar</button>
    </form>
</body>

</html>