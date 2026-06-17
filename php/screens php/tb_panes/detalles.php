<?php 
require_once '../../conexiones.php';

// ==>> Validar que reciba un id que exista <<==
$id_pan = isset($_GET["id"]) ? $_GET["id"] : '';

if (empty($id_pan)) {
    die("Error: No se ha encontrado un id valido");
}

$query = "SELECT * FROM tb_panes WHERE id_pan = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $id_pan);
$stmt-> execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Registro inexistente en la base de datos");
}

$pan = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Pan - <?php echo htmlspecialchars($pan['tipo_pan']); ?></title>
    <link rel="stylesheet" href="../../../assets/css/detalles.css">
</head>
<body>
    <h1>Especificaciones Técnicas: <?php echo htmlspecialchars($pan['tipo_pan']); ?></h1>

    <table class="tabla-detalles">
        <tr><th>ID</th><td><?php echo htmlspecialchars($pan['id_pan']); ?></td></tr>
        <tr><th>Departamento</th><td><?php echo htmlspecialchars($pan['departamento']); ?></td></tr>
        <tr><th>Nombre Pan</th><td><?php echo htmlspecialchars($pan['tipo_pan']); ?></td></tr>
        <tr><th>Descripción del pan</th><td><?php echo htmlspecialchars($pan['descripcion']); ?></td></tr>
        <tr><th>Cantidad</th><td><?php echo htmlspecialchars($pan['cantidad']); ?> unidades</td></tr>
        <tr><th>Tamaño del pan</th><td><?php echo htmlspecialchars($pan['tamaño']); ?></td></tr>
        <tr><th>Ganancia por venta</th><td>$<?php echo htmlspecialchars($pan['ganancia_venta']); ?></td></tr>
        <tr><th>Receta de elaboración</th><td><?php echo htmlspecialchars($pan['receta']); ?></td></tr>
        <tr><th>Tipo de elaboración</th><td><?php echo htmlspecialchars($pan['tipo_elaboracion']); ?></td></tr>
        <tr><th>Encargado de elaboración</th><td><?php echo htmlspecialchars($pan['encargado_elaboracion']); ?></td></tr>
        <tr><th>Costo de elaboración</th><td>$<?php echo htmlspecialchars($pan['costo_elaboracion']); ?></td></tr>
        <tr><th>Precio Final</th><td><strong>$<?php echo htmlspecialchars($pan['precio_final']); ?></strong></td></tr>
    </table>

    <a href="../panes.php" class="btn-volver">Volver a Gestionar</a>
</body>
</html>