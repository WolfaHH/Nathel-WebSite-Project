<?php

include '../model/database/Mappool.class.php';

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

 endforeach;



$display_pools[0] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim'],
    'maps' => [
        'id1' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'
        ],
        'id2' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'],
    ]
];
$display_pools[1] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim'],
    'maps' => [
        'id1' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'
        ],
        'id2' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'],
    ]
];
$display_pools[2] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim'],
    'maps' => [
        'id1' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'
        ],
        'id2' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'],
    ]
];
$display_pools[3] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim'],
    'maps' => [
        'id1' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'
        ],
        'id2' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'],
    ]
];
$display_pools[4] = ['name' => 'KimiPool Challenge',
    'from' => 'Dan project : Aim collection',
    'submitter' => 'Nathanael',
    'nb_map' => 45,
    'categories' => [
        'category' => 'tournament',
        'rank_range' => '100k-250k',
        'custom_tag' => 'Aim'],
    'maps' => [
        'id1' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'
        ],
        'id2' => [
            'name' => 'Matsuhita - raspberrycube',
            'img' => 'chemin',
            'mod' => 'chemin_img_mod',
            'mapper' => 'Cookiezi'],
    ]
];
?>
