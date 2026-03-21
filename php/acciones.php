<?php 
require_once 'conexiiones.php';

//Detectar si se enviaron acciones desde un formulairo 
if(isset($_POST['accion'])) {
    //REGISTRO DE NUEVO PAN
    if($_POST['accion'] == 'registrar_pan') {

        $id_pan = $_POST['id_pan'];
        $departamento = $_POST['departamento'];
        $tipo_pan = $_POST['tipo_pan'];
        $descripcion = $_POST['descripcion'];
        $cantidad = (int)$_POST['cantidad'];
        $tamaño = $_POST['tamaño']; //Debe ser 'Chico', 'Mediano' o 'Grande'
        $ganacia_venta = $_POST['ganancia_venta'];
        $receta = $_POST['receta'];
        $tipo_elaboracion = $_POST['tipo_elaboracion']; //Debe de ser 'Artesanal' o 'Compuesto'
        $encargado_elaboracion = $_POST['encargado_elaboracion'];
        $costo_elaboracion = $_POST['costo_elaboracion'];
        $precio_final = $_POST['precio_final'];

        //Evitar ataques de inyección o malisios de sql
        $query = "INSERT INTO tb_panes (id_panes, departamento, tipo_pan, descripcion, cantidad, tamaño, 
        ganancia_venta, receta, tipo_elaboración, encargado_elaboracion, costo_elaboración, precio_final)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($query);

        #/Definicion de tipos 
        // String, int, decimal/duble
        $stmt->bind_param("ssssisdsssdd",
        $id_pan, $departamento, $tipo_pan, $descripcion, $cantidad, $tamaño, $ganacia_venta, $receta, 
        $tipo_elaboracion, $costo_elaboracion, $precio_final
        );

        if($stmt->execute()){
            header("Location: screens php/panes.php?status=success");
        } else {
            "Error en la secuencia de ingreso" . $conexion->error;
        }

        

    }
}

?>