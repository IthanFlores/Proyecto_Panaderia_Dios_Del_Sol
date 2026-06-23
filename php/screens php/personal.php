<?php
require_once '../../conexiones.php';

$sql = "SELECT * FROM tb_panes";
$busqueda_activa = false;

if (isset($_GET['buscar_id']) && !empty($_GET['buscar_id'])) {
    $busqueda = $_GET['buscar_id'];
    $sql = "SELECT * FROM tb_panes WHERE id_pan LIKE '%$busqueda%'";
    $busqueda_activa = true;
}
$resultado = $conexion->query($sql);

$restotal = $conexion->query('SELECT COUNT(*) as total FROM tb_panes');
$totalPanes = $restotal->fetch_assoc()['total'];

$resArtesanal = $conexion->query('SELECT COUNT(*) as total FROM tb_panes WHERE tipo_elaboracion ="Artesanal"');
$totalArtesanales = $resArtesanal->fetch_assoc()['total'];

$resCompuesto = $conexion->query('SELECT COUNT(*) as total FROM tb_panes WHERE tipo_elaboracion = "Compuesto"');
$totalCompuestos = $resCompuesto->fetch_assoc()['total'];

$mensajeEstado = '';
$mensajeEstado_ng = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success')
        $mensajeEstado = '+1 pan(es) agregados recientemente';
    if ($_GET['status'] == 'deleted')
        $mensajeEstado_ng = '-1 pan(es) borrados recientemente';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inventario del Personal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/panes.css">
</head>

<body>

    <aside class="sidebar-menu">
        <div>
            <img class="img-sidebar-menu" src="../../../assets/img/img-sidebar-2.png" alt="panadero sidebar">
        </div>
        <div class="sidebar-header">
            <h2> Panaderia Dios del Sol </h2>
        </div>

        <nav class="btns-inventario">
            <button class="btns-inventario__boton btns-inventario__boton-agregar"
                onclick="location.href='agregar_per.php'">Agregar Personal</button>
            <button class="btns-inventario__boton btns-inventario__boton-buscar"
                onclick="location.href='buscar_per'">Buscar Personal</button>
            <button class="btns-inventario__boton btns-inventario__boton-encargados"
                onclick="location.href='detaller_per.php'">Ver Todo El Personal</button>
            <button class="btns-inventario__boton btns-inventario__boton-menu"
                onclick="location.href=''">Volver al Menú</button>
        </nav>
    </aside>

    <main class="pantalla-principal">

        <h1 class="title_table" style="text-align: center !important; width: 100%; display: block;">Gestión del Personal
        </h1>
        <div class="contenedor-tarjetas">

            <div class="tarjeta-stats">
                <div class="tarjeta-icono icono-total">
                    <img src="../../../assets/img/logo-pet.png" alt="Icono Pan">
                </div>
                <div class="tarjeta-info">
                    <p class="tarjeta-etiqueta">Total Panes</p>
                    <h2 class="tarjeta-valor"><?php echo $totalPanes; ?> tipos</h2>
                    <small class="tarjeta-cambio success"><?php echo $mensajeEstado; ?></small>
                    <small class="tarjeta-cambio successneg"><?php echo $mensajeEstado_ng; ?></small>
                </div>
            </div>

            <div class="tarjeta-stats">
                <div class="tarjeta-icono icono-artesanal">
                    <img src="../../../assets/img/pan-art01.png" alt="Icono Artesanal">
                </div>
                <div class="tarjeta-info">
                    <p class="tarjeta-etiqueta">Panes Artesanales</p>
                    <h2 class="tarjeta-valor"><?php echo $totalArtesanales; ?> tipos</h2>
                </div>
            </div>

            <div class="tarjeta-stats">
                <div class="tarjeta-icono icono-compuesto">
                    <img src="../../../assets/img/pan-compuesto01.png" alt="Icono Compuesto">
                </div>
                <div class="tarjeta-info">
                    <p class="tarjeta-etiqueta">Panes Compuestos</p>
                    <h2 class="tarjeta-valor"><?php echo $totalCompuestos; ?> tipos</h2>
                </div>
            </div>
        </div>

        <br>
        <?php if (isset($_GET['buscar_id'])): ?>
            <button class="btn-reset-inventario" type="button" onclick="location.href='panes.php'">Ver inventario
                completo</button>
            <br><br>
        <?php endif; ?>

        <table class="inventario-tabla" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Nombre Pan</th>
                    <th>Cantidad</th>
                    <th>Tipo de elbaoracion</th>
                    <th>Precio Final</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($resultado)) {
                    $modificador = ($fila['cantidad'] < 5) ? 'inventario-tabla__fila--alerta' : '';
                    ?>
                    <tr class="inventario-tabla__fila <?php echo $modificador ?>">
                        <td><?php echo $fila['id_pan'] ?></td>
                        <td><?php echo $fila['departamento'] ?></td>
                        <td>
                            <strong> <?php echo $fila['tipo_pan']; ?> </strong> <br>
                            <a href="tb_panes/detalles.php?id=<?php echo $fila['id_pan']; ?>" class="link-detalles">
                                <i class="fa-solid fa-eye"></i> Ver Detalles
                            </a>
                        </td>
                        <td><?php echo $fila['cantidad'] ?></td>
                        <td><?php echo $fila['tipo_elaboracion'] ?></td>
                        <td><?php echo $fila['precio_final'] ?></td>
                        <td class="botones_accion">
                            <a href="tb_panes/editar.php?id=<?php echo $fila['id_pan']; ?>" title="Editar Pan">
                                <button class="icon-btn icon-btn--edit">
                                    <i class="fa-solid fa-pen-to-square"></i> </button>
                            </a>

                            <a href="tb_panes/borrar.php?id=<?php echo $fila['id_pan']; ?>" title="Borrar Pan">
                                <button class="icon-btn icon-btn--delete">
                                    <i class="fa-solid fa-trash-can"></i> </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>