<div id="material-modal" class="modal emergente">
            <?php                
                if(isset($_SESSION['admin']) || isset($_SESSION['asesor'])){

            ?>
                <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <h2 class="titulo">Material Didactico</h2>
                    <?php if(!empty($errores)): ?>
                        <div class="error">
                            <ul>
                                <?php echo $errores; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="material">
                        <div class="principal">
                            <div class="admin_fecha">
                                <div class="correo_administrador">
                                    <p>Correo Del Usuario:</p>    
                                    <input type="text" name="correo_admin" value="<?php echo $correo?>" disabled>
                                </div>
                                <div class="fecha">
                                    <p>Fecha:</p> 
                                    <input type="text" name="fecha" value="<?php echo $fecha ?>" disabled>
                                </div>
                            </div>
                            <div class="titulo">
                                <p>Titulo:</p>    
                                <input type="text" name="titulo" value="">
                            </div>
                            <div class="materia">
                                <p>Materia:</p>    
                                <input type="text" name="materia" value="">
                            </div>
                            <div class="imagen">
                                <p>Archivo:</p>    
                                <input type="file" name="archivo" value="">
                            </div>
                        </div>
                        <div class="secundario">
                            <div class="guardarnoticia">
                                <input type="submit" name="alta_material" value="Guardar">
                            </div>
                        </div>

                    </div>
                </form>
        <?php
        }     
        ?>
</div>