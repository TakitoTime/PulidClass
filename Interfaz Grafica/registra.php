<?php

    $correo = $_POST["correo"];
    $contra = $_POST["contra"];

    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "pulidclass";

    $conexion = mysqli_connect($servidor, $usuario, $contrasena) or die ("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die ("Upps! No se ha podido conectar con la base de datos.");

    $consulta = "call pulidclass.spAltaCuenta('".$correo."','".$contra."')";
    $resultado = mysqli_query($conexion, $consulta) or die ("Algo ha salido mal al llamar el procedure");

    if(mysqli_affected_rows($conexion)>=1){
        header('Location: ./asesores.html');
    }else{
        header('Location: ./register.html');
    }

?>