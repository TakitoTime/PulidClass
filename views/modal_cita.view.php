<div id="ex1" class="modal emergente">
            <?php                
                if(isset($_SESSION['cliente'])){

                    if($direcciones!=null && $tarjetas!=null){
                        if($cita_confirmada!="ticket"){
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
                                    <div class="tarjeta">
                                        <p>Tarjeta:</p>
                                        <select name="tarjeta" id="tarjeta">
                                            <?php $cont=1; foreach ($tarjetas as $tarjeta){?>
                                                <option value="<?php echo $tarjeta['Id_Tarjeta'];?>"><?php echo"Tarjeta $cont";?></option>
                                            <?php $cont=$cont+1; }?>
                                        </select>
                                    </div>
                                    <div class="direccion">
                                        <p>Direccion:</p>
                                        <select name="direccion" id="direccion">
                                            <?php $cont=1; foreach ($direcciones as $direccion){?>
                                                <option value="<?php echo $direccion['Id_Direccion'];?>"><?php echo"Direccion $cont";?></option>
                                            <?php $cont=$cont+1; }?>
                                        </select>
                                    </div>
                                    <div class="fecha">
                                        <p>Fecha:</p>
                                        <input type="date" id="fecha"  name="fecha" min="<?php echo date("Y-m-d");?>" max="2025-12-31" value="<?php echo $fecha;?>">
                                    </div>
                                    <div class="horas">
                                        <p>Hora Inicial:</p>
                                        <input type="time" id="hora_inicial" name="hora_inicial" min="9:00" max="20:00" step="3600" value="<?php echo $hora_inicial;?>">
                                        <p>Hora Final:</p>
                                        <input type="time" id="hora_final" name="hora_final" min="9:00" max="20:00" step="3600" value="<?php echo $hora_final;?>">
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
                            <?php if($cita_confirmada == "confirmar_cita"): ?>
                                <input type="submit" name="<?php echo $cita_confirmada?>" class="boton" id="confirmar" value="<?php echo $confirmar?>">
                            <?php elseif($cita_confirmada == "generar_cita"): ?>
                                <input type="submit" name="<?php echo $cita_confirmada?>" class="boton" id="confirmar" value="<?php echo $confirmar?>" onclick="Confirmar_Cita()">
                            <?php endif; ?>
                        </form>
                        <?php
                        }else{?>
                            <h2 class="titulo">Cita Generada</h2>
                            <div class="mensaje">
                                <p>Por favor descargue su comprobante</p>
                            </div>
                            <a href="ticket.php?Folio=<?php echo $folio?>" class="boton"id="ticket" target="_black"><i class="fas fa-download"></i> Descargar Comprobante</a>
                        <?php
                        }
                    }
            else{
        ?>

            <h2 class="titulo">Perfil Incompleto</h2>
            <div class="mensaje">
                <p>No puede generar cita porque no ha ingresado alguna direccion o alguna tarjeta a su cuenta por favor complete correctamente su perfil para continuar</p>
            </div>
            <a class="boton" href="perfil.php">Continuar</a>

        <?php
                } 
        }
            else{?>

            <h2 class="titulo">Citas No Disponibles</h2>
            <div class="mensaje">
            <p>Usted no puede realizar citas</p>
            </div>
            <a class="boton" href="index.php">Inicio</a>

        <?php   
                }?>
</div>