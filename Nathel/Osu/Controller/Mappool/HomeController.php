<?php

/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;



class HomeController extends Controller
{
    protected function setMappools()
    {

        $popular = Data\Mappool::GetMostPopular();
        $recent = Data\Mappool::GetMostRecent();

        $mappools = [$popular, $recent];

        return $mappools;

    }
    protected function showMappools()
    {
        $mappools = $this->setMappools();
        View\MappoolView::section($mappools[0], 'Most popular mappools');
        View\MappoolView::section($mappools[1], 'Most recent mappools');

    }

    public function showHome()
    {

        Control\Controller::storeURI();
        View\View::header();
        include '../Nathel/Osu/View/Mappool/elements/home/jumbotron.php';
        $this->showMappools();




    }
}