<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;


class CollectionController extends Controller
{
    public $collection;
    public $mappools;
    protected function showCollection()
    {

        View\CollectionView::show($this->collection);

    }

    protected function showMappools()
    {
        View\MappoolView::sectionV2($this->mappools);

    }

    public function showCollectionPage($params)
    {
        Control\Controller::storeURI();
        $this->collection = new Data\Collection($params['id']);
        $this->mappools = $this->collection->getCollectionMappools();

        View\View::header();

        $this->showCollection();

        $this->showMappools();
        View\View::footer();

    }
}