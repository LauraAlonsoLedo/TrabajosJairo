<h3>
    <a href="<?php echo $_SESSION['home'] ?>" title="Inicio">Inicio</a> <span>| </span>
    <a href="<?php echo $_SESSION['home'] ?>vecinos" title="Vecinos">Vecinos</a> <span>| </span>
    <span><?php echo $datos->nombre ?></span>
</h3>
<div class="row">
    <article class="col s12">
        <div class="card horizontal large vecino">
            <div class="card-image">
                <img src="<?php echo $_SESSION['public']."img/".$datos->imagen ?>" alt="<?php echo $datos->nombre ?>">
            </div>
            <div class="card-stacked">
                <div class="card-content" style="font-size: 25px; text-align: center">
                    <h2><strong><?php echo $datos->nombre ?></strong></h2>
                    <p><strong>Especie</strong>: <?php echo $datos->especie ?></p>
                    <p><strong>Personalidad</strong>: <?php echo $datos->personalidad ?></p>
                    <p><strong>Muletilla</strong>: <?php echo $datos->muletilla ?></p>
                    <p><strong>Hobby</strong>: <?php echo $datos->hobby ?></p>
                </div>
            </div>
        </div>
    </article>
</div>