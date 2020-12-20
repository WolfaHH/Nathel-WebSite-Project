<?php

namespace Nathel;

class Collection extends Dbh{

    public $id;
    public $name;
    public $thumbnail;
    public $created_at;
    public $updated_at;
    public $submitter;
    public $Description;
    public $follow;


    public function __construct($mappool_id){
        $this->id = $mappool_id;
        $collection = $this->getCollection();
        $this->name = $collection['name'];
        $this->thumbnail = $collection['thumbnail'];
        $this->created_at = $collection['created_at'];
        $this->updated_at = $collection['updated_at'];
    }

    private function getCollection()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private function getMappools(){

    }

    private function getContributors(){

    }

    private function getTags(){

    }

    private function getInvitations(){

    }

    private function storeCollection(){

    }

    private function storeMappoolInCollection(){

    }

    private function storeTag(){

    }

    private function storeContributor(){

    }

    private function storeInvitation(){

    }

    private function updateName(){

    }

    private function updateDescription(){

    }

    private function deleteCollection(){

    }

    private function deleteMappoolInCollection(){

    }

    private function deleteTag(){

    }

    private function deleteContributor(){

    }

    private function deleteInvitation(){

    }




    private function calculateNbFollow(){

    }




}
?>

}

