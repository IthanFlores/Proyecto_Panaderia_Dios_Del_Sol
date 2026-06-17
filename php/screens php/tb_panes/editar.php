<?php
require_once '../../conexiones.php';
//Verificar si existe el id para poder editar
if (!$conexion) { die("Fallo en el reactor de datos"); }

$id = $_GET['id'];
$consulta = "SELECT * FROM tb_panes WHERE id_pan = '$id'";
$res = $conexion->query($consulta);
$pan = $res->fetch_assoc(); //Aqu8i se guardan los datos 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición - Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_panes_css/editar.css">
</head>

<body class="screen_principal"> <h2>Edición de panes: <?php echo $pan['id_pan']; ?></h2>
    <h3>Actualice la información del producto</h3>

    <form action="../../acciones.php" method="POST">
        <input type="hidden" name="accion" value="editar_pan">
        <input type="hidden" name="id_pan" value="<?php echo $pan['id_pan']; ?>">

        <label>Nombre pan:</label>
        <input type="text" name="tipo_pan" value="<?php echo $pan['tipo_pan']; ?>">

        <label>Departamento</label>
        <select name="departamento">
            <option value="Panaderia" <?php echo ($pan['departamento'] == 'Panaderia') ? 'selected' : ''; ?>>Panadería</option>
            <option value="Pasteleria" <?php echo ($pan['departamento'] == 'Pasteleria') ? 'selected' : ''; ?>>Pastelería</option>
            <option value="Galleteria" <?php echo ($pan['departamento'] == 'Galleteria') ? 'selected' : ''; ?>>Galletería</option>
        </select>

        <label>Descripción</label>
        <input type="text" name="descripcion" value="<?php echo $pan['descripcion']; ?>">

        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="<?php echo $pan['cantidad']; ?>">

        <label>Tamaño</label>
        <select name="tamaño">
            <option value="Chico" <?php echo ($pan['tamaño'] == 'Chico') ? 'selected' : ''; ?>>Chico</option>
            <option value="Mediano" <?php echo ($pan['tamaño'] == 'Mediano') ? 'selected' : ''; ?>>Mediano</option>
            <option value="Grande" <?php echo ($pan['tamaño'] == 'Grande') ? 'selected' : ''; ?>>Grande</option>
        </select>

        <label>Ganancia por venta</label>
        <input type="number" step="0.01" name="ganancia_venta" value="<?php echo $pan['ganancia_venta']; ?>">

        <label>Receta</label>
        <input type="text" name="receta" value="<?php echo $pan['receta']; ?>">

        <label>Tipo de elaboración</label>
        <select name="tipo_elaboracion">
            <option value="Artesanal" <?php echo ($pan['tipo_elaboracion'] == 'Artesanal') ? 'selected' : ''; ?>>Artesanal</option>
            <option value="Compuesto" <?php echo ($pan['tipo_elaboracion'] == 'Compuesto') ? 'selected' : ''; ?>>Compuesto</option>
        </select>

        <label>Encargado de elaboración</label>
        <input type="text" name="encargado_elaboracion" value="<?php echo $pan['encargado_elaboracion']; ?>">

        <label>Costo de Elaboración</label>
        <input type="number" step="0.01" name="costo_elaboracion" value="<?php echo $pan['costo_elaboracion']; ?>">

        <label>Precio Final (Calculado):</label>
        <input type="number" name="precio_final" id="precio_final" readonly class="input-readonly">

        <button type="submit">Actualizar tabla de panes</button>
        <button type="button" class="btn-cancel" onclick="location.href = '../panes.php'">Cancelar</button>
    </form>
</body>