<?php


namespace Nathel;


class CreateCollectionController extends Controller
{
    public function show(){
        Controller::storeURI();
        echo '<strong>CREATE A COLLECTION</strong>';
        View::header();
        include '../view/elements/create_collection/bar.php';

        echo '<strong>ADD TO A COLLECTION</strong>';

        $user = new User(9543633); //test
        $collections = $user->getUserCollections();
        include '../view/elements/create_collection/showcollections.php';

        View::footer();

    }

    public function showcreated(){
        Controller::storeURI();
        View::header();

        if ($this->createcollection() == True){
            echo"<br>Collection crée sans soucis !";
        }
        else{
            echo"<br>ça a po marché";
        }


        View::footer();
    }

    public function createcollection()
    {

        // Récupération des données
        $thumbnail = $this->uploadbackground();
        if ($thumbnail == False) { #If none images given
            $thumbnail = './assets/img/default.png';
        }

        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $filters = array();
        if (isset($_POST['gm'])) {
            array_push($filters, $_POST['gm']);
        }
        if (isset($_POST['category'])) {
            foreach ($_POST['category'] as $value) {
                array_push($filters, $value);

            }
        }

        $user = new User(9543633); //test
        $data  = [
            'filters' => $filters,
            'name' => $name,
            'description' => $desc,
            'thumbnail' => $thumbnail

    ];
        //rajouter sécurité nb caractère sur name et description en back

        //Insertion des données :
        $collection = new Collection(Collection::storeCollection($user, $data));
        foreach($data['filters'] as $filter){
            $collection->storeCollectionTag($filter);
        }
        //Vérification de si les données sont bien entrées :
        return True;


    }
    public function uploadbackground(){
        #Contraintes attendues :
        $dossier = './assets/img/useruploads/';
        $taille_maxi = (2**20)*10;
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');

        #Variables du fichier :
        $extension = strrchr($_FILES['background']['name'], '.');

        // Si pas d'images donnée
        if ($_FILES['background']['name'] == null){
            return False;
        }
        $taille = filesize($_FILES['background']['tmp_name']);
        $fichier = basename($_FILES['background']['name']);
        $name = self::random(30) . $extension;


        //Vérifications de sécurité

        if(!in_array($extension, $extensions)) //extension verif
        {
            $erreur = 'problème d\'extension frérot';
        }
        if($taille>$taille_maxi) // size verif
        {
            $erreur = 'Le fichier est obèse....';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {


            if(move_uploaded_file($_FILES['background']['tmp_name'], $dossier . $name)) // Upload
            {
                echo "l'upload a marché trop bien ";
                return $dossier . $name;
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
                return False;
            }
        }
        else
        {
            echo $erreur;
            return False;
        }
    }

    public static function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

}