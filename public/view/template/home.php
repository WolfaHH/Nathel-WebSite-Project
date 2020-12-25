<!-- IMPORT -->
<?php include_once('../controller/backend/home.php');
?>

<main>
    <h1>Osu! Nathel Mappools</h1>
    <p>Get better on and create your mappools</p>
    <form class="form-button">
        <button class="btn" type="submit">
            Continue with osu!
        </button>
    </form>
    <?php for ($d = 0; $d <=1; $d++) : ?>

    <div class="container">
        <h2> <?php echo  $d === 0 ? 'Most popular mappools' : 'Most recent mappools' ?></h2>
        <?php for ($i = 0; $i <= 4; $i++) :
            if ($d == 1){ $i+=5;}
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
        <div>
        <?php foreach ($display_pools[$i]['maps'] as $map ):?>
        <div>
            <span><?php echo $map['name']?></span>
            <span>mappée par <?php echo $map['mapper']?></span>
            + image bg et logo mod
        </div>
        <?php endforeach; ?>

        </div>
        <form class="form_button">
            <button class="btn" type="submit">
                Show Mappool
            </button>
        </form>

        <?php  endfor; ?>
    </div>
    <?php if ($d == 1){ $i-=5;} ?>
    <?php endfor; ?>

    <div class="container">
        <h2>Who are we ?</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices urna sed elit tempus pulvinar. Phasellus elementum eros tincidunt lacinia placerat. Ut non lectus a tellus faucibus elementum. Ut ultricies lacinia massa, nec iaculis risus tincidunt vitae. In tincidunt aliquam felis, at efficitur eros condimentum vitae. Maecenas vehicula, elit sit amet elementum scelerisque, urna orci venenatis neque, nec malesuada justo turpis sit amet ante.</p>
        <div>
            image profil, nom et description + bouton know more X2
        </div>
    </div>

    <div class="container">
        <h2>Improve !</h2>
        <div> img stylé, slogan 1</div>
        <div> img stylé, slogan 2</div>
        <div> img stylé, slogan 3</div>
        <h2>& Create !</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices urna sed elit tempus pulvinar. Phasellus elementum eros tincidunt lacinia placerat. Ut non lectus a tellus faucibus elementum. Ut ultricies lacinia massa, nec iaculis risus tincidunt vitae. In tincidunt aliquam felis, at efficitur eros condimentum vitae. Maecenas vehicula, elit sit amet elementum scelerisque, urna orci venenatis neque, nec malesuada justo turpis sit amet ante.</p>
        <form class="form-button">
            <button class="btn" type="submit">
                Create my first mappool now !
            </button>
        </form>
    </div>
</main>