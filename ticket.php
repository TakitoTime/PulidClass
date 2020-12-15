<?php session_start();
    require('conexion.php');

    $folio=$_GET['Folio'];

    $statement = $conexion->prepare("SELECT C.Folio, C.Fecha,C.Hora_Inicial,C.Hora_Final,C.N_De_Horas,C.Costo, Concat(UI.Nombres,' ', UI.A_Paterno,' ', UI.A_Materno) as Nombre_Completo,Concat(A.Nombres,' ', A.A_Paterno,' ', A.A_Materno) as Nombre_Asesor, Concat(D.Calle,' ', D.Numero,', ', D.Codigo_Postal)  as DireccionP1, Concat(D.Colonia,', ', D.Ciudad,', ', D.Estado) as DireccionP2 
    from cita as C inner join usuario_info as UI on C.N_De_Usuario=UI.N_De_Usuario
                   inner join direccion as D on D.Id_Direccion=C.Id_Direccion
                   inner join asesor as A on A.Id_Asesor=C.Id_Asesor
                   where folio=:folio");
    $statement->execute(array(':folio' => $folio));
        
    $cita=$statement->fetch();

    if($cita['Folio']==NULL){
        header('Location: index.php');
    }


    $fecha=$cita['Fecha'];

    $hora_inicial=$cita['Hora_Inicial'];
    $hora_final=$cita['Hora_Final'];
    $nhoras=$cita['N_De_Horas'];
    $costo=$cita['Costo'];
    $folio=$cita['Folio'];
    $direccion1=$cita['DireccionP1'];
    $direccion2=$cita['DireccionP2'];

    $nombre_usuario=$cita['Nombre_Completo'];
    $nombre_asesor=$cita['Nombre_Asesor'];

    require('views/ticket.view.php');
?>