<?php

namespace Nathel\Osu\Model\Tourney\Database;
use Nathel\Osu\Model\Dbh;

class Matche extends Dbh{

    public $id;
    public $tourney_id;
    public $first_date;
    public $current_date;
    public $ref_id;
    public $red_side;
    public $blue_side;
    public $status;
    public $first_picker;
    public $step_id;
    public $postion;


    public function __construct($id){
        $this->id = $id;
        $match = $this->getMatch();
        $this->tourney_id = $match['tourney_id'];
        $this->first_date = $match['first_date'];
        $this->current_date = $match['current_date'];
        $this->ref_id = $match['ref_id'];
        $this->red_side = $match['red_side'];
        $this->blue_side = $match['blue_side'];
        $this->status = $match['status'];
        $this->first_picker = $match['first_picker'];
        $this->step_id = $match['step_id'];
        $this->postion = $match['postion'];


    }

    /* ##### ALL GET METHODS ##### */


    public function getMatch():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM matches WHERE id = :id ');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMatchRounds():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM rounds WHERE match_id = :id ');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMatchBans():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM bans WHERE match_id = :id ');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ##### ALL UPDATE METHODS ##### */
/*
    public static function update(){
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE  SET  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }
*/

    /* ##### ALL STORE METHODS ##### */


    public static function storeMatch($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO matches (id, tourney_id, first_date, current_date, ref_id, red_side, blue_side, status,first_picker, step_id, position) VALUES (:id, :tourney_id, :first_date, :current_date, :ref_id, :red_side, :blue_side, :status, :position) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':first_date',$data['first_date']);
        $stmt->bindParam(':current_date',$data['current_date']);
        $stmt->bindParam(':ref_id',$data['ref_id']);
        $stmt->bindParam(':red_side',$data['red_side']);
        $stmt->bindParam(':blue_side',$data['blue_side']);
        $stmt->bindParam(':status',$data['status']);
        $stmt->bindParam(':first_picker',$data['first_picker']);
        $stmt->bindParam(':step_id',$data['step_id']);
        $stmt->bindParam(':position',$data['position']);
        $stmt->execute();
    }

    public static function storeRound($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO rounds (id, match_o_lobby_id, mappool_maps_id, score_match, acc, misscount, score_v1) VALUES (:id, :match_o_lobby_id, :mappool_maps_id, :score_match, :acc, :misscount, :score_v1) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':match_o_lobby_id',$data['match_o_lobby_id']);
        $stmt->bindParam(':mappool_maps_id',$data['mappool_map_id']);
        $stmt->bindParam(':score_match',$data['score_match']);
        $stmt->bindParam(':acc',$data['acc']);
        $stmt->bindParam(':misscount',$data['misscount']);
        $stmt->bindParam(':score_v1',$data['score_v1']);
        $stmt->execute();
    }

    public static function storeBan($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO bans (match_id, mappool_maps_id, color) VALUES (:match_id, :mappool_maps_id, :color) ');
        $stmt->bindParam(':match_id',$data['match_id']);
        $stmt->bindParam(':mappool_maps_id',$data['mappool_maps_id']);
        $stmt->bindParam(':color',$data['color']);
        $stmt->execute();
    }

    /* ##### ALL DELETE METHODS ##### */
/*
    public function delete()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }
*/

    public function deleteMatch()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM matches  WHERE id = :id ');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteRound()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM rounds  WHERE match_id = :id ');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteBan()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM bans WHERE match_id = :id ');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }








}




