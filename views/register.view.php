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
    <link rel="stylesheet" href="css/login/estilos.css">
</head>
<body>
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
    </header>
    <main>
        <div class="imagen">
            <div class="titulo">
                <h1>PulidClass</h1>
                <h2>La enseñanza ante todo</h2>
            </div>
        </div>
        <div class="aside">
            <div class="texto">
                <h2>Bienvenido a <span class="azul">PulidClass!</span></h2>
                <h3>La educación ayuda a la persona a aprender a ser lo que es capaz de ser</h3>
            </div>
            <div class="formulario">
                <h3>Registrate ahora!</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="text" name="correo" id="correo" placeholder="Correo:">
                    <input type="password" name="contra" id="contra" placeholder="Contraseña:">
                    <input type="password" name="contra2" id="contra" placeholder="Repite la contraseña:">

                    <input name="activacion" id="activacion" type="hidden" value="0">
                    <?php echo "<input name='codigo_activacion' id='code' value='".$codigo_activacion."' type='hidden'  required >"; ?>
                    <?php if(!empty($errores)): ?>
                        <div class="error">
                            <ul>
                                <?php echo $errores; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <input type="submit" value="Registrarse">
                </form>
            </div>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/logout.js"></script>
</body>
</html>