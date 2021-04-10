<section class="bg-medium">

    <?php
    echo "bla";

    foreach ($collections as $collection_user) {
        $collection = new \Nathel\Collection($collection_user['id']);
        \Nathel\CollectionView::showV2($collection);
    }
    ?>

</section>