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
    <link rel="stylesheet" href="css/noticias/estilos.css">
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
                    <a href="asesor.php">Perfil</a>
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
                <h3 class="titulo">Secciones</h3>
                <a href="#">Espacio</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Tecnologia</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Salud Y Medicina</a>
                <a href="#" class="separador"> | </a>
                <a href="#">Naturaleza</a>
            </div>
            <div class="grid">
                <div class="titulo">
                    <h3>Noticias</h3>
                </div>
                <?php
                    foreach($noticias_page as $noticia){

                    $id_noticia=$noticia['Id_Noticia'];
                    $titulo=$noticia['Titulo'];
                    $fecha=$noticia['Fecha'];
                    $informacion=$noticia['Informacion'];
                    $informacion=substr($informacion, 0, 300);
                    $informacion.="...";
                    $foto=$noticia['Imagen'];

                ?>
                <div class="asesor">
                    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="GET">
                        <input type="hidden" name="id_noticia" value=<?php echo $noticia['Id_Noticia']?>>
                        <div class="foto">
                            <img src="<?php echo $foto?>" alt="">
                        </div>
                        <p class="nombre"><?php echo $titulo ?></p>
                        <p class="ocupacion"><?php echo $fecha ?></p>
                        <p class="descripcion"><?php echo $informacion ?></p>
                        <input type="submit" value="Ver Mas">
                        
                        <a href="#noticia-modal" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal?>"></a>
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

    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!--JQueryUI-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./js/open_modal_noticia.js"></script>
</body>
</html>