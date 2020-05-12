<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PulidClass</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/asesores/estilos.css">
</head>
<body>
    <header>
        <div class="menu">
            <div class="logo">
                <a href="index.php"><h2 class="page-name"><i class="fas fa-graduation-cap"></i> PulidClass</h2></a>
            </div>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="noticias.php">Noticias</a>
                <a href="asesores.php">Asesores</a>
                <a href="conocenos.php">Conocenos</a>
                <?php if(isset($_SESSION['cliente'])): ?>
                    <a href="perfil.php">Perfil</a>
                    <a href="logout.php">Cerrar Sesión</a>
                <?php elseif(isset($_SESSION['admin'])): ?>
                    <a href="admin.php">Perfil</a>
                    <a href="logout.php">Cerrar Sesión</a>
                <?php elseif(isset($_SESSION['asesor'])): ?>
                    <a href="perfil_asesor.php">Perfil</a>
                    <a href="logout.php">Cerrar Sesión</a>
                <?php else: ?>    
                    <a href="register.php">Registrate</a>
                    <a href="login.php">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>
    <main>
        <div class="asesores">
            <div class="filtrado">
                <h3 class="titulo">Materias</h3>
                <a href="#">Matemáticas</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Física</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Programación</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Inglés</a>
            </div>
            <div class="grid">
                <div class="titulo">
                    <h3>Asesores</h3>
                </div>
                <?php
                    foreach($asesores_page as $asesor){

                    $nombre=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];
                    $ocupacion=$asesor['Ocupacion'];
                    $descripcion=$asesor['Descripcion'];
                    $foto=$asesor['Foto'];

                ?>
                <div class="asesor">
                    <form enctype="multipart/form-data" action="asesor.php" method="GET">
                        <input type="hidden" name="id_asesor" value=<?php echo $asesor['Id_Asesor']?>>
                        <div class="foto">
                            <img src="<?php echo $foto?>" alt="">
                        </div>
                        <p class="nombre"><?php echo $nombre ?></p>
                        <p class="ocupacion"><?php echo $ocupacion ?></p>
                        <p class="descripcion"><?php echo $descripcion ?></p>
                        <input type="submit" value="Detalles">
                    </form>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="paginacion">
                    <ul>
                        <!-- Establecemos cuando el boton de "Anterior" estara desabilitado -->
                        <?php if($pagina == 1): ?>
                            <li class="disabled">&laquo;</li>
                        <?php else: ?>
                            <li><a href="?pagina=<?php echo $pagina - 1 ?>">&laquo;</a></li>
                        <?php endif; ?>

                        <!-- Ejecutamos un ciclo para mostrar las paginas -->
                        <?php 
                            for($i = 1; $i <= $numeroPaginas; $i++){
                                if ($pagina === $i) {
                                    echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
                                } else {
                                    echo "<li><a href='?pagina=$i'>$i</a></li>";
                                }
                            }
                        ?>

                        <!-- Establecemos cuando el boton de "Siguiente" estara desabilitado -->
                        <?php if($pagina == $numeroPaginas): ?>
                            <li class="disabled">&raquo;</li>
                        <?php else: ?>
                            <li><a href="?pagina=<?php echo $pagina + 1 ?>">&raquo;</a></li>
                        <?php endif; ?>
                            
                    </ul>
            </div>
        </div>
        <div class="recursos">
        <h2>Material de apoyo</h2>
            <div class="materiales">
                <?php
                    foreach($materias as $materia){
                ?>
                <h3 class="materia"><?php echo $materia['Materia']?></h3>
                <div class="material">
                    <?php 
                        $statement = $conexion->prepare('SELECT Titulo, Fecha, Documento FROM material WHERE materia=:materia');
                        $statement->execute(array(':materia' => $materia['Materia']));
                    
                        $datos_materia=$statement->fetchAll();

                        foreach($datos_materia as $dato_materia){
                    ?>
                        <div class="contenedor">
                            <div class="principal">
                                <div class="titulo">
                                    <h4><?php echo $dato_materia['Titulo']?></h4>
                                </div>
                                <div class="fecha">
                                    <h4><?php echo $dato_materia['Fecha']?></h4>
                                </div>
                            </div>
                            <div class="secundario">
                                <div class="download">
                                    <a href="<?php echo $dato_materia['Documento']?>" download="<?php echo $dato_materia['Documento']?>">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                </div>
                <?php
                }?>
            </div>
            <div class="movimientos">
                <h3>Movimientos recientes</h3>
                <a href="#">Juan Perez ha añadido un nuevo formulario</a>
                <a href="#">Alejandra Gonzalez ha publicado un nuevo articulo</a>
                <a href="#">Pedro Paredes se ha unido recientemente como asesor</a>
                <a href="">Juana Rocha ha añadido un nuevo recurso</a>
            </div>
        </div>
    </main>
    <footer>
    <div class="info">
            <a href="#">Atención a clientes</a>
            <a href="#" class="separador"> | </a>
            <a href="#">Oferta laboral</a>
            <a href="#" class="separador"> | </a>
            <a href="politicas.php">Política de privacidad</a>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!--JQueryUI-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/material.js"></script>
</body>
</html>