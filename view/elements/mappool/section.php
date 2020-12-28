<section class="bg-medium">

    <h2 class="section-title"><?= $sectionName ?></h2>

    <?php
    foreach ($mappools as $mappool_user) {
        $mappool = new Mappool($mappool_user['id']);
        \Nathel\Mappool::show($mappool);
    }
    ?>
    
</section>