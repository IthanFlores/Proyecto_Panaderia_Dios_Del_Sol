<?php
require_once '../conexiones.php';

$sql = "SELECT * FROM tb_personal";
$busqueda_activa = false;

if (isset($_GET['buscar_id']) && !empty($_GET['buscar_id'])) {
    $busqueda = $_GET['buscar_id'];
    $sql = "SELECT * FROM tb_personal WHERE id_personal LIKE '%$busqueda%'";
    $busqueda_activa = true;
}
$resultado = $conexion->query($sql);

$pertotal = $conexion->query('SELECT COUNT(*) as total FROM tb_personal');
$totalPersonal = $pertotal->fetch_assoc()['total'];

$mensajeEstado = '';
$mensajeEstado_ng = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success')
        $mensajeEstado = '+1 personal agregado recientemente';
    if ($_GET['status'] == 'deleted')
        $mensajeEstado_ng = '-1 personal agregado recientemente';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inventario del Personal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/personal.css">
</head>

<body>

    <aside class="sidebar-menu">
        <div>
            <img class="img-sidebar-menu" src="../../assets/img/tb_panaderos_img/img_barra.jpg" alt="panadero sidebar">
        </div>
        <div class="sidebar-header">
            <h2> Panaderia Dios del Sol </h2>
        </div>

        <nav class="btns-inventario">
            <button class="btns-inventario__boton btns-inventario__boton-agregar"
                onclick="location.href='tb_personal/agregar_per.php'">Agregar Personal</button>
            <button class="btns-inventario__boton btns-inventario__boton-buscar"
                onclick="location.href='tb_personal/buscar_per.php'">Buscar Personal</button>
            <button class="btns-inventario__boton btns-inventario__boton-encargados"
                onclick="location.href='./panes.php'">Ver todos los panes</button>
            <button class="btns-inventario__boton btns-inventario__boton-menu"
                onclick="location.href='../../index.html'">Volver al Menú</button>
        </nav>
    </aside>

    <main class="pantalla-principal">

        <h1 class="title_table" style="text-align: center !important; width: 100%; display: block;">Gestión del Personal
        </h1>
        <div class="contenedor-tarjetas">

            <div class="tarjeta-stats">
                <div class="tarjeta-icono icono-total">
                    <img src="../../assets/img/tb_panaderos_img/total_personal.jpg" alt="Icono Personal">
                </div>
                <div class="tarjeta-info">
                    <p class="tarjeta-etiqueta">Total Personal</p>
                    <h2 class="tarjeta-valor"><?php echo $totalPersonal; ?> Personal Registrado </h2>
                    <small class="tarjeta-cambio success"><?php echo $mensajeEstado; ?></small>
                    <small class="tarjeta-cambio successneg"><?php echo $mensajeEstado_ng; ?></small>
                </div>
            </div>
        </div>

        <br>
        <?php if (isset($_GET['buscar_id'])): ?>
            <button class="btn-reset-inventario" type="button" onclick="location.href='personal.php'">Ver Personal completo
            </button>
            <br><br>
        <?php endif; ?>

        <table class="inventario-tabla" border="1">
            <thead>
                <tr>
                    <th>ID del trabajador</th>
                    <th>Nombre del trabajador</th>
                    <th>Telefono del trabajador</th>
                    <th>Correo del trabajador</th>
                    <th>Fecha de ingreso</th>
                    <th>Estado de Trabajador</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($resultado)) {
                    $modificador = ($fila['fecha_ingreso'] < 5) ? 'inventario-tabla__fila--alerta' : '';
                ?>
                    <tr class="inventario-tabla__fila <?php echo $modificador ?>">
                        <td><?php echo $fila['id_personal'] ?></td>
                        <td>
                            <strong><?php echo $fila['nombre_per'] ?></strong> <br>
                            <a href="tb_personal/detalles_per.php?id=<?php echo $fila['id_personal']; ?>" class="link-detalles">
                                <i class="fa-solid fa-eye"></i> Ver Detalles
                            </a>

                        </td>
                        <td>
                            <?php echo $fila['telefono_per']; ?> </
                                </td>
                        <td><?php echo $fila['correo_per'] ?></td>
                        <td><?php echo $fila['fecha_ingreso'] ?></td>
                        <td><?php echo $fila['estado_per'] ?></td>
                        <td class="botones_accion">
                            <a href="tb_personal/editar_per.php?id=<?php echo $fila['id_personal']; ?>" title="Editar personal">
                                <button class="icon-btn icon-btn--edit">
                                    <i class="fa-solid fa-pen-to-square"></i> </button>
                            </a>

                            <a href="tb_personal/borrar_per.php?id=<?php echo $fila['id_personal']; ?>" title="Borrar personal">
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