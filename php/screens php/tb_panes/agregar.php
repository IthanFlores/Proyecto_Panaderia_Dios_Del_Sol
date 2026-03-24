<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de panes de Dios del Sol</title>
</head>

<body>
    <h2>Registra Un Nuevo Pan</h2>

    <form action="../../acciones.php" method="POST">
        <input type="hidden" name="accion" value="registrar_pan">
        <!-- Id del pan-->
        <label> ID Pan: </label> <input type="text" name="id_pan" required><br>
        <!-- Nombre del pan-->
        <label>Nombre del pan</label> <input type="text" name="tipo_pan" required><br>
        <!-- Descripcion del pan -->
        <label>Descripcion</label> <input type="text" name="descripcion"><br>
        <!--Cantidad de panes -->
        <label>Cantidad</label> <input type="number" name="cantidad"><br>

        <!-- En que departaento se vende el producto -->
        <label>Departamento: </label>
        <select name="departamento">
            <option value="Panaderia">Panadería</option>
            <option value="Pasteleria">Pastelería</option>
            <option value="Galleteria">Galletería</option>
        </select><br>
        <!--Tamaño del pan -->
        <label>Tamaño</label>
        <select name="tamaño">
            <option value="Chico">Chico</option><br>
            <option value="Mediano">Mediano</option><br>
            <option value="Grande">Grande</option><br>
        </select><br>
        <!--Ganacia por cada venta del pan -->
        <label>Ganancia por venta</label> <input type="number" step="0.01" name="ganancia_venta"><br>
        <!--Receta del pan -->
        <label>Receta de pan</label> <input type="text" name="receta"><br>
        <!--De que forma se hizo el pan -->
        <label>Tipo de elaboracion </label>
        <select name="tipo_elaboracion" >
            <option value="Artesanal">Artesanal</option>
            <option value="Compuesto">Compuesto</option>
        </select><br>
        <!--Quien hizo el pan -->
        <label>Encargado de elaboración</label> <input type="text" name="encargado_elaboracion"><br>
        <!--Costo por elaborar cada pan por pieza  -->
        <label>Costo de elaboracion</label> <input type="number" step="0.01" name="costo_elaboracion"><br>
        <!--Precio total del pan sumando el precio de elaboracion y el ganancia por venta  -->
        <label>Precio final</label> <input type="number" step="0.01" name="precio final"><br>

        <button type="submit">Guardar Registro</button>
        <button type="button" onclick="location.href='../panes.php'">Cancelar</button>
    </form>
</body>
</html>