<?php
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;
?>

<section class="bg-medium">

    <?php

    foreach ($mappools as $mappool_user) {
        $mappool = new Data\Mappool($mappool_user['id']);

        View\MappoolView::show($mappool);
    }
    ?>

</section>