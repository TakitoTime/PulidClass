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
    <link rel="stylesheet" href="css/admin/estilos.css">
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
        <div class="perfil">
            <div class="foto">
                <div id="foto_usuario"><img src="<?php echo $info_personal['Foto']?>" alt=""></div>
            </div>
            <div class="info">
                <h3 class="titulo">Administrador</h1>
                <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="file" name="foto" id="foto" disabled value="<?php echo $info_personal['Foto']?>">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" disabled value="<?php echo $info_personal['Nombres']?>">
                    <input type="text" name="edad" id="edad" placeholder="edad" disabled value="<?php echo $info_personal['Edad']?>">
                    <input type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" disabled value="<?php echo $info_personal['A_Paterno']?>">
                    <input type="text" name="materno" id="materno" placeholder="Apellido Materno" disabled value="<?php echo $info_personal['A_Materno']?>">
                    <input type="text" name="correo" id="correo" placeholder="Correo Electronico" disabled value="<?php echo $info_personal['usuario_Correo']?>">
                    <input type="text" name="telefono" id="telefono" placeholder="Numero Telefonico" disabled value="<?php echo $info_personal['Telefono']?>">
                    <div class="perfil-footer">
                        <input type="submit" class="button" name="guardar_usuario" id="guardar_usuario" value="Guardar" onclick="Habilitar_Correo()">
                        <input type="button" class="button" id="modificar_usuario" value="Modificar Datos" onclick="Modificar_Datos_Usuario()">
                        <!--<input type="submit" class="button" name="respaldar_db" id="respaldar_db" value="Respaldar Base de Datos">-->
                    </div>
                </form>
            </div>
        </div>
        <div class="profesores">
            <h2>Profesores</h2>

            <a href="#ex1" class="add-profesor" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal?>">Agregar Asesor</a>
            <!-- <a href="#" class="remove-profesor">Eliminar Asesor</a> -->
            <div class="error_box" id="error_box_asesores">
				<!--<p>Se ha producido un error.</p>-->
			</div>
            <table border="2" id="tablaAsesores">
                <tr id="header">
                    <th>Id</th>
                    <th>Estudios</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                </tr>
                
            </table>
            <div class="loader" id="loader_asesores"></div>
            <div class="pages">
                <button id="btn_previous_asesores"><i class="fas fa-chevron-left"></i></button>
                <button id="btn_next_asesores"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <!--<div class="noticias">
            <h2>Noticias</h2>

            <a href="#noticia-modal" class="add-profesor" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal_noticia?>">Agregar Noticia</a>
            <div class="error_box" id="error_box_noticias">
			</div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <table border="2" id="tablaNoticias">
                    <tr id="header">
                        <th>Id</th>
                        <th>Administrador</th>
                        <th>Titulo</th>
                        <th>Subtitulo</th>
                        <th>Fecha</th>
                        <th>Eliminar</th>
                    </tr>
                </table>
            </form>
            <div class="loader" id="loader_noticias"></div>
            <div class="pages">
                <button id="btn_previous_noticias"><i class="fas fa-chevron-left"></i></button>
                <button id="btn_next_noticias"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>-->

        <!---<div class="materialdidactico">
            <h2>Material Didactico</h2>

            <a href="#material-modal" class="add-material" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal_material?>">Agregar Material Didactico</a>
            <div class="error_box" id="error_box_material">
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <table border="2" id="tablaMaterial">
                    <tr id="header">
                        <th>Id</th>
                        <th>Administrador</th>
                        <th>Titulo</th>
                        <th>Materia</th>
                        <th>Fecha</th>
                    </tr>
                </table>
            </form>
            <div class="loader" id="loader_material"></div>
            <div class="pages">
                <button id="btn_previous_material"><i class="fas fa-chevron-left"></i></button>
                <button id="btn_next_material"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        -->

        <div class="bitacora">
            <h2>Bitacora de movimientos</h2>
            <div class="error_box" id="error_box_bitacora">
				<!--<p>Se ha producido un error.</p>-->
			</div>
            <table border="2" id="tablaBitacora">
                <tr id="header">
                    <th>Id</th>
                    <th>Correo</th>
                    <th>Accion realizada</th>
                    <th>Tabla afectada</th>
                    <th>fecha</th>
                </tr>
            </table>
            <div class="loader" id="loader_bitacora"></div>
            <div class="pages">
                <button id="btn_previous_bitacora"><i class="fas fa-chevron-left"></i></button>
                <button id="btn_next_bitacora"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="usuarios">
            <h2>Usuarios</h2>
            <a href="#pass-modal" class="add-profesor" rel="modal:open">Cambiar contraseñas</a>
            <div id="pass-modal" class="modal">
                <h3>Cambio de contraseña para usuario</h3>
                <form action="admin.php" method="POST">
                    <label for="n-correo">Correo del usuario:</label>
                    <input type="text" name="n-correo" id="n-correo">
                    <label for="n-pass">Contraseña nueva:</label>
                    <input type="text" name="n-pass" id="n-pass">
                    <input type="submit" value="Cambiar contraseña">
                </form>
            </div>
            <table border="2">
                <tr id="header">
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                </tr>
                <?php 
                $sql = "SELECT Nombres, A_Paterno, A_Materno, usuario_info.usuario_correo, usuario.Contrasena FROM usuario_info INNER JOIN usuario ON usuario.Correo = usuario_info.usuario_Correo WHERE usuario.tipo = 2";
                foreach($conexion->query($sql) as $row){
                ?>
                <tr>
                    <td><?php echo $row['Nombres']; ?></td>
                    <td><?php echo $row['A_Paterno']; ?></td>
                    <td><?php echo $row['A_Materno']; ?></td>
                    <td><?php echo $row['usuario_correo']; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <!--<div class="muerto">
            <h2>Cuentas desactivadas (archivo muerto)</h2>
            <a href="#muerto-modal" class="add-profesor" rel="modal:open">Recuperar cuentas</a>
            <div id="muerto-modal" class="modal">
                <h3>Habilitar cuenta para usuario</h3>
                <form action="admin.php" method="POST">
                    <label for="m-correo">Correo del usuario:</label>
                    <input type="text" name="m-correo" id="m-correo">
                    <input type="submit" value="Recuperar cuenta">
                </form>
            </div>
            <table border="2">
                <tr id="header">
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                </tr>
                <?php 
                $sql = "SELECT Nombres, A_Paterno, A_Materno, usuario.Correo, cuenta.Contrasena FROM usuario INNER JOIN cuenta ON cuenta.Correo = usuario.Correo WHERE cuenta.tipo = 0";
                foreach($conexion->query($sql) as $row){
                ?>
                <tr>
                    <td><?php echo $row['Nombres']; ?></td>
                    <td><?php echo $row['A_Paterno']; ?></td>
                    <td><?php echo $row['A_Materno']; ?></td>
                    <td><?php echo $row['Correo']; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>-->
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
    <script type="text/javascript" src="js/ajax_admin.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/altasesor.js"></script>

    
</body>