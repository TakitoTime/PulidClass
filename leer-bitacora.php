<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

$conexion = new mysqli('localhost', 'root', '', 'pulidclass');

if($conexion->connect_errno){
    $respuesta = [
        'error' => true
    ];
}else{
    $conexion->set_charset("utf8");
    $statement = $conexion->prepare("SELECT * FROM bitacora");
    $statement->execute();
    $resultados = $statement->get_result();

    $respuesta = [];

    while($fila = $resultados->fetch_assoc()){

        array_push($respuesta, $fila);
    }
}

echo json_encode($respuesta);

?>