<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class UserTable extends Table
{
    private $connexion;
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function newUser(){

        $articlesTable = TableRegistry::get('User');
        $article = $articlesTable->newEntity();
        $article->Username = $_POST['username'];
        $article->Password = hash("md5", $_POST['password']);
        $article->Nom = $_POST['name'];
        $article->Prenom = $_POST['firstname'];
        $article->Birthday = $_POST['birthday'];
        $article->Email = $_POST['email'];

        if($articlesTable->save($article)){
            echo "Inscription réussie.";  
        }else{
            echo "Erreur pendant l'inscription..";
        }
    }
}
?>