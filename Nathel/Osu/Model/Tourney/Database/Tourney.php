<?php

namespace Nathel\Osu\Model\Tourney\Database;
use Nathel\Osu\Model\Dbh;

class Tourney extends Dbh{

    public $id;
    public $collection_id;
    public $name;
    public $acronym;
    public $description;
    public $iteration;
    public $thumbnail;
    public $background_home;
    public $follow;
    public $nb_players;
    public $nb_inscrits;
    public $discord;
    public $twitter;
    public $forum_post;
    public $mode;
    public $scorev2;
    public $range;
    public $team;
    public $qualif;
    public $groupstages;
    public $bracket_format;
    public $max_pt;
    public $max_reg;
    public $round_of;
    public $reg_start_date;
    public $reg_close_date;
    public $color_theme;
    public $updated_at;
    public $created_at;

    public function __construct(){
        $this->id;
        $tourney = $this->getTourney();
        $this->collection_id = $tourney['collection_id'];
        $this->name = $tourney['name'];
        $this->acronym = $tourney['acronym'];
        $this->description = $tourney['description'];
        $this->iteration = $tourney['iteration'];
        $this->thumbnail = $tourney['thumbnail'];
        $this->background_home = $tourney['background_home'];
        $this->follow = $tourney['follow'];
        $this->nb_players = $tourney['nb_players'];
        $this->nb_inscrits = $tourney['nb_inscrits'];
        $this->discord = $tourney['discord'];
        $this->twitter = $tourney['twitter'];
        $this->forum_post = $tourney['forum_post'];
        $this->mode = $tourney['mode'];
        $this->scorev2 = $tourney['scorev2'];
        $this->range = $tourney['range'];
        $this->team = $tourney['team'];
        $this->qualif = $tourney['qualif'];
        $this->groupstages = $tourney['groupstages'];
        $this->bracket_format = $tourney['bracket_format'];
        $this->max_pt = $tourney['max_pt'];
        $this->max_reg = $tourney['max_reg'];
        $this->round_of = $tourney['round_of'];
        $this->reg_start_date = $tourney['reg_start_date'];
        $this->reg_close_date = $tourney['reg_close_date'];
        $this->color_theme = $tourney['color_theme'];
        $this->updated_at = $tourney['updated_at'];
        $this->created_at = $tourney['created_at'];

    }

    /* ##### ALL GET METHODS ##### */

    public function getTourney():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM tourneys WHERE id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getTourneyPlayers():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM players WHERE tourney_id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyTeams():array //A faire plus tard
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM teams AS t JOIN team_users AS u ON u.team_id = t.id JOIN players AS p ON p.id = u.player_id WHERE  ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyAnnounces():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM announces WHERE tourney_id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAnnounceComments($announce_id):array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM comments WHERE announce_id = :id');
        $stmt->bindParam(':id', $announce_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyWidgets():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM widgets WHERE tourney_id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyBlacklisted():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM blacklisted WHERE tourney_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyMatches():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM matches WHERE tourney_id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyGroups():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM groups WHERE tourney_id = :id  ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTourneyLobbies():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM lobbies WHERE tourney_id = :id ');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ##### ALL UPDATE METHODS ##### */
/* template:
    public static function update(){
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE  SET  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }
*/

    /* ##### ALL STORE METHODS ##### */

    public static function storeTourney($data) // Insert à finir
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO tourneys (id,collection_id,name, acronym,description,iteration ) VALUES () ');
         $stmt->bindParam(':id',$data['id']);
         $stmt->bindParam(':collection_id',$data['collection_id']);
         $stmt->bindParam(':name',$data['name']);
         $stmt->bindParam(':acronym',$data['acronym']);
         $stmt->bindParam(':description',$data['description']);
         $stmt->bindParam(':iteration',$data['iteration']);
         $stmt->bindParam(':thumbnail',$data['thumbnail']);
         $stmt->bindParam(':background_home',$data['background_home']);
         $stmt->bindParam(':follow',$data['follow']);
         $stmt->bindParam(':nb_players',$data['nb_players']);
         $stmt->bindParam(':nb_inscrits',$data['nb_inscrits']);
         $stmt->bindParam(':discord',$data['discord']);
         $stmt->bindParam(':twitter',$data['twitter']);
         $stmt->bindParam(':forum_post',$data['forum_post']);
         $stmt->bindParam(':mode',$data['mode']);
         $stmt->bindParam(':scorev2',$data['scorev2']);
         $stmt->bindParam(':range',$data['range']);
         $stmt->bindParam(':team',$data['team']);
         $stmt->bindParam(':qualif',$data['qualif']);
         $stmt->bindParam(':groupstages',$data['groupstages']);
         $stmt->bindParam(':bracket_format',$data['bracket_format']);
         $stmt->bindParam(':max_pt',$data['max_pt']);
         $stmt->bindParam(':max_reg',$data['max_reg']);
         $stmt->bindParam(':round_of',$data['round_of']);
         $stmt->bindParam(':reg_start_date',$data['reg_start_date']);
         $stmt->bindParam(':reg_close_date',$data['reg_close_date']);
         $stmt->bindParam(':color_theme',$data['color_theme']);

        $stmt->execute();
    }

