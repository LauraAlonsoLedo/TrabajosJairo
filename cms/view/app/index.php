<h3>Inicio</h3>
<div class="row">
    <?php foreach ($datos as $row){ ?>
        <article class="col m12 l6">
            <div class="card horizontal small">
                <div class="card-image">
                    <img src="<?php echo $_SESSION['public']."img/".$row->imagen ?>" alt="<?php echo $row->nombre ?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content" style="margin-left: 30px;margin-top: 30px">
                        <h2 style="font-size: 40px"><strong><?php echo $row->nombre ?></strong></h2>
                    </div>
                    <div class="card-action">
                        <a href="<?php echo $_SESSION['home']."noticia/".$row->id ?>">Más información</a>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
