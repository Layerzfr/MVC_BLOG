<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class BilletTable extends Table
{
    private $connexion;
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function newBillet($id){
        $tags = str_replace(" ", "," , $_POST['tags']);
        
        $articlesTable = TableRegistry::get('Billet');
        $article = $articlesTable->newEntity();
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->tags = $tags;
        $article->created = date('Y-m-d');
        $article->updated = date('Y-m-d');
        $article->user_id = $id;

        if($articlesTable->save($article)){
            echo "Billet créé";  
        }else{
            echo "Erreur pendant la création du billet..";
        }
    }

    public function editBillet($id, $idArticle){
        $tags = str_replace(" ", "," , $_POST['tags']);
        $articlesTable = TableRegistry::get('Billet');
        $article = $articlesTable->get($idArticle);
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->tags = $tags;
        $article->updated = date('Y-m-d');
        if($article->user_id === $_SESSION['id']){
            $articlesTable->save($article);
        }
        
    }

    public function deleteBillet($id, $idArticle){
        $articlesTable = TableRegistry::get('Billet');
        $article = $articlesTable->get($idArticle);
        if($article->user_id === $_SESSION['id']){
            $articlesTable->delete($article);
        }
    }

    public function commentaireBillet($id){
        $articlesTable = TableRegistry::get('Commentaire');
        $article = $articlesTable->newEntity();
        $article->user_id = $_SESSION['id'];
        $article->article_id = $id;
        $article->commentaire = $_POST['commentaire'];
        $articlesTable->save($article);    
    }
}
?>