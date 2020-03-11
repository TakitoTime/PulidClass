<?php session_start();
    require('conexion.php');

    $statement = $conexion->prepare('SELECT * FROM Asesor');
    $statement->execute();

    $asesores=$statement->fetchAll();

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $postPorPagina = 4;

    $inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0 ;

    $asesores_page = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM asesor LIMIT $inicio, $postPorPagina");

    $asesores_page->execute();
    $asesores_page= $asesores_page->fetchAll();

    $totalAsesores = $conexion->query('SELECT FOUND_ROWS() as total');
    $totalAsesores = $totalAsesores->fetch()['total'];

    $numeroPaginas = ceil($totalAsesores / $postPorPagina);

    require('views/asesores.view.php');
?>