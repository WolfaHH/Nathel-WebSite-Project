<?php


namespace Nathel;


class HomeController extends Controller
{
    public $collection;
    public $mappools;
    protected function showCollection()
    {

        CollectionView::show($this->collection);

    }

    protected function showMappools()
    {
        MappoolView::showV2($this->mappools);

    }

    public function showCollectionPage()
    {
        $this->collection = new Collection($_GET['collection_id']);
        $this->mappools = $this->collection->getCollectionMappools();

        View::header();
        $this->showCollection();
        $this->showMappools();
        View::footer();

    }
}