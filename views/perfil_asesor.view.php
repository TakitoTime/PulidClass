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
                <h1 class="titulo">Profesor</h1>
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

        <div class="ficha_tecnica">
            <div class="titulo_ficha">
                <h2 class="titulo">Ficha Tecnica</h2>
                <a href=""><h2 class="page-name"><i class="fas fa-graduation-cap"></i> PulidClass</h2></a>
            </div>
            <div class="contenedor">
                <div class="asesor_info">
                    <div class="principal">
                        <div class="info">
                            <h3>Nombre De Usuario: <?php echo $ficha_tecnica['Nombre_Usuario']?></h3>
                        </div>
                        <div class="info">
                            <h3>Grado: <?php echo $ficha_tecnica['Grado_Estudios']?></h3>
                        </div>
                        <div class="info">
                            <h3>Ocupacion: <?php echo $ficha_tecnica['Ocupacion']?></h3>
                        </div>
                    </div>
                    <div class="secundario">
                        <div class="info">
                            <h3>Materia1: <?php echo $ficha_tecnica['Materia1']?></h3>
                        </div>
                        <div class="info">
                            <h3>Materia2: <?php echo $ficha_tecnica['Materia2']?></h3>
                        </div>
                        <div class="info">
                            <h3>Materia3: <?php echo $ficha_tecnica['Materia3']?></h3>
                        </div>
                    </div>
                </div>
                <div class="descripcion">
                    <h3>Descripcion: <?php echo $ficha_tecnica['Descripcion']?></h3>
                </div>
            </div>
        </div>

        <div class="citas">
            <h2>Bítacora de citas</h2>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr id="header">
                        <td scope="col">Folio</td>
                        <td scope="col">Cliente</td>
                        <td scope="col">Direccion</td>
                        <td scope="col">Fecha</td>
                        <td scope="col">Hora Inicio</td>
                        <td scope="col">Hora Final</td>
                        <td scope="col">Numero De Horas</td>
                        <td scope="col">Costo</td>
                        <td scope="col">Comprobante</td>
                    </tr>
                </thead>
                <?php
                    foreach($citas as $cita){

                        $id_usuario=$cita['N_De_Usuario'];

                        $statement = $conexion->prepare('SELECT * FROM Usuario WHERE N_De_Usuario = :n_de_usuario');
                        $statement->execute(array(':n_de_usuario' => $id_usuario));

                        $cliente=$statement->fetch();
                            
                        $nombre_cliente=$cliente['Nombres']." ".$cliente['A_Paterno']." ".$cliente['A_Materno'];

                ?>
                <tbody>
                    <tr>
                        <td scope="row"><?php echo $cita['Folio']?></td>
                        <td><?php echo $nombre_cliente?></td>
                        <td><?php echo $cita['DireccionP1']; echo $cita['DireccionP2']?></td>
                        <td><?php echo $cita['Fecha']?></td>
                        <td><?php echo $cita['Hora_Inicial']?></td>
                        <td><?php echo $cita['Hora_Final']?></td>
                        <td><?php echo $cita['N_De_Horas']?></td>
                        <td><?php echo "$".$cita['Costo']?></td>
                        <td><a href="ticket.php?Folio=<?php echo $cita['Folio']?>" id="ticket" target="_black"><i class="fas fa-download"></i> Descargar Comprobante</a></td>
                    </tr>
                </tbody> 
                <?php
                }
                ?>
            </table>
        </div>

        <div class="noticias">
            <h2>Noticias</h2>

            <a href="#noticia-modal" class="add-profesor" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal_noticia?>">Agregar Noticia</a>
            <!-- <a href="#" class="remove-profesor">Eliminar Asesor</a> -->
            <div class="error_box" id="error_box_noticias">
				<!--<p>Se ha producido un error.</p>-->
			</div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <table border="2" id="tablaNoticias">
                    <tr id="header">
                        <th>Id</th>
                        <th>Administrador</th>
                        <th>Titulo</th>
                        <th>Materia</th>
                        <th>Fecha</th>
                    </tr>
                </table>
            </form>
            <div class="loader" id="loader_noticias"></div>
            <div class="pages">
                <button id="btn_previous_noticias"><i class="fas fa-chevron-left"></i></button>
                <button id="btn_next_noticias"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="materialdidactico">
            <h2>Material Didactico</h2>

            <a href="#material-modal" class="add-material" rel="modal:open" id="modalactive" data-value="<?php echo $abrir_modal_material?>">Agregar Material Didactico</a>
            <!-- <a href="#" class="remove-profesor">Eliminar Asesor</a> -->
            <div class="error_box" id="error_box_material">
				<!--<p>Se ha producido un error.</p>-->
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
    <script type="text/javascript" src="js/ajax_asesor.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://kit.fontawesome.com/03ad672f06.js" crossorigin="anonymous"></script>

    
</body>