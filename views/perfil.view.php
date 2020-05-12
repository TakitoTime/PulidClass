<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
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
                <a href="modifica.php">Modificar Cuenta</a>
                <a href="elimina.php">Eliminar Cuenta</a>
            </div>
            <div class="info">
                <h3 class="titulo">Perfil</h3>
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
        <h2>Direcciones</h2>
        <div class="direccion">
            <div class="direcciones">
            <?php
                $cont=0;
                    foreach($direcciones as $direccion){
                    $id_direccion=$direccion['Id_Direccion'];
                    $cont=$cont+1;

                    $statement = $conexion->prepare('SELECT * FROM direccion WHERE id_direccion = :id_direccion LIMIT 1');
                    $statement->execute(array(':id_direccion' => $id_direccion));

                    $direccion_datos=$statement->fetchAll();
                    
                    foreach($direccion_datos as $dato){
                ?>
                    <h3 class="titulo" id="titulo<?php echo $cont?>">Dirección <?php echo $cont?></h3>
                    <div class="datos">
                        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="hidden" name="id_direccion" class="id" id="id<?php echo $cont?>" disabled value=<?php echo $dato['Id_Direccion']?>>
                                <input type="text" name="pais" class="pais" id="pais<?php echo $cont?>" placeholder="Pais" disabled value=<?php echo $dato['Pais']?>>
                                <input type="text" name="estado" class="estado" id="estado<?php echo $cont?>" placeholder="Estado" disabled value="<?php echo $dato['Estado']?>">
                                <input type="text" name="ciudad" class="ciudad" id="ciudad<?php echo $cont?>" placeholder="Ciudad" disabled value="<?php echo $dato['Ciudad']?>">
                                <input type="text" name="colonia" class="colonia" id="colonia<?php echo $cont?>" placeholder="Colonia" disabled value="<?php echo $dato['Colonia']?>">
                                <input type="text" name="calle" class="calle" id="calle<?php echo $cont?>" placeholder="Calle" disabled value="<?php echo $dato['Calle']?>">
                                <input type="text" name="numero" class="numero" id="numero<?php echo $cont?>" placeholder="Numero" disabled value="<?php echo $dato['Numero']?>">
                                <input type="text" name="codigo_postal" class="codigo_postal" id="codigo_postal<?php echo $cont?>" placeholder="Codigo Postal" disabled value="<?php echo $dato['Codigo_Postal']?>">
                                <input type="text" name="descripcion" class="descripcion" id="descripcion<?php echo $cont?>" placeholder="Descripcion" disabled value="<?php echo $dato['Descripcion']?>">

                                <input type="submit" name="guardar" disabled value="Guardar Cambios" onclick="Habilitar_ID(<?php echo $cont?>)" id="guardar<?php echo $cont?>">
                                <input type="submit" name="eliminar"  disabled value="Eliminar Direccion" onclick="Habilitar_ID(<?php echo $cont?>)" id="eliminar_d<?php echo $cont?>">
                                <input type="button" value="Modificar Datos"  onclick="Modificar_Datos_Direccion(<?php echo $cont?>)">
                        </form>
                    </div>
                <?php
                    }
                    $cont_eliminar=$cont;
                }
                $cont_agregar=$cont+1;
                while($cont!=3){
                    $cont=$cont+1;
                ?>
                    <h3 class="titulo" id="titulo<?php echo $cont?>">Dirección <?php echo $cont?></h3>
                    <div class="datos">
                        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="text" name="pais" class="pais" id="pais<?php echo $cont?>" placeholder="Pais" disabled>
                            <input type="text" name="estado" class="estado" id="estado<?php echo $cont?>" placeholder="Estado" disabled>
                            <input type="text" name="ciudad" class="ciudad" id="ciudad<?php echo $cont?>" placeholder="Ciudad" disabled>
                            <input type="text" name="colonia" class="colonia" id="colonia<?php echo $cont?>" placeholder="Colonia" disabled>
                            <input type="text" name="calle" class="calle" id="calle<?php echo $cont?>" placeholder="Calle" disabled>
                            <input type="text" name="numero" class="numero" id="numero<?php echo $cont?>" placeholder="Numero" disabled>
                            <input type="text" name="codigo_postal" class="codigo_postal" id="codigo_postal<?php echo $cont?>" placeholder="Codigo Postal" disabled>
                            <input type="text" name="descripcion" class="descripcion" id="descripcion<?php echo $cont?>" placeholder="Descripcion" disabled>

                            <input type="submit" name="guardar_d" value="Guardar Datos" disabled onclick="Habilitar_ID(<?php echo $cont?>)" id="guardar<?php echo $cont?>">
                            </form>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="botones">
            <?php if($cont_agregar==4): ?>
                <input type="button" value="Agregar Direccion" onclick="Agregar_Direccion(<?php echo $cont_agregar?>)" disabled style="background:#23374d;">
            <?php else: ?>
                <input type="button" value="Agregar Direccion" onclick="Agregar_Direccion(<?php echo $cont_agregar?>)">
            <?php endif; ?>
                <input type="button" value="Eliminar Direccion" onclick="Habilitar_Boton()">
            </div>
        </div>
        <h2>Tarjetas</h2>
        <div class="cont_tarjetas">
            <?php 
                $contagregar_t=1;
                foreach($tarjetas as $tarjeta){
                    $contagregar_t=$contagregar_t+1;
                }
            ?>
            <div class="botones">
                <?php if($contagregar_t==3): ?>
                    <input type="button" value="Agregar Tarjeta" onclick="Agregar_Tarjeta(<?php echo $contagregar_t?>)" disabled style="background:#23374d;">
                <?php else: ?>
                    <input type="button" value="Agregar Tarjeta" onclick="Agregar_Tarjeta(<?php echo $contagregar_t?>)">
                <?php endif; ?>
                    <input type="button" value="Eliminar Tarjeta" onclick="Habilitar_Boton_Tarjeta()">
            </div>
            <div class="tarjetas">
                <div class="etiquetas">
                    <ul>
                        <li><a href="#tabs-1">Tarjeta1</a></li>
                        <li><a href="#tabs-2">Tarjeta2</a></li>
                    </ul>
                </div>
                <?php
                $cont_t=0;
                    foreach($tarjetas as $tarjeta){
                    $cont_t=$cont_t+1;
                ?>
                <div class="tarjeta<?php echo $cont_t?>" id="tabs-<?php echo $cont_t?>">
                    <h3 class="titulo" id="titulo">Tarjeta <?php echo $cont_t?></h3>
                    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="datos">
                            <div class="principal">
                                <input type="hidden" name="id_tarjeta" id="id_tarjeta<?php echo $cont_t?>" value="<?php echo $tarjeta['Id_Tarjeta']?>">
                                <p>Nombre Del Titular:</p>
                                <input type="text" name="titular" id="nombre<?php echo $cont_t?>" placeholder="Como aparece en la tarjeta" disabled value="<?php echo $tarjeta['Nombre_T']?>">
                                <p>Fecha De Expiracion:</p>
                                <div class="fecha">
                                    <input type="text" name="expiracion_mes" id="mes<?php echo $cont_t?>" placeholder="Mes" disabled value="<?php echo $tarjeta['Mes']?>">
                                    <input type="text" name="expiracion_year" id="año<?php echo $cont_t?>" placeholder="Año" disabled value="<?php echo $tarjeta['Year']?>">
                                </div>
                            </div>
                            <div class="secundario">
                                <p>Numero De Tarjeta:</p>
                                <input type="text" name="tarjeta" id="numero_t<?php echo $cont_t?>" disabled value="<?php echo $tarjeta['Num_T']?>">
                                <p>Codigo De Seguridad:</p>
                                <div class="codigo">
                                    <input type="password" name="codigo" id="codigo<?php echo $cont_t?>" placeholder="3 digitos" disabled value="<?php echo $tarjeta['Codigo_S']?>">
                                    <a href="#"><img src="img/logo_tarjetas.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="submit">
                            <input type="hidden" name="guardar_t" value="Guardar Datos" disabled id="guardar_t<?php echo $cont_t?>">
                            <input type="submit" name="eliminar_t" value="Eliminar" disabled id="eliminar_t<?php echo $cont_t?>">
                        </div>
                    </form>
                </div>
                <?php }
                    while($cont_t!=2){
                        $cont_t=$cont_t+1;
                ?>
                <div class="tarjeta<?php echo $cont_t?>" id="tabs-<?php echo $cont_t?>">
                    <h3 class="titulo" id="titulo">Tarjeta <?php echo $cont_t?></h3>
                    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="datos">
                            <div class="principal">
                                <p>Nombre Del Titular:</p>
                                <input type="text" name="titular" id="nombre<?php echo $cont_t?>" placeholder="Como aparece en la tarjeta" disabled value="">
                                <p>Fecha De Expiracion:</p>
                                <div class="fecha">
                                    <input type="text" name="expiracion_mes" id="mes<?php echo $cont_t?>" placeholder="Mes" disabled value="">
                                    <input type="text" name="expiracion_year" id="año<?php echo $cont_t?>" placeholder="Año" disabled value="">
                                </div>
                            </div>
                            <div class="secundario">
                                <p>Numero De Tarjeta:</p>
                                <input type="text" name="tarjeta" id="numero_t<?php echo $cont_t?>" disabled value="">
                                <p>Codigo De Seguridad:</p>
                                <div class="codigo">
                                    <input type="password" name="codigo" id="codigo<?php echo $cont_t?>" placeholder="3 digitos" disabled value="">
                                    <a href="#"><img src="img/logo_tarjetas.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="submit">
                            <input type="submit" name="guardar_t" value="Guardar Datos" disabled id="guardar_t<?php echo $cont_t?>">
                            <input type="hidden" name="eliminar_t" value="Eliminar" disabled id="eliminar_t<?php echo $cont_t?>">
                        </div>
                    </form>
                </div>
                <?php }?>
            </div>

        </div>

        <div class="citas">
            <h2>Bítacora de citas</h2>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr id="header">
                        <td scope="col">Folio</td>
                        <td scope="col">Asesor</td>
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

                        $id_asesor=$cita['Id_Asesor'];

                        $statement = $conexion->prepare('SELECT * FROM Asesor WHERE Id_Asesor = :id_asesor');
                        $statement->execute(array(':id_asesor' => $id_asesor));

                        $asesor=$statement->fetch();
                            
                        $nombre_asesor=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];

                ?>
                <tbody>
                    <tr>
                        <td scope="row"><?php echo $cita['Folio']?></td>
                        <td><?php echo $nombre_asesor?></td>
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
    <script type="text/javascript" src="js/tarjeta.js"></script>
</body>
</html>