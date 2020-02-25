<?php
    $n_de_usuario=$_POST['N_De_Usuario'];
    $id_asesor=$_POST['Id_Asesor'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $nhoras=$_POST['nhoras'];
    $costo=$_POST['costo'];


    $usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "pulidclass";

    $conexion = mysqli_connect($servidor, $usuario, $contrasena) or die ("No se ha podido conectar al servidor de base de datos.");
    $db = mysqli_select_db($conexion, $basededatos) or die ("Upps! No se ha podido conectar con la base de datos.");

    $consulta = "call pulidclass.spAltaCita(".$n_de_usuario.",".$id_asesor.",'".$fecha."','".$hora."','".$nhoras."',".$costo.")";
    $resultado = mysqli_query($conexion, $consulta) or die ("Algo ha salido mal al llamar el procedure");

    $row = mysqli_fetch_array($resultado, MYSQLI_NUM);

    if($row[0]==0){
        echo "<div class='alert alert-danger mt-4' role='alert'>Cita Dada De Alta</div>";
    }
?>