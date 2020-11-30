<?php

$popular_pools[0] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        ['id' => 1,
            'name' => 'tournament',
            'type' => 'category'],
        ['id' => 2,
            'name' => 'Aim',
            'type' => 'custom_tag'],
        ['id' => 3,
            'name' => '100k-250k',
            'type' => 'rank_range']]
];
$popular_pools[1] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim']
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
        <?php for ($i = 0; $i <= 5; $i++) : ?>
        <div class="mostpopular <?php $i ?>">
        <span><?php echo $popular_pools[$i] ?></span>
        <span>from <?php echo $popular_pools[$i]['from'] ?></span>
        <span>submitted by <?php echo $popular_pools[$i]['submitter'] ?></span>
        <span> <?php echo $popular_pools[$i]['nb_map'] ?></span>
        <span>

            <?php foreach ($popular_pools[$i]['categories'] as $category ):?>

            <span class="color-<?= $category['type'] ?>"><?= $category['name'] ?></span>

            <?php endforeach; ?>

            
            <?php foreach ($popular_pools[$i]['categories'] as $index => $category ):?>

                <span class="color-<?= $index ?>"><?= $category ?></span>

            <?php endforeach; ?>
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
            
        <?php endfor; ?>


    </div>
</main>