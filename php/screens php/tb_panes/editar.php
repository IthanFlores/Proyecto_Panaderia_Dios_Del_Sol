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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion de Panaderia Dios del Sol</title>
</head>

<body>
    <h2>Edicion de panes: <?php echo $pan['id_pan']; ?></h2>
    <form action="../../acciones.php" method="POST">
        <input type="hidden" name="accion" value="editar_pan">
        <input type="hidden" name="id_pan" value="<?php echo $pan['id_pan']; ?>"> <br>

        <label>Nombre pan:</label>
        <input type="text" name="tipo_pan" value="<?php echo $pan['tipo_pan']; ?>"><br>

        <label">Departamento</label>
            <select name="departamento">
                <option value="Panaderia" <?php echo ($pan['departamento'] == 'Panaderia') ? 'selected' : ''; ?>>
                    Panadeía
                </option>
                <option value="Pasteleria" <?php echo ($pan['departamento'] == 'Pasteleria') ? 'selected' : ''; ?>>
                    Pastelería
                </option>
                <option value="Galleteria" <?php echo ($pan['departamento'] == 'Galleteria') ? 'selected' : ''; ?>>
                    Galletería
                </option>
            </select><br>

            <label>Descripcion</label>
            <input type="text" name="descripcion" value="<?php echo $pan['descripcion']; ?>"> <br>

            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="<?php echo $pan['cantidad']; ?>"><br>

            <label>Tamaño</label>
            <select name="tamaño">
                <option value="Chico" <?php echo ($pan['tamaño'] == 'Chico') ? 'selcted' : ''; ?>>
                    Chico
                </option>
                <option value="Mediano" <?php echo ($pan['tamaño'] == 'Mediano') ? 'selected' : ''; ?>>
                    Mediano
                </option>
                <option value="Grande" <?php echo ($pan['tamaño'] == 'Grande') ? 'selected' : ''; ?>>
                    Grande
                </option>
            </select> <br>

            <label>Ganancia por venta</label>
            <input type="number" step="0.01" name="ganancia_venta" value="<?php echo $pan['ganancia_venta']; ?>"><br>

            <label>Receta</label>^
            <input type="text" name="receta" value="<?php echo $pan['receta']; ?>"><br>

            <label>Tipo de elaboracion</label>
            <select name="tipo_elaboracion">
                <option value="Artesanal" <?php echo ($pan['tipo_elaboracion'] == 'Artesanal') ? 'selected' : ''; ?>>
                    Artesanal
                </option>

                <option value="Compuesto" <?php echo ($pan['tipo_elaboracion'] == 'Compuesto') ? 'selected' : ''; ?>>
                    Compuesto
                </option>
            </select><br>

            <label>Encargado de elaboracion</label>
            <input type="text" name="encargado_elaboracion" value="<?php echo $pan['encargado_elaboracion']; ?>"><br>

            <label>Costo de Elaboracion</label>
            <input type="number" step="0.01" name="costo_elaboracion" value="<?php echo $pan['costo_elaboracion']; ?>"><br>

            <label>Precio Final (Calculado):</label>
            <input type="number" name="precio_final" id="precio_final" readonly placeholder="Se calculará solo"><br>

            <button type="submit">Actualizar tabla de panes</button>
            <button type="button" onclick="location.href = '../panes.php'">Cancelar</button>


    </form>
</body>
<script>
    const costo = document.getElementsByName('costo_elaboracion')[0];
    const ganancia = document.getElementsByName('ganancia_venta')[0];
    const precio = document.getElementById('precio_final');

    function calcular() {
        precio.value = (parseFloat(costo.value || 0) + parseFloat(ganancia.value || 0)).toFixed(2);
    }
    costo.addEventListener('input', calcular);
    ganancia.addEventListener('input', calcular);
    window.onload = calcular; // Calcular al cargar los datos
</script>

</html>