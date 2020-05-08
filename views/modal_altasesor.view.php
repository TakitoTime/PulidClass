<div id="ex1" class="modal emergente">
            <?php                
                if(isset($_SESSION['admin'])){

            ?>
                <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <h2 class="titulo">Alta Asesor</h2>
                    <?php if(!empty($errores)): ?>
                        <div class="error">
                            <ul>
                                <?php echo $errores; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="asesor">
                        <div class="principal">
                            <div class="correo_administrador">
                                <p>Correo Del Administrador:</p>    
                                <input type="text" name="correo_admin" value="<?php echo $correo?>" disabled>
                            </div>
                            <div class="password">
                                <p>Contraseña Temporal:</p>    
                                <input type="password" name="password" value="">
                            </div>
                            <div class="usuario">
                                <p>Nombre De Usuario:</p>    
                                <input type="text" name="usuario" value="">
                            </div>
                            <div class="nombre">
                                <p>Nombres:</p>    
                                <input type="text" name="nombre_asesor" value="">
                            </div>
                            <div class="paterno">
                                <p>Apellido Paterno:</p>    
                                <input type="text" name="paterno_asesor" value="">
                            </div>
                            <div class="materno">
                                <p>Apellido Materno:</p>    
                                <input type="text" name="materno_asesor" value="">
                            </div>
                            <div class="foto">
                                <p>Fotografia:</p>    
                                <input type="file" name="fotoasesor" value="">
                            </div>
                            <div class="telefono_edad">
                                <div class="telefono">
                                    <p>Telefono:</p> 
                                    <input type="text" name="telefono_asesor" value="">
                                </div>
                                <div class="edad">
                                    <p>Edad:</p> 
                                    <input type="text" name="edad_asesor" value="">
                                </div>
                            </div>
                        </div>
                        <div class="secundario">
                            <div class="correo_usuario">
                                <p>Correo Del Usuario:</p>    
                                <input type="text" name="correo_asesor" value="">
                            </div>
                            <div class="grado">
                                <p>Grado De Estudios:</p> 
                                <input type="text" name="grado" value="">
                            </div>
                            <div class="ocupacion">
                                <p>Ocupacion:</p> 
                                <input type="text" name="ocupacion" value="">
                            </div>
                            <div class="materia1">
                                <p>Materia 1:</p> 
                                <input type="text" name="materia1" value="">
                            </div>
                            <div class="materia2">
                                <p>Materia 2:</p> 
                                <input type="text" name="materia2" value="">
                            </div>
                            <div class="materia3">
                                <p>Materia 3:</p> 
                                <input type="text" name="materia3" value="">
                            </div>
                            <div class="descripcion">
                                <p>Breve Descripcion:</p> 
                                <textarea name="descripcion">Breve Descripcion De El Asesor</textarea>
                            </div>
                            <div class="guardarasesor">
                                <input type="submit" name="alta_asesor" value="Guardar">
                            </div>
                        </div>

                    </div>
                </form>
        <?php
        }     
        ?>
</div>