<div id="ex1" class="modal emergente">
            <?php                
                if(isset($_SESSION['cliente'])){

                    if($direcciones!=null){
            ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id_asesor=$id_asesor"; ?>" method="POST">
                    <h2 class="titulo">Agendar Cita</h2>
                    <div class="cita">
                        <input type="hidden" name="N_De_Usuario" value="<?php echo $n_de_usuario?>">
                        <input type="hidden" name="Id_Asesor" value="<?php echo $id_asesor?>">
                            <div class="usuario">
                                <p>Usuario:</p>
                                <input type="text" name="usuario" id="usuario" disabled value="<?php echo $nombre_usuario?>">
                            </div>
                            <div class="asesor">
                                <p>Asesor:</p>
                                <input type="text" name="asesor" id="asesor" disabled value="<?php echo $nombre_asesor?>">
                            </div>
                            <div class="direccion">
                                <p>Direccion:</p>
                                <select name="direccion" id="direccion">
                                    <?php $cont=1; foreach ($direcciones as $direccion){?>
                                        <option value="<?php echo $direccion['Id_direccion'];?>"><?php echo"Direccion $cont";?></option>
                                    <?php $cont=$cont+1; }?>
                                </select>
                            </div>
                            <div class="fecha">
                                <p>Fecha:</p>
                                <input type="date" id="fecha"  name="fecha" min="<?php echo date("Y-m-d");?>" max="2025-12-31" value="<?php echo $fecha;?>">
                            </div>
                            <div class="horas">
                                <p>Hora Inicial:</p>
                                <input type="time" id="hora" name="hora_inicial" min="9:00" max="20:00" step="3600" value="<?php echo $hora_inicial;?>">
                                <p>Hora Final:</p>
                                <input type="time" id="hora" name="hora_final" min="9:00" max="20:00" step="3600" value="<?php echo $hora_final;?>">
                            </div>
                            <?php if($cita_confirmada != "confirmar_cita"): ?>
                                <p># De Horas:</p>
                                <input type="text" id="nhoras" name="nhoras" value="<?php echo $nhoras?>" disabled>
                                <p>Costo:</p>
                                <input type="text" id="costo" name="costo" value="$ <?php echo $costo?>" disabled>

                            <?php endif; ?>
                            <?php if(!empty($errores)): ?>
                                <div class="error">
                                    <ul>
                                        <?php echo $errores; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                    </div>
                    <?php if($cita_confirmada == "ticket"): ?>
                            <a href="ticket.php?Folio=<?php echo $folio?>" id="ticket" target="_black"><i class="fas fa-download"></i> Descargar Comprobante</a>
                    <?php endif; ?>

                    <?php if($cita_confirmada == "confirmar_cita" || $cita_confirmada == "generar_cita"): ?>
                        <input type="submit" name="<?php echo $cita_confirmada?>" id="confirmar" value="<?php echo $confirmar?>">
                    <?php endif; ?>
                </form>
        <?php
        }
            else{
        ?>

            <h2 class="titulo">Direccion</h2>
            <p>No puede generar cita porque no ha ingresado alguna direccion, por favor registe una direccion para continuar</p>
            <a href="perfil.php">Continuar</a>

        <?php
                } 
        }
            else{?>

            <h2 class="titulo">Inicie Sesion</h2>
            <p>No puede generar cita, por favor, inicie sesion para continuar</p>
            <a href="login.php">Iniciar Sesion</a>

        <?php   
                }?>
</div>