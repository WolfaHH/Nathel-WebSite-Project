<?php


namespace Nathel;


class CollectionController extends Controller
{
    public $collection;
    public $mappools;
    protected function showCollection()
    {

        CollectionView::show($this->collection);

    }

    protected function showMappools()
    {
        MappoolView::sectionV2($this->mappools);

    }

    public function showCollectionPage($params)
    {
        $this->collection = new Collection($params['id']);
        $this->mappools = $this->collection->getCollectionMappools();

        View::header();
        $this->showCollection();
        $this->showMappools();
        View::footer();

    }
}