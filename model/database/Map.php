<?php

namespace Nathel;

class Map extends Dbh{

    public $id;
    public $beatmapset_id;
    public $name;
    public $difficulty;
    public $bpm;
    public $ar;
    public $cs;
    public $drain;
    public $accuracy;
    public $hit_length;
    public $mode_int;
    public $url;


    public function __construct($map_id){
        $this->id = $map_id;
        $map = $this->getMap();
        $this->beatmapset_id = $map['beatmapset_id'];
        $this->difficulty = $map['difficulty'];
        $this->bpm = $map['bpm'];
        $this->ar = $map['ar'];
        $this->cs = $map['drain'];
        $this->drain = $map['drain'];
        $this->accuracy = $map['accuracy'];
        $this->hit_length = $map['hit_length'];
        $this->mode_int = $map['mode_int'];
        $this->url = $map['url'];
    }

    private function GetMap()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM beatmaps WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetBeatmapset(){}
    public function StoreMap(){}
    public function UpdateMode(){}
    public function DeleteMap(){}





}
?>

}

