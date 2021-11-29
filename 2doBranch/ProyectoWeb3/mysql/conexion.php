<?php
    define("KEY","compras");
    define("COD","AES-128-ECB");
    $servidor="localhost";
    $bd="store";
    $usuario="root";
    $clave="";

    $conexion = new mysqli($servidor,$usuario,$clave,$bd) or die ("Error de conexion");
?>