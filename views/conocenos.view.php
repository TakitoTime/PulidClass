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
    <main class="information">
        <div class="mision">
            <h2>Misión</h2>
            <p>
                Somos una empresa dedicada a implementar estrategias de educación como cursos en diferentes materias ya sea desde física hasta programación, garantizando un excelente desempeño para brindar un desempeño para brindar un servicio personalizado y efectivo con personal calificado. Impulsando el desarrollo de nuestros asesorados con gran material didáctico.
            </p>
        </div>
        <div class="vision">
            <h2>Visión</h2>
            <p>
                Ser la empresa de asesorías líder a nivel nacional con innovadoras maneras de aprendizaje, para satisfacer las necesidades de nuestros usuarios estando siempre comprometidos en un marco de responsabilidad y excelencia. 
            </p>
        </div>
        <div class="conocenos">
            <h2>Cónocenos</h2>
            <p>
                Pulido Valdez David Guadalupe<br><br>
                Egresado de la preparatoria CTIS 159 lo cual lo acredita como técnico en Programación. Estudia la carrera de Ingeniería en sistemas computacionales en el  Instituto tecnológico superior de lerdo se especializa en el área de Matemáticas y programación, ha participado en los concursos de Futuras tecnologías, CONINCI 2017, CONINCI 2019, su mayor pasatiempo es programar y leer noticias científicas. 
            </p>
            <p>
                Carrillo Alvarado Luis Felipe<br><br>
                Egresado de la preparatoria CBTIS 4 lo cual lo acredita como técnico en Programación. Estudia la carrera de Ingeniería en sistemas computacionales en el  Instituto tecnológico superior de lerdo se especializa en el área de Programación y diseño web, ha participado en los concursos de CONINCI 2017, CONINCI 2019, su mayor pasatiempo es escuchar música y estudiar. 
            </p>
            <p>
                Herrera Ceniceros Manuel Alejandro<br><br>
                Egresado de la preparatoria  CBTIS 4 lo cual lo acredita como técnico en Contabilidad. Estudia la carrera de Ingeniería en sistemas computacionales en el  Instituto tecnológico superior de lerdo se especializa en el área de Base de datos y contabilidad, ha participado en los concursos de CONINCI 2017, su mayor pasatiempo es jugar videojuegos. 
            </p>
            <p>
                Mendoza Reyes Cesar Eduardo<br><br>
                Egresado de la preparatoria CONALEP lo cual lo acredita como técnico en Mecánica automotriz. Estudia la carrera de Ingeniería en sistemas computacionales en el  Instituto tecnológico superior de lerdo se especializa en el área de base de datos y programacion, ha participado en los concursos de CONINCI 2017, su mayor pasatiempo es escuchar música. 
            </p>
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
    <script type="text/javascript" src="js/logout.js"></script>
</body>
</html>
