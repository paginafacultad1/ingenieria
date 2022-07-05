<?php

$servidor ="";
$usuario="";
$cont="";
$bd="";
$conexion = new msqli($servidor,$usuario,$cont,$bd);
if ($conexion ->conect_erro){
    die("La conexion ha fallado" . $conexion ->connec_errno);
} else {
    echo "Conectado";
}
?>