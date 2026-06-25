<?php
require_once '../../conexiones.php';

if (!$conexion) {
    die("Fallo en el reactor de datos");
}

$id = $_GET['id'];
$consulta = "SELECT * FROM tb_personal WHERE id_personal = '$id'";
$res = $conexion->query($consulta);
$per = $res->fetch_assoc(); //Aqu8i se guardan los datos 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición - Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_personal_css/editar_per.css">
</head>

<body class="screen_principal">
    <h2>Edición de Personal: <?php echo $per['id_personal']; ?></h2>
    <h3>Actualice la información del personal</h3>

    <form action="../../acciones.php" method="POST">
        <input type="hidden" name="accion" value="editar_personal">
        <input type="hidden" name="id_personal" value="<?php echo $per['id_personal']; ?>" required>

        <label>Nombre Del Personal:</label>
        <input type="text" name="nombre_per" value="<?php echo $per['nombre_per']; ?>" required>

        <label>Telefono del personal </label>
        <input type="text" name="telefono_per" value="<?php echo $per['telefono_per']; ?>" required>

        <label>Correo del Personal:</label>
        <input type="text" name="correo_per" value="<?php echo $per['correo_per']; ?>" required>

        <label>Direccion del Personal</label>
        <input type="text" name="direccion_per" value="<?php echo $per['direccion_per']; ?>" required>

        <label>Salario del Personal</label>
        <input type="number" step="1" name="salario_per" value="<?php echo $per['salario_per']; ?>" required>

        <label>Fecha de Ingreso</label>
        <input type="date" name="fecha_ingreso" value="<?php echo $per['fecha_ingreso']; ?>" required>

        <label>Puesto</label>
        <select name="puesto_per" required>
            <option value="Gerente" <?php echo ($per['puesto_per'] == 'Gerente') ? 'selected' : ''; ?>>Gerente</option>
            <option value="Repartidor" <?php echo ($per['puesto_per'] == 'Repartidor') ? 'selected' : ''; ?>>Repartidor</option>
            <option value="Intendente" <?php echo ($per['puesto_per'] == 'Intendente') ? 'selected' : ''; ?>>Intendente</option>
            <option value="Seguridad" <?php echo ($per['puesto_per'] == 'Seguridad') ? 'selected' : ''; ?>>Seguridad</option>
        </select>

        <label>Estado del Personal</label>
        <select name="estado_per" required>
            <option value="Activo" <?php echo ($per['estado_per'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
            <option value="Inactivo" <?php echo ($per['estado_per'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
        </select>

        <button type="submit">Actualizar tabla de personales</button>
        <button type="button" class="btn-cancel" onclick="location.href = '../personal.php'">Cancelar</button>
    </form>
</body>

</html>