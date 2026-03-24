<?php
//Redaccion de credenciales de WampServer
$servidor = "localhost";
$usuario = "root";
$password = ""; // Se deja vacio pq el usuario de wampserver no tiene contraseña 
$base_datos = "panaderia_isa";

//Creamos la conexion con la base de datos
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

//Verificar la conexion
if ($conexion->connect_error) {
    die("Fallo en la conexión" . $conexion->connect_error);
}

//Evitar errores en caracteres con tildes o ñ
$conexion->set_charset("utf8");
?>