<?php

namespace Nathel\Osu\Model\Mappool\Database;


use Cassandra\Exception\TruncateException;

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
        $map = $this->getMap()[0];
        $this->beatmapset_id = $map['beatmapset_id'];
        $this->name = $this->GetBeatmapset()['name'];
        $this->artist = $this->GetBeatmapset()['artist'];
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

    public static function checkMapWithUrl($url)
    {
        $last_occur = strripos($url, "/");
        $ur = substr($url,$last_occur+1);
        $ur = '%'.$ur.'%';
        $stmt = self::connectToDb()->prepare('SELECT * FROM beatmaps WHERE url LIKE :url');
        $stmt->bindParam(':url', $ur);
        $stmt->execute();
        $data = $stmt->fetchALL();
        if (count($data) >= 1){
            return True;
        }else{
            return False;
        }

    }
    public static function getMapWithUrl($url)
    {
        $last_occur = strripos($url, "/");
        $ur = substr($url,$last_occur+1);
        $ur = '%'.$ur.'%';

        $stmt = self::connectToDb()->prepare('SELECT * FROM beatmaps WHERE url LIKE :url');
        $stmt->bindParam(':url', $ur);
        $stmt->execute();
        return $stmt->fetch()['id'];

    }



    public static function getMapbyscore($mappool_map_id)
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappool_maps mm INNER JOIN beatmaps b on mm.map_id = b.id INNER JOIN beatmapsets b2 on b.beatmapset_id = b2.id WHERE mm.id = :mappool_map_id');
        $stmt->bindParam(':mappool_map_id', $mappool_map_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function GetBeatmapset()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM beatmapsets WHERE id = :id');
        $stmt->bindParam(':id', $this->beatmapset_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function StoreMapset($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO beatmapsets (name, creator, artist) VALUES (:name, :creator, :artist)');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':creator', $data['creator']);
        $stmt->bindParam(':artist', $data['artist']);
        $stmt->execute();
        return $dbh->lastInsertId();
    }
    public static function StoreMap($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO beatmaps (beatmapset_id, bpm, ar, cs, drain, accuracy, hit_length, mode_int, url, difficulty ) VALUES (:beatmapset_id, :bpm, :ar, :cs, :drain, :accuracy, :hit_length, :mode_int, :url, :difficulty)');
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
        return $dbh->lastInsertId();
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

