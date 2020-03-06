<?php
    require('conexion.php');

    $statement = $conexion->prepare('UPDATE Cuenta set Activacion=:activacion,Codigo_Activacion=:codigo_activacion where correo=:correo');
    $statement->execute(array(
        ':activacion' => 1,
        ':codigo_activacion' => $_GET['codigo_activacion'],
        ':correo' => $_GET['correo']
    ));

    echo "<div class='alert alert-danger mt-4' role='alert'>Su correo ah sido validado correctamente, por favor, inicie sesion para continuar</div>";
    header("Refresh:10; url=login.php");
?>