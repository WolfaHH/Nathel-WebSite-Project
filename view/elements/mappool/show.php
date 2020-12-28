<?php for ($d = 0; $d <=1; $d++) : ?>

    <div class="container">
        <h2> <?php echo  $d === 0 ? $displayname1 : $displayname2 ?></h2>
        <?php for ($i = 0; $i <= $max; $i++) :
            if ($d == 1){ $i+=($max+1);}
            ?>
            <div class="mostpopular <?php $i ?>">
                <span><?php echo $display_pools[$i]['name'] ?></span>
                <span>from <?php echo $display_pools[$i]['from'] ?></span>
                <span>submitted by <?php echo $display_pools[$i]['submitter'] ?></span>
                <span> <?php echo $display_pools[$i]['nb_map'] ?> maps</span>
                <span>
            <?php foreach ($display_pools[$i]['categories'] as $category => $value ):?>
                <span class="color-<?= $category ?>"><?= $value ?></span>
            <?php endforeach; ?>
        </span>
                <form class="form-button">
                    <button class="btn" type="submit">
                        fleche && svg
                        Follow
                    </button>
                </form>
                <form class="fleche">
                    <button class="btn" type="submit">
                        icone svg fleche deroulante
                    </button>
                </form>
            </div>
            <?php include('view/elements/displaymaps.php'); ?>
            <form class="form_button">
                <button class="btn" type="submit">
                    Show Mappool
                </button>
            </form>

        <?php  endfor; ?>
    </div>
    <?php if ($d == 1){ $i-=($max+1);} ?>
<?php endfor; ?>
