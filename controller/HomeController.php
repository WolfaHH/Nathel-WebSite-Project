<?php


namespace Nathel;


class HomeController extends Controller
{
    protected function setMappools()
    {

        $popular = Mappool::GetMostPopular();
        $recent = Mappool::GetMostRecent();

        $mappools = [$popular, $recent];

        return $mappools;

    }
    protected function showMappools()
    {
        $mappools = $this->setMappools();
        MappoolView::section($mappools[0], 'Most popular mappools');
        MappoolView::section($mappools[1], 'Most recent mappools');

    }

    public function showHome()
    {
        View::header();
        include '../view/elements/home/jumbotron.php';
        $this->showMappools();
        include '../view/elements/home/aftertron.php';
        View::footer();

    }
}