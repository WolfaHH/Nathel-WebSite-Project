<?php
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;
?>

<?php foreach($collections as $collection){
   // \Nathel\CollectionView::show($collection);
    $coco = new Data\Collection($collection['id']);
    View\CollectionView::show($coco);
}
