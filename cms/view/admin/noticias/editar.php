<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>admin/noticias" title="Noticias">Noticias</a> <span>| </span>
    <?php if ($datos->id){ ?>
        <span>Editar <?php echo $datos->nombre ?></span>
    <?php } else { ?>
        <span>Nuevo vecino</span>
    <?php } ?>
</h3>
<div class="row">
    <?php $id = ($datos->id) ? $datos->id : "nuevo" ?>
    <form class="col s12" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['home'] ?>admin/noticias/editar/<?php echo $id ?>">
        <div class="col m12 l6">
            <div class="row">
                <div class="input-field col s12">
                    <input id="titulo" type="text" name="titulo" value="<?php echo $datos->nombre ?>">
                    <label for="titulo">Nombre</label>
                </div>
                <div class="input-field col s12">
                    <input id="autor" type="text" name="autor" value="<?php echo $datos->especie ?>">
                    <label for="autor">Especie</label>
                </div>
                <div class="input-field col s12">
                    <input id="autor" type="text" name="autor" value="<?php echo $datos->personalidad ?>">
                    <label for="autor">Personalidad</label>
                </div>
                <div class="input-field col s12">
                    <input id="autor" type="text" name="autor" value="<?php echo $datos->hobby ?>">
                    <label for="autor">Hobby</label>
                </div>
                <div class="input-field col s12">
                    <input id="autor" type="text" name="autor" value="<?php echo $datos->muletilla ?>">
                    <label for="autor">Muletilla</label>
                </div>
            </div>
        </div>
        <div class="col m12 l6 center-align">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Imagen</span>
                    <input type="file" name="imagen">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <?php if ($datos->imagen){ ?>
                <img src="<?php echo $_SESSION['public']."img/".$datos->imagen ?>" alt="<?php echo $datos->nombre ?>">
            <?php } ?>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <a href="<?php echo $_SESSION['home'] ?>admin/noticias" title="Volver">
                    <button class="btn waves-effect waves-light" type="button">Volver
                        <i class="material-icons right">replay</i>
                    </button>
                </a>
                <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>
    </form>
</div>
