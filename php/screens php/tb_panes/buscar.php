<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Panaderia Dios edl sol</title>
</head>
<body>
    <h2>Buscador de Pan</h2>
    <h3>¿Qué Pan deseas buscar?</h3>

    <form action="../panes.php" method="GET">
        <label>Ingrese el id del pan para localizarlo: </label>
        <input type="text" name="buscar_id" placeholder="Ej: CH01" required>
        <br><br>
        <button type="submit">Buscar</button>
        <button type="button" onclick="location.href='../panes.php'">Cancelar</button>
    </form>

</body>
</html>