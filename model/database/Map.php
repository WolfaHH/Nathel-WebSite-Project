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


    public function __construct($map_id)
    {
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

    public function GetBeatmapset()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM beatmapsets WHERE id = :id');
        $stmt->bindParam(':id', $this->beatmapset_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function StoreMap($data)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO maps (beatmapset_id, bpm, ar, cs, drain, accuracy, hit_length, mode_int, url, difficulty ) VALUES (:beatmapset_id, :bpm, :ar, :cs, :drain, :accuracy, :hit_length, :mode_int, :url, :difficulty)');
        $stmt->bindParam(':beatmapset_id', $data['beatmapset_id']);
        $stmt->bindParam(':bpm', $data['bpm']);
        $stmt->bindParam(':ar', $data['ar']);
        $stmt->bindParam(':cs', $data['cs']);
        $stmt->bindParam(':drain', $data['drain']);
        $stmt->bindParam(':accuracy', $data['accuracy']);
        $stmt->bindParam(':hit_length', $data['hit_length']);
        $stmt->bindParam(':mode_int', $data['mode_int']);
        $stmt->bindParam(':url', $data['url']);
        $stmt->bindParam(':difficulty', $data['difficulty']);
        $stmt->execute();
    }

    public function DeleteMap()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM maps WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function deleteMapppool_Map()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappool_maps WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }



}
?>

}

