<?php

namespace Nathel;

class Collection extends Dbh
{

    public $id;
    public $name;
    public $thumbnail;
    public $description;
    public $created_at;
    public $updated_at;


    public function __construct($collection_id)
    {
        $this->id = $collection_id;
        $collection = $this->getCollection();
        $this->name = $collection['name'];
        $this->thumbnail = $collection['thumbnail'];
        $this->description = $collection['description'];
        $this->created_at = $collection['created_at'];
        $this->updated_at = $collection['updated_at'];
    }



    public function getCollection(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCollectionMappools(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /*
    public function getCollectionContributorsRelation(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCollectionContributors(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }*/

    public function getLastContributor(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id LIMIT 1');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getContributors(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    public function getContributorsAsUsers(): array //Renvoi un tableau d'objets de type User
    {
        $contributors = $this->getContributors();
        $res = array();
        foreach($contributors as $con){
            $new = new User($con['user_id']);
            array_push($res, $new);



        }

        return $res;
    }

    public function getCollectionCreator(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id AND creator = 1');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCollectionTags(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collection_tags INNER JOIN tags on collection_tags.tag_id = tags.id WHERE collection_id = :collection_id ORDER BY type');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCollectionTag(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collection_tags WHERE collection_id = :collection_id AND tag_id = :tag_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function getTAGS(){
        $stmt = self::connectToDb()->prepare('SELECT * FROM tags');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalFollow(): int
    {
        $stmt = self::connectToDb()->prepare('SELECT COUNT(*) FROM collections INNER JOIN mappools ON collections.id = mappools.collection_id INNER JOIN mappool_followed mf on mappools.id = mf.mappool_id WHERE collections.id = :id GROUP BY mf.user_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }



    public static function storeCollection(User $user, $data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO collections (name, thumbnail, description) VALUES (:name, :thumbnail, :description)');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
        $id = $dbh->lastInsertId();

        $user->storeCreator($id);

        $stmt = self::connectToDb()->prepare('SELECT id FROM collections WHERE thumbnail = :thumbnail');
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->execute();
        return $stmt->fetch()['id'];

    }

    public static function storeNewTag($data): string
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO tags (name, type) VALUES (:name, :type)');
        $stmt->bindParam(':collection_id', $data['name']);
        $stmt->bindParam(':tag_id', $data['type']);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    public function storeCollectionTag($tag_id)
    {

        $stmt = self::connectToDb()->prepare('INSERT INTO collection_tags (collection_id, tag_id) VALUES (:collection_id, :tag_id)');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->bindParam(':tag_id', $tag_id);

        $stmt->execute();
    }



    public function updateName($name): bool
    {
        $stmt = self::connectToDb()->prepare('UPDATE collections SET name = :name, updated_at = NOW() WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function updateDescription($description): bool
    {
        $stmt = self::connectToDb()->prepare('UPDATE collections SET description = :description, updated_at = NOW() WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }



    public function deleteCollection()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $this->deleteCollectionMappools();
        $this->deleteCollectionTags();
        $this->deleteCollectionContributors();
        $this->deleteCollectionInvitation();
    }

    private function deleteCollectionMappools()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappools WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteCollectionTags()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM collection_tags WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
    public function deleteCollectionTag($tag)
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM collection_tags WHERE collection_id = :id AND tag_id = :tag_id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':tag_id', $tag);
        $stmt->execute();
    }

    private function deleteCollectionContributors()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM contributors WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteCollectionInvitation()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM invitations WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    //Search bar query :


    public static function getMostPopular($filters=False)
    {
        //$filters = [11,6,7,2];
        if ($filters === False){

            $stmt = self::connectToDb()->prepare('SELECT DISTINCT * FROM mappools mp INNER JOIN collections cl ON mp.collection_id = cl.id ORDER BY mp.follow');
            $stmt->execute();
            $result = $stmt->fetchAll();

        }else{

            $stmt = self::connectToDb()->prepare('SELECT DISTINCT * FROM collections cl 
                                                        INNER JOIN collection_tags ct ON cl.id = ct.collection_id
                                                        WHERE ct.tag_id =:suite');

            $stmt->bindParam(':suite', $filters[0]);
            $stmt->execute();
            $result = $stmt->fetchAll();

            $filters = array_slice($filters,1);
            foreach($filters as $filter){
                $ids = array();
                foreach ($result as $col){
                    array_push($ids, $col['collection_id']);


                }
                $ids = implode($ids, ',');
                $query = 'SELECT DISTINCT * FROM collections cl 
                                                        INNER JOIN collection_tags ct ON cl.id = ct.collection_id
                                                        WHERE ct.tag_id = :suite AND cl.id IN '.'('.$ids.')';
                $stmt = self::connectToDb()->prepare($query);

                $stmt->bindParam(':suite', $filter);
                //$stmt->bindParam(':suite2', $ids);
                $stmt->execute();
                $result = $stmt->fetchAll();
            }




        }
        return $result;
    }


    public static function P($E)
    {
        $P = array();
        $i = 0;
        $max_i = 2**(count($E))-1;

        while ($i <= $max_i){
            $s = array();
            $j = 0;
            $max_j = count($E)-1;
            while ($j <= $max_j){
                if (($i>>$j)&1 == 1){
                    array_push($s, $E[$j]);
                }
                $j+=1;
            }

            array_push($P, $s);
            $i+=1;
        }

        return $P;
    }

    public static function  searchCollectionsWithName($mots)
    {
        $queries = self::P($mots);
        $collections = array();
        foreach ($queries as $key => $query){
            if ($key>=1){
                $s = "";
                if (count($query)>1){
                    for($i = 1; $i<count($query);$i++){
                        $s.= ' AND "%'.$query[$i].'%"';
                    }
                }
                $ch = $query[0];
                $q = "%".$ch."%";
                $stmt = self::connectToDb()->prepare('SELECT * FROM collections WHERE name LIKE :mot1 :suite');
                $stmt->bindParam(':mot1', $q);
                $stmt->bindParam(':suite', $s);
                $stmt->execute();
                $tmp = $stmt->fetchAll();

                $i = 0;
                foreach($tmp as $collection)
                {
                    for($j = 1; $j<=5; $j++)
                    {
                        if (count($query) === $j)
                        {
                            $tmp[$i]['value'] = $j;
                        }
                    }
                    $i++;

                }

                $collections = array_merge($collections, $tmp);
            }
        }
        //var_dump($collections);
        return $collections;
    }
    // fonctions pour contributeur ; requete : SELECT * FROM contributors cb INNER JOIN collections cl ON cb.collection_id = cl.id WHERE cb.user_id = X

    public static function searchCollectionWithContributors($mots)
    {
        foreach ($mots as $mot){
            $stmt = self::connectToDb()->prepare('SELECT * FROM contributors cb INNER JOIN collections cl ON cb.collection_id = cl.id WHERE cb.user_id = :id');
            $stmt->bindParam(':mot1', $mot);
            $stmt->execute();
            $tmp = $stmt->fetchAll();
        }
    }

}

