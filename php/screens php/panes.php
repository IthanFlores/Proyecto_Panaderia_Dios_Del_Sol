<?php
require_once '../conexiones.php';

// 1. LÓGICA DE BÚSQUEDA (Debe ir arriba)
$sql = "SELECT * FROM tb_panes";
$busqueda_activa = false;

if(isset($_GET['buscar_id']) && !empty($_GET['buscar_id'])){
    $busqueda = $_GET['buscar_id'];
    // Corregido: añadimos el $ a busqueda
    $sql = "SELECT * FROM tb_panes WHERE id_pan LIKE '%$busqueda%'";
    $busqueda_activa = true;
}
$resultado = $conexion->query($sql);

//Logica de estadisticas
//Muestra los panes generales
$restotal = $conexion->query('SELECT COUNT(*) as total FROM tb_panes');
$totalPanes = $restotal->fetch_assoc()['total'];

//Muestra los panes artesanales
$resArtesanal = $conexion->query('SELECT COUNT(*) as total FROM tb_panes WHERE tipo_elaboracion ="Artesanal"');
$totalArtesanales =$resArtesanal->fetch_assoc()['total'];

//Muestra los panes compuestos
$resCompuesto = $conexion->query('SELECT COUNT(*) as total FROM tb_panes WHERE tipo_elaboracion = "Compuesto"');
$totalCompuestos = $resCompuesto->fetch_assoc()['total'];

//Mensajes del estado de las conexiones
$mensajeEstado = '';
if(isset($_GET['status'])){
    if($_GET['status'] == 'success') $mensajeEstado = '+1 pane(s) agregados recientemente';
    if($_GET['status'] == 'deleted') $mensajeEstado = '-1 pane(s) borrados recientemente';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario Dios del Sol</title>
    <link rel="stylesheet" href="assets/css/panes.css"> 
</head>
<body>
    <h1>Gestión de Panes</h1>
    <h3>Gestion de Panes en Panaderia Dios del Sol</h3>

    <div class="dashboard-cards">
        <div class="cards">
            <div class="card__image--container">
                <img src="../../assets/img/logo-pet.png" alt="total" class="card__image">
            </div>
            <div class="card__content">
                <p class="card__title">Total de panes</p>
                <h2 class="card__number"> <?php echo $totalPanes; ?> tipos </h2>
                <small class="card__status"> <?php echo $mensajeEstado; ?> </small>
            </div>
        </div>

        <div class="cards">
            <div class="card__image-conatiner">
                <img src="../../assets/img/pan-art01.png" alt="total" class="card__img">
            </div>
            <div class="card__content">
                <p class="card__title">Total de Panes Artesanales</p>
                <h2 class="card__number"> <?php echo $totalArtesanales; ?> tipos </h2>
            </div>
        </div>

        <div class="cards">
            <div class="card__image--container">
                <img src="../../assets/img/pan-compuesto01.png" alt="total" class="card__img">
            </div>
            <div class="cards__content">
                <p class="card__title"> Total de Panes Artesanales</p>
                <h2 class="card__number"> <?php echo $totalCompuestos; ?> tipos </h2>
            </div>
        </div>

    </div>


    <nav class="btns-inventario">
        <button class="btns-inventario__boton btns-inventario__btn--agregar" onclick="location.href='tb_panes/agregar.php'">Agregar Pan</button>
        <button class="btns-inventario__boton btns-inventario__btn--buscar" onclick="location.href='tb_panes/buscar.php'">Buscar pan</button>
        <button class="btns-inventario__boton btns-inventario__btn--panaderos" onclick="location.href='../../encargados.html'">ver Panaderos</button>
        <button class="btns-inventario__boton btns-inventario__btn--menu" onclick="location.href='../../index.html'">Volver al Menú</button>
    </nav>
    <br>

    <?php if(isset($_GET['buscar_id'])): ?>
    <button type="button" onclick="location.href='panes.php'">
        Ver inventario completo
    </button>
    <br><br>
<?php endif; ?>

    <table class="inventario-tabla" border="1">
        <thead>
            <tr>
                <th class="inventario-tabla__encabezado">ID</th>
                <th class="inventario-tabla__encabezado">Departamento</th>
                <th class="inventario-tabla__encabezado">Nombre Pan</th>
                <th class="inventario-tabla__encabezado">Decripcion del pan</th>
                <th class="inventario-tabla__encabezado">Cantidad</th>
                <th class="inventario-tabla__encabezado">Tamaño del pan</th>
                <th class="inventario-tabla__encabezado">ganancia por venta</th>
                <th class="inventario-tabla__encabezado">Receta de elbaoracion</th>
                <th class="inventario-tabla__encabezado">Tipo de elbaoracion</th>
                <th class="inventario-tabla__encabezado">Encargado de elbaoracion</th>
                <th class="inventario-tabla__encabezado">De elaboracion costo</th>
                <th class="inventario-tabla__encabezado">Precio Final</th>
                <th class="inventario-tabla__encabezado">ACCIONES</th> </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_array($resultado)){
                $modificador = ($fila['cantidad'] < 5) ? 'inventario-tabla__fila--alerta' : '';
                ?>
                
            <tr class="inventario-tabla__fila <?php echo $modificador ?>">
                <td class="inventario-tabla__celda"> <?php echo $fila['id_pan'] ?> </td>
                <td class="inventario-tabla__celda"> <?php echo $fila['departamento'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['tipo_pan'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['descripcion'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['cantidad'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['tamaño'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['ganancia_venta'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['receta'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['tipo_elaboracion'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['encargado_elaboracion'] ?></td>
                <td class="inventario--tabla__celda"> <?php echo $fila['costo_elaboracion'] ?></td>
                <td class="inventario-tabla__celda"> <?php echo $fila['precio_final'] ?></td>
                <td class="inventario-tabla__celda">
                    <a href="tb_panes/editar.php?id=<?php echo $fila['id_pan']; ?>">
                        <button class="inventario-tabla__boton inventario-tabla__boton--editar">Editar</button>
                    </a>
                    <a href="tb_panes/borrar.php?id=<?php echo $fila['id_pan']; ?>">
                        <button class ="inventario-tabla__boton inventario-tabla__boton--borrar">Borrar</button>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>