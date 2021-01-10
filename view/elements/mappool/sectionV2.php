<section class="bg-medium">

    <?php

    foreach ($mappools as $mappool_user) {
        $mappool = new \Nathel\Mappool($mappool_user['id']);

        \Nathel\MappoolView::show($mappool);
    }
    ?>

</section>