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
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0&appId=2434910113406080&autoLogAppEvents=1"></script>
    <header>
        <div class="menu">
            <div class="logo">
                <a href="index.php"><h2 class="page-name"><i class="fas fa-graduation-cap"></i> PulidClass</h2></a>
            </div>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="asesores.php">Asesores</a>
                <a href="conocenos.php">Conocenos</a>
                <?php if(isset($_SESSION['usuario'])): ?>
                    <a href="perfil.php">Perfil</a>
                    <a href="logout.php">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="register.php">Registrate</a>
                    <a href="login.php">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>
        <div class="banner">
            <div class="titulo">
                <h1>PulidClass</h1>
                <h2>La enseñanza ante todo</h2>
            </div>
        </div>
    </header>
    <main>
        <div class="descripcion">
            <div class="contenido">
                <h2>Descripcion</h2>
                <p>Esta empresa nace con la intencion de mejorar el nivel de educacion en la region lagunera, por parte de un conjunto de estudiantes de el Tecnologico Superior De Lerdo que con sus habilidades en diferentes hambitos y materias, se propornen a ayudar a jovenes de grados menores con problemas escolares mediante asesorias precenciales a domicilio.</p>
            </div>
        </div>
        <!--
        <div class="testimonios">
            <div class="titulo">
                <h3>Testimonios</h3>
            </div>
            <div class="testimonio">
                <div class="foto">
                    <img src="img/face1.jpg" alt="">
                </div>
                <div class="opinion">
                    <p class="texto">"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat, eum?"</p>
                    <p class="nombre">- Alejandra Gomez</p>
                </div>
            </div>

            <div class="testimonio derecha">
                <div class="foto">
                    <img src="img/face2.jpg" alt="">
                </div>
                <div class="opinion">
                    <p class="texto">"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat, eum?"</p>
                    <p class="nombre">- Pedro Perez</p>
                </div>
            </div>
            <div class="testimonio">
                <div class="foto">
                    <img src="img/face4.jpg" alt="">
                </div>
                <div class="opinion">
                    <p class="texto">"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat, eum?"</p>
                    <p class="nombre">- Andrea Martínez</p>
                </div>
            </div>
        </div>
        -->
        <div class="facebook">
        <div class="fb-page" data-href="https://www.facebook.com/pg/PulidClass/reviews/?ref=page_internal" data-tabs="timeline" data-width="400" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/pg/PulidClass/reviews/?ref=page_internal" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/pg/PulidClass/reviews/?ref=page_internal">PulidClass</a></blockquote></div>
        </div>
        <div class="noticias">
            <div class="titulo">
                <h3>Últimas Noticias</h3>
            </div>
            <div class="noticia">
                <div class="foto">
                    <img src="img/new1.jpg" alt="">
                </div>
                <div class="info">
                    <h3 class="titulo-new">El esqueleto Humano</h3>
                    <h4 class="subtitulo">El sistema oseo visto de cerca</h4>
                    <p class="descripcion-new">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, sit recusandae. Sapiente non culpa consectetur error quibusdam reiciendis voluptas mollitia aliquam magnam tempora fugiat ullam iure, cum debitis, excepturi magni. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum natus necessitatibus ratione neque debitis, expedita eum tempora asperiores.</p>
                </div>
            </div>
            <div class="noticia">
                <div class="foto">
                    <img src="img/new2.jpg" alt="">
                </div>
                <div class="info">
                    <h3 class="titulo-new">Bacterias importantes</h3>
                    <h4 class="subtitulo">Bacterias que debes conocer</h4>
                    <p class="descripcion-new">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, sit recusandae. Sapiente non culpa consectetur error quibusdam reiciendis voluptas mollitia aliquam magnam tempora fugiat ullam iure, cum debitis, excepturi magni. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum natus necessitatibus ratione neque debitis, expedita eum tempora asperiores.</p>
                </div>
            </div>
            <div class="noticia">
                <div class="foto">
                    <img src="img/new3.jpg" alt="">
                </div>
                <div class="info">
                    <h3 class="titulo-new">Lanzamiento SpaceX</h3>
                    <h4 class="subtitulo">Conoce sobre este acontecimiento</h4>
                    <p class="descripcion-new">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, sit recusandae. Sapiente non culpa consectetur error quibusdam reiciendis voluptas mollitia aliquam magnam tempora fugiat ullam iure, cum debitis, excepturi magni. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum natus necessitatibus ratione neque debitis, expedita eum tempora asperiores.</p>
                </div>
            </div>
        </div>
        <div class="social">
            <div class="titulo">
                <h3>Nuestras redes sociales</h3>
            </div>
            <div class="redes">
                <a class="facebook" target="_black" href="https://www.facebook.com/PulidClass/"><i class="fab fa-facebook-f"></i></a>
                <a class="twitter" target="_black" href="#"><i class="fab fa-twitter"></i></a>
                <a class="instagram" target="_black" href="#"><i class="fab fa-instagram"></i></a>
                <a class="youtube" target="_black" href="https://www.youtube.com/channel/UCvoY-muv7vwv-uWe45rVX2g"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </main>
    <footer>
        <div class="info">
            <a href="sugerencias.php">Quejas y Sugerencias</a>
            <a href="#" class="separador"> | </a>
            <a href="#">Oferta laboral</a>
            <a href="#" class="separador"> | </a>
            <a href="politicas.php">Política de privacidad</a>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/logout.js"></script>
</body>
</html>