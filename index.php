<?php  session_start();
require('conexion.php');

    $statement = $conexion->prepare('SELECT * FROM noticia ORDER BY Id_Noticia DESC limit 3');
    $statement->execute();

    $noticias=$statement->fetchAll();

    if (isset($_GET['id_noticia'])) {
        $abrir_modal="true";

        $id_noticia=$_GET['id_noticia'];

        $statement = $conexion->prepare('SELECT * FROM Noticia where Id_Noticia=:id_noticia LIMIT 1');
        $statement->execute(array(
            ':id_noticia' => $id_noticia
        ));
    
        $noticia=$statement->fetch();

        require('views/modal_noticia.view.php');
    }

require('views/index.view.php');
?>