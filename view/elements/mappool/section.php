<section class="bg-medium">

    <h2 class="section-title"><?= $sectionName ?></h2>

    <?php
    foreach ($mappools as $mappool_user) {
        var_dump($mappool_user);
        $mappool = new \Nathel\Mappool($mappool_user);

        \Nathel\MappoolView::show($mappool);
    }
    ?>


</section>