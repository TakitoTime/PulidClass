<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asesor</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/asesor/estilos.css">
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
    </header>
    <main>
        <div class="asesor">
            <form enctype="multipart/form-data" action="asesor.php" method="POST">
                <div class="datos">
                    <div class="nombre">
                        <p>Nombre:</p>
                        <input type="label" id="nombre" disabled value="<?php echo $nombre_asesor?>">
                    </div>
                    <div class="ocupacion">
                        <p>Ocupación:</p>
                        <input type="label" id="ocupacion" disabled value="<?php echo $asesor['Ocupacion']?>">
                    </div>
                    <div class="estudios">
                        <p>Grado de estudios:</p>
                        <input type="label" id="estudios" disabled value="<?php echo $asesor['Grado_Estudios']?>">
                    </div>
                    <div class="correo">
                        <p>Correo:</p>
                        <input type="label" id="correo" disabled value="<?php echo $asesor['Correo']?>">
                    </div>
                    <div class="descripcion">
                        <p>Descripcion:</p>
                        <label id="descripcion"><?php echo $asesor['Descripcion']?></label>
                    </div>
                    <div class="materias">
                        <p>Materias que ofrece:</p>
                        <input type="label" disabled value="<?php echo $materias[0]['Nombre']?>">
                        <input type="label" disabled value="<?php echo $materias[1]['Nombre']?>">
                        <input type="label" disabled value="<?php echo $materias[2]['Nombre']?>">
                    </div>
                </div>
                <div class="contacto">
                    <div class="foto">
                        <img src="<?php echo $asesor['Foto']?>" alt="">
                    </div>
                    <div class="info">
                        <div class="edad">
                            <p>Edad:</p>
                            <input type="label" id="edad" disabled value="<?php echo $asesor['Edad']?>">
                        </div>
                        <div class="telefono">
                            <p>Teléfono:</p>
                            <input type="label" id="tel" disabled value="<?php echo $asesor['Telefono']?>">
                        </div>
                    </div>
                </div>
                <div class="generar">
                    <a href="#ex1" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal?>"><i class="far fa-check-circle"></i> Generar Cita!</a>
                </div>
            </form>
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

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/cita.js"></script>
    
</body>
</html>