<?php foreach($collections as $collection){
   // \Nathel\CollectionView::show($collection);
    $coco = new \Nathel\Collection($collection['id']);
    \Nathel\CollectionView::show($coco);
}
