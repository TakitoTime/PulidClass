<?php session_start();
    require('conexion.php');

    $abrir_modal="false";

    $statement = $conexion->prepare('SELECT * FROM Noticia');
    $statement->execute();

    $noticias=$statement->fetchAll();

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $postPorPagina = 4;

    $inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0 ;

    $noticias_page = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM noticia LIMIT $inicio, $postPorPagina");

    $noticias_page->execute();
    $noticias_page= $noticias_page->fetchAll();

    $totalNoticias = $conexion->query('SELECT FOUND_ROWS() as total');
    $totalNoticias = $totalNoticias->fetch()['total'];

    $numeroPaginas = ceil($totalNoticias / $postPorPagina);


    if (isset($_GET['id_noticia'])) {

        $id_noticia=$_GET['id_noticia'];

        $statement = $conexion->prepare('SELECT * FROM Noticia where Id_Noticia=:id_noticia LIMIT 1');
        $statement->execute(array(
            ':id_noticia' => $id_noticia
        ));
    
        $noticia=$statement->fetch();

        if($noticia['Id_Noticia'] == NULL){
            $abrir_modal="false";
        }else{
            $abrir_modal="true";
            require('views/modal_noticia.view.php');
        }
    }

    require('views/noticias.view.php');
?>