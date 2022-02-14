<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>admin/vecinos" title="Vecinos">Vecinos</a> <span>| </span>
    <?php if ($datos->id){ ?>
        <span>Editar <?php echo $datos->nombre ?></span>
    <?php } else { ?>
        <span>Nuevo vecino</span>
    <?php } ?>
</h3>
<div class="row">
    <?php $id = ($datos->id) ? $datos->id : "nuevo" ?>
    <form class="col s12" method="POST" enctype="multipart/form-data" action="<?php echo $_SESSION['home'] ?>admin/vecinos/editar/<?php echo $id ?>">
        <div class="col m12 l6">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nombre" type="text" name="nombre" value="<?php echo $datos->nombre ?>">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="input-field col s12">
                    <input id="especie" type="text" name="especie" value="<?php echo $datos->especie ?>">
                    <label for="especie">Especie</label>
                </div>
                <div class="input-field col s12">
                    <input id="personalidad" type="text" name="personalidad" value="<?php echo $datos->personalidad ?>">
                    <label for="personalidad">Personalidad</label>
                </div>
                <div class="input-field col s12">
                    <input id="hobby" type="text" name="hobby" value="<?php echo $datos->hobby ?>">
                    <label for="hobby">Hobby</label>
                </div>
                <div class="input-field col s12">
                    <input id="muletilla" type="text" name="muletilla" value="<?php echo $datos->muletilla ?>">
                    <label for="muletilla">Muletilla</label>
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
                <a href="<?php echo $_SESSION['home'] ?>admin/vecinos" title="Volver">
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
