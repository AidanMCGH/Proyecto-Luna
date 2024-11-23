<?php

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="iamib";

$conexion = new mysqli ($db_host, $db_user,$db_pass,$db_name);
if ($conexion->connect_error){
    error_log("Error de Conexion:". $conexion->connect_error);
    echo "No se pudo conectar a la base de datos";
    exit;
}else{


};
?>