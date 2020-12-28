<?php


namespace Nathel;


class HomeController extends Controller
{
    protected function setDisplayPools()
    {
        include 'model/database/Mappool.class.php';

        $data = new Mappool();

        $popular = $data->GetMostPopular();
        $recent = $data->GetMostRecent();
        var_dump($popular);

        foreach ($popular as $key => $value ):
            $maps = $data->GetMapsFromMappool($popular['id']);
            $collection_name = $data->GetCollectionInfoFromAPool($value['collection_id']);
            $display_pools[$key] = [
                'name' => $value['name'],
                'from' => $collection_name,
                'submitter' => $value['submitter'],
                'nb_map' => $data->GetNbMaps(),
                'categories' => [
                    'category' =>,
            'rank_range' =>,
            'custom_tags' =>,
        ]
            ];

        endforeach; //Tableau à finir

        return $display_pools;

    }
    protected function showDisplayPools()
    {
        $display_pools = $this->setDisplayPools;
        $displayname1 = 'Most popular mappools';
        $displayname2 = 'Most recent mappools';
        $max = 4;
        MappoolView::show($display_pools, $displayname1, $displayname2, $max);

    }

    public function showHome()
    {
        View::header();
        include 'view/elements/home/jumbotron.php';
        $this->showDisplayPools();
        include 'view/elements/home/aftertron.php';
        View::footer();

    }
}