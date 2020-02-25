<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

require('conexion.php');

	$statement = $conexion->prepare("SELECT Fecha, Hora_Inicial, Hora_Final FROM cita");
	$statement->execute();
	$resultados = $statement->get_result();
	
	$respuesta = [];
	
	while($fila = $resultados->fetch_assoc()){
		$cita = [
			'fecha' 		=> $fila['ID'],
			'hora_inicial' 	=> $fila['nombre'],
			'hora_final'		=> $fila['edad'],
			'pais'		=> $fila['pais'],
			'correo'	=> $fila['correo']
		];
		array_push($respuesta, $usuario);
	}
}

echo json_encode($respuesta);