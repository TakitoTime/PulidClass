<div id="noticia-modal" class="modal emergente">
    <div class="noticia">
        <div class="imagen">
            <img src="<?php echo $noticia['Imagen']?>" alt="200">
        </div>
        <div class="contenido">
            <div class="titulo_fecha">
                <div class="titulo">
                    <h1 id="titulo"><?php echo $noticia['Titulo']?></h1>
                </div>
                <div class="fecha">
                    <h2 id="fecha">Publicado el: <?php echo $noticia['Fecha']?></h2>
                </div>
            </div>
            <div class="subtitulo">
                <h2 id="subtitulo"><?php echo $noticia['Subtitulo']?></h2>
            </div>
            <div class="informacion">
                <p id="informacion"><?php echo $noticia['Informacion']?></p>
            </div>
            <div class="referencias">
                <h3 is="titulo_referencias">Referencias</h3>
                <p id="referencias"><?php echo $noticia['Fuentes']?></p>
            </div>   
        </div>
    </div>
</div>

