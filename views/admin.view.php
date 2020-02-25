<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil/estilos.css">
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
        <div class="perfil">
            <div class="foto">
                <div id="foto_usuario"><img src="<?php echo $info_personal['Foto']?>" alt=""></div>
                <a href="modifica.php">Modificar Cuenta</a>
                <a href="elimina.php">Eliminar Cuenta</a>
            </div>
            <div class="info">
                <h3 class="titulo">Administrador</h1>
                <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="file" name="foto" id="foto" disabled value="<?php echo $info_personal['Foto']?>">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" disabled value="<?php echo $info_personal['Nombres']?>">
                    <input type="text" name="edad" id="edad" placeholder="edad" disabled value="<?php echo $info_personal['Edad']?>">
                    <input type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" disabled value="<?php echo $info_personal['A_Paterno']?>">
                    <input type="text" name="materno" id="materno" placeholder="Apellido Materno" disabled value="<?php echo $info_personal['A_Materno']?>">
                    <input type="text" name="correo" id="correo" placeholder="Correo Electronico" disabled value="<?php echo $info_personal['Correo']?>">
                    <input type="text" name="telefono" id="telefono" placeholder="Numero Telefonico" disabled value="<?php echo $info_personal['Telefono']?>">
                    <div class="perfil-footer">
                        <input type="submit" class="button" name="guardar_usuario" id="guardar_usuario" value="Guardar" onclick="Habilitar_Correo()">
                        <input type="button" class="button" id="modificar_usuario" value="Modificar Datos" onclick="Modificar_Datos_Usuario()">
                    </div>
                </form>
            </div>
        </div>
        <div class="profesores">
            <h2>Profesores</h2>
            <table border="2">
                <tr id="header">
                    <th>Id</th>
                    <th>Estudios</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                </tr>
                <?php $resultado = $conexion->query('SELECT * FROM asesor'); ?>
                <?php foreach($resultado as $asesor): ?>
                    <tr>
                        <td><?php echo $asesor[0]?></td>
                        <td><?php echo $asesor[3]?></td>
                        <td><?php echo $asesor[4]?></td>
                        <td><?php echo $asesor[5]?></td>
                        <td><?php echo $asesor[6]?></td>
                        <td><?php echo $asesor[12]?></td>
                        <td><?php echo $asesor[13]?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="bitacora">
            <h2>Bitacora de movimientos</h2>
            <table border="2">
                <tr id="header">
                    <th>Id</th>
                    <th>Correo</th>
                    <th>Accion realizada</th>
                    <th>Tabla afectada</th>
                    <th>fecha</th>
                </tr>
                <?php $movimientos = $conexion->query('SELECT * FROM bitacora'); ?>
                <?php foreach($movimientos as $dato): ?>
                    <tr>
                        <td><?php echo $dato[0]?></td>
                        <td><?php echo $dato[1]?></td>
                        <td><?php echo $dato[2]?></td>
                        <td><?php echo $dato[3]?></td>
                        <td><?php echo $dato[4]?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
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
    <script type="text/javascript" src="js/ingresa_datos.js"></script>
    <script type="text/javascript" src="js/direccion.js"></script>
</body>