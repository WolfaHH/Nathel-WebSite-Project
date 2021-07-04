<?php
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;
?>

<section class="bg-medium">

    <?php
    echo "bla";

    foreach ($collections as $collection_user) {
        $collection = new Data\Collection($collection_user['id']);
        View\CollectionView::showV2($collection);
    }
    ?>

</section>
