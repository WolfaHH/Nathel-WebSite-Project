<section class="section">

    <h2 class="h2"><?= $sectionName ?></h2>
    <?php

    foreach ($mappools as $mappool_user) {

        $mappool = new \Nathel\Mappool($mappool_user);

        \Nathel\MappoolView::show($mappool);
    }
    ?>


</section>