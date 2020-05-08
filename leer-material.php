<?php session_start();

error_reporting(0);
header('Content-type: application/json; charset=utf-8');


$conexion = new mysqli('localhost', 'root', '', 'pulidclass');


if($conexion->connect_errno){
    $respuesta = [
        'error' => true
    ];
}else{
    if(isset($_SESSION['asesor'])){

    $correo=$_SESSION['asesor'];

    $conexion->set_charset("utf8");
        $statement = $conexion->prepare("SELECT Id_Material, Correo, Titulo, Materia, Fecha FROM material where correo= '$correo'");
        $statement->execute();
        $resultados = $statement->get_result();
    
        $respuesta = [];
    
        while($fila = $resultados->fetch_assoc()){
            array_push($respuesta, $fila);
        }
    }else{
        $conexion->set_charset("utf8");
        $statement = $conexion->prepare("SELECT Id_Material, Correo, Titulo, Materia, Fecha FROM material");
        $statement->execute();
        $resultados = $statement->get_result();
    
        $respuesta = [];
    
        while($fila = $resultados->fetch_assoc()){
            array_push($respuesta, $fila);
        }
    }
}
echo json_encode($respuesta);
?>