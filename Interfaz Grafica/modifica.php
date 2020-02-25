<?php
    $correo = $_POST["correo"];
    $contra = $_POST["contra"];

    $correonew = $_POST["correonew"];
    $contranew = $_POST["contranew"];

    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "pulidclass";

    $conexion = mysqli_connect($servidor, $usuario, $contrasena) or die ("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die ("Upps! No se ha podido conectar con la base de datos.");

    $consulta = "call pulidclass.spModificarCuenta('".$correo."','".$contra."','".$correonew."','".$contranew."')";
    $resultado = mysqli_query($conexion, $consulta) or die ("Algo ha salido mal al llamar el procedure");

    if(mysqli_affected_rows($conexion)>=1){
        header('Location: ./index.html');
    }else{
        header('Location: ./asesores.html');
    }
?>
