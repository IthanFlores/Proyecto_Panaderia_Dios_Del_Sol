<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Personal de Dios del Sol</title>
    <link rel="stylesheet" href="../../../assets/css/tb_panes_css/agregar.css">
</head>

<main class="screen__principal">
    <h2 class="title_Register">Registra Un Nuevo Empleado</h2>

    <form action="" method="POST">
        <input type="hidden" name="accion" value="registrar_pan" required>
        <!-- Id del pan-->
        <label> ID Personal: </label> <input type="text" name="id_pan" required><br>
        <!-- Nombre del pan-->
        <label>Nombre del Empleado:</label> <input type="text" name="tipo_pan" required><br>
        <!-- Descripcion del pan -->
        <label>Telefono:</label> <input type="text" name="descripcion" required><br>
        <!--Cantidad de panes -->
        <label>Correo:</label> <input type="number" name="cantidad" required><br>
        <label>Dirección:</label> <input type="number" name="cantidad" required><br>

        <!-- En que departaento se vende el producto -->
        <label>Puesto: </label>
        <select name="departamento" required>
            <option value="Gerente">Gerente</option>
            <option value="Repartidor">Repartidor</option>
            <option value="Intendente">Intendente</option>
            <option value="Seguridad">Seguridad</option>
        </select><br>

        <label>Salario:</label> <input type="number" name="receta" required><br>

        <label>Fecha de ingreso:</label> <input type="date" name="encargado_elaboracion" required><br>
        <!--Tamaño del pan -->
        <label>Estado:</label>
        <select name="tamaño" required>
            <option value="Activo">Activo</option><br>
            <option value="Inactivo">Inactivo</option><br>
        </select><br>
        <!--Receta del pan -->
        
        

        <button type="submit">Guardar Registro</button>
        <button type="button" onclick="location.href='../panes.php'">Cancelar</button>
    </form>
</main>

</html>