<?php
require_once 'conexiones.php';
//Registro de panes
if (isset($_POST['accion']) && $_POST['accion'] == 'registrar_pan') {

    // Extraccion de datos de la tabla tb_panes
    // En acciones.php
    $id_pan = $_POST['id_pan'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $tipo_pan = $_POST['tipo_pan'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    $tamaño = $_POST['tamaño'] ?? 'Chico';
    $ganancia_venta = $_POST['ganancia_venta'] ?? 0;
    $receta = $_POST['receta'] ?? '';
    $tipo_elaboracion = $_POST['tipo_elaboracion'] ?? 'Artesanal';
    $encargado_elaboracion = $_POST['encargado_elaboracion'] ?? '';
    $costo_elaboracion = $_POST['costo_elaboracion'] ?? 0;
    $precio_final = $_POST['precio_final'] ?? 0;

    // 3. Query de Inserción 
    $query = "INSERT INTO tb_panes (id_pan, departamento, tipo_pan, descripcion, cantidad, tamaño, 
            ganancia_venta, receta, tipo_elaboracion, encargado_elaboracion, costo_elaboracion, precio_final)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query);

    if ($stmt === false) {
        die("Fallo en la preparación del sistema: " . $conexion->error);
    }

    // 4. Bind Param: 12 tipos y 12 variables
    // s = string, i = integer, d = double/decimal
    $stmt->bind_param(
        "ssssisssssss", // Todos los numéricos como string para mayor compatibilidad
        $id_pan,
        $departamento,
        $tipo_pan,
        $descripcion,
        $cantidad,
        $tamaño,
        $ganancia_venta,
        $receta,
        $tipo_elaboracion,
        $encargado_elaboracion,
        $costo_elaboracion,
        $precio_final
    );

    if ($stmt->execute()) {
        // Intento de salto automático
        header("Location: screens%20php/panes.php?status=success");

        // Si el salto falla, esto aparecerá en la página blanca:
        echo "Misión cumplida. El pan se registró.";
        echo "<br><a href='screens%20php/panes.php'>Haga clic aquí para volver manualmente</a>";
        exit();
    } else {
        // Esto nos dirá exactamente POR QUÉ no se guardó (ej: ID repetido)
        die("Error crítico detectado: " . $stmt->error);
    }
}

//Borrar datos de tb_panes 
else if ($_POST['accion'] == 'borrar_pan') {
    $id_pan = $_POST['id_pan'];

    //Destructor
    $query = "DELETE FROM tb_panes WHERE id_pan = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $id_pan);

    if ($stmt->execute()) {
        //Regresar a la tabla de tb_panes
        header("Location: screens%20php/panes.php?status=deleted");
        exit();
    } else {
        die("Error en la eliminacion del articulo " . $stmt->error);
    }
}

//Editar panes
else if ($_POST['accion'] == 'editar_pan') {
    $id = $_POST['id_pan'];
    $tipo = $_POST['tipo_pan'];
    $depa = $_POST['departamento'];
    $desc = $_POST['descripcion'];
    $cantidad = (int)$_POST['cantidad'];
    $tam = $_POST['tamaño'];
    $gan_ven = $_POST['ganancia_venta'];
    $rec = $_POST['receta'];
    $tipo_elab = $_POST['tipo_elaboracion'];
    $encargado_elab = $_POST['encargado_elaboracion'];
    $costo_elab = $_POST['costo_elaboracion'];

        //Calculo automático 
    $precio_fin = $costo_elab + $gan_ven;

    $query = "UPDATE tb_panes SET tipo_pan=?, departamento=?, descripcion=?, cantidad=?, tamaño=?, 
                ganancia_venta=?, receta=?, tipo_elaboracion=?, encargado_elaboracion=?, 
                costo_elaboracion=?, precio_final=? WHERE id_pan=?";

    $stmt = $conexion->prepare($query);


    $stmt->bind_param(
        "ssssisssssss",
        $tipo,
        $depa,
        $desc,
        $cantidad,
        $tam,
        $gan_ven,
        $rec,
        $tipo_elab,
        $encargado_elab,
        $costo_elab,
        $precio_fin,
        $id
    );

    if ($stmt->execute()) {
        header("Location: screens%20php/panes.php?status=updated");
        exit();
    } else {
        die("Fallo en la actualización: " . $stmt->error);
    }
}
