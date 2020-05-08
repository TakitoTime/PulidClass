<div id="noticia-delete-modal" class="modal emergente">
    <div class="noticia_delete">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <h2>De verdad quiere eliminar la noticia?</h2>
        <input type="hidden" name="delete_noticia" value="1">
        <button type="submit" name="eliminar_noticia">Eliminar</button>
    </form>
    </div>
</div>

