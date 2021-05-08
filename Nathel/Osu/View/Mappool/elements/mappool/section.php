<section class="section">

    <h2 class="h2"><?= $sectionName ?></h2>
    <?php

    foreach ($mappools as $mappool_user) {

        $mappool = new \Nathel\Osu\Model\Mappool\Database\Mappool($mappool_user);

        Nathel\Osu\View\Mappool\MappoolView::show($mappool);
    }
    ?>


</section>