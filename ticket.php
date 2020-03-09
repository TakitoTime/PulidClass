<?php session_start();
    require('conexion.php');

    $folio=$_GET['Folio'];
    $statement = $conexion->prepare('SELECT * FROM Cita WHERE Folio = :folio');
    $statement->execute(array(':folio' => $folio));
        
    $cita=$statement->fetch();


    $fecha=$cita['Fecha'];

    $hora_inicial=$cita['Hora_Inicial'];
    $hora_final=$cita['Hora_Final'];
    $nhoras=$cita['N_De_Horas'];
    $costo=$cita['Costo'];
    $folio=$cita['Folio'];
    $direccion=$cita['Direccion'];

    $id_asesor=$cita['Id_Asesor'];

    $statement = $conexion->prepare('SELECT * FROM Asesor WHERE Id_Asesor = :id_asesor');
    $statement->execute(array(':id_asesor' => $id_asesor));
    $asesor=$statement->fetch();
        
    $nombre_asesor=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];

    $statement = $conexion->prepare('SELECT * FROM Usuario WHERE N_De_Usuario = :n_de_usuario');
    $statement->execute(array(':n_de_usuario' => $_SESSION['n_de_usuario']));
    $usuario=$statement->fetch();
        
    $nombre_usuario=$usuario['Nombres']." ".$usuario['A_Paterno']." ".$usuario['A_Materno'];

    require('views/ticket.view.php');
?>