    public static function storePlayer($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO players (id, user_id, tourney_id, state) VALUES (:id, :user_id, :tourney_id, :state) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':user_id',$data['user_id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':state',$data['state']);
        $stmt->execute();
    }

    public static function storeTeam($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO teams (id, team_name, logo) VALUES (:id, :team_name, :logo) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':team_name',$data['team_name']);
        $stmt->bindParam(':logo',$data['logo']);
        $stmt->execute();
    }

    public static function storeTeamUser($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO team_users (player_id, team_id, captain) VALUES (:player_id, :team_id, :captain) ');
        $stmt->bindParam(':player_id',$data['player_id']);
        $stmt->bindParam(':team_id',$data['team_id']);
        $stmt->bindParam(':captain',$data['captain']);
        $stmt->execute();
    }

    public static function storeAnnounce($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO announces (id, tourney_id, user_id, content) VALUES (:id, :tourney_id, :user_id, :content) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':user_id',$data['user_id']);
        $stmt->bindParam(':content',$data['content']);
        $stmt->execute();
    }

    public static function storeComment($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO comments (id, announce_id, comment_id, user_id, content, like) VALUES (:id, :announce_id, :comment_id, :user_id, :content, :like) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':announce_id',$data['announce_id']);
        $stmt->bindParam(':comment_id',$data['comment_id']);
        $stmt->bindParam(':user_id',$data['user_id']);
        $stmt->bindParam(':content',$data['content']);
        $stmt->bindParam(':like',$data['like']);
        $stmt->execute();
    }

    public static function storeStep($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO steps (id, tourney_id, mappool_id, step,date, position, best_of, bans) VALUES (:id, :tourney_id, :mappool_id, :step,:date, :position, :best_of, :bans) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':mappool_id',$data['mappool_id']);
        $stmt->bindParam(':step',$data['step']);
        $stmt->bindParam(':date',$data['date']);
        $stmt->bindParam(':position',$data['position']);
        $stmt->bindParam(':best_of',$data['best_of']);
        $stmt->bindParam(':bans',$data['bans']);
        $stmt->execute();
    }

    public static function storeWidget($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO widgets (tourney_id, content, title, position, page) VALUES (:tourney_id, :content, :title, :position, :page) ');
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':content',$data['content']);
        $stmt->bindParam(':title',$data['title']);
        $stmt->bindParam(':position',$data['position']);
        $stmt->bindParam(':page',$data['page']);
        $stmt->execute();
    }

    public static function storeBlacklisted($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO blacklisted (user_id, tourney_id, reason, admin_approved, banpartout, degree) VALUES (:user_id, :tourney_id, :reason, :admin_approved, :banpartout, :degree) ');
        $stmt->bindParam(':user_id',$data['user_id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':reason',$data['reason']);
        $stmt->bindParam(':admin_approved',$data['admin_approved']);
        $stmt->bindParam(':banpartout',$data['banpartout']);
        $stmt->bindParam(':degree',$data['degree']);
        $stmt->execute();
    }

    public static function storelobby($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO lobbies (id, tourney_id, step_id, date, replay) VALUES (:id, :tourney_id, :step_id, :date, :replay) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':step_id',$data['step_id']);
        $stmt->bindParam(':date',$data['date']);
        $stmt->bindParam(':replay',$data['replay']);
        $stmt->execute();
    }


    /* ##### ALL DELETE METHODS ##### */

    public function deleteTourney()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM tourneys WHERE id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deletePlayer()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM players WHERE tourney_id = :id ');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteTeam()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM teams WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteTeamUser()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM team_users WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteAnnounce()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM announces WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteComment()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM comments WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteStep()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM steps WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteWidget()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM widgets WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteBlacklisted()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM blacklisted WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteLobby()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM lobbies WHERE tourney_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }
}



