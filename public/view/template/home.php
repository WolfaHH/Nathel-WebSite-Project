<?php

$popular_pools[0] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [[tournament, 1], [rank_range, 3], [Aim, 0]]
];
$popular_pools[1] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [['tournament', 1], ['rank_range', 3], ['Aim', 0]]
];
#...

?>

<main>
    <h1>Osu! Nathel Mappools</h1>
    <p>Get better on and create your mappools</p>
    <form class="form-button">
        <button class="btn" type="submit">
            Continue with osu!
        </button>
    </form>

    <div class="container">
        <h2>Most popular mappools</h2>
        <?php for ($i = 0; $i <= 5; $i++) { ?>
        <div class="mostpopular <?php $i ?>">
        <span><?php echo $popular_pools[$i] ?></span>
        <span>from <?php echo $popular_pools[$i]['from'] ?></span>
        <span>submitted by <?php echo $popular_pools[$i]['submitter'] ?></span>
        <span> <?php echo $popular_pools[$i]['nb_map'] ?></span>
        <span>
            <?php foreach ($popular_pools[$i]['categories'] as $index => $category ){}?>
        </span>
        <form class="form-button">
            <button class="btn" type="submit">
                fleche svg
                Follow
            </button>
        </form>
        <form class="fleche">
            <button class="btn" type="submit">
                icone svg fleche
            </button>
        </form>
    </div>
            
        <?php }?>


    </div>
</main>