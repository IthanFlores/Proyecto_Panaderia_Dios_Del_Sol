<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador Empleado Dentro del Sistema Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_personal_css/buscar_per.css">
</head>
<main class="screen_principal">
    <h2 class="selector-title">Buscador de Personal</h2>
    <h3 class="selector-subtitle">¿A qué personal deseas buscar?</h3>

    <form action="../personal.php" method="GET">
        <label>Ingrese el id del personal para localizarlo: </label>
        <input type="text" name="buscar_id" placeholder="Ej: PER01" required>
        <br><br>
        <button type="submit">Buscar</button>
        <button type="button" onclick="location.href='../personal.php'">Cancelar</button>
    </form>

</main>
</html>