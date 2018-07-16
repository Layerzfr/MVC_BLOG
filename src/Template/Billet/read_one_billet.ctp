
<?php
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
$id = explode("/", $_SERVER['REQUEST_URI']);
$idArticle = $id[2];
$query = TableRegistry::get('Billet')
->find()
->where(['id' => $idArticle]);

$queryCommentaire = TableRegistry::get('Commentaire')
->find()
->select(['Commentaire.id','Commentaire.user_id','Commentaire.article_id','Commentaire.commentaire',
                'User.Username'])
->join([
    'user' => [
        'table' => 'user',
        'type' => 'INNER',
        'conditions' => [
            'commentaire.user_id = user.id',                            
        ],
    ]])
->where(['article_id' => $idArticle]);
if(!isset($id[4])){
    $id[4] = null;
}
?>
<a href="/accueil">Accueil</a>
<a href="/billet/new">Nouveau billet</a>
<div class="container">
<?php
echo $this->Html->css('highlight');
foreach ($query as $article) {
    echo "<div class='article'>";
    echo "<h3>".Text::highlight(
        $article->title,
        $id[4],
        ['format' => '<span class="highlight">\1</span>']
    )."</h3>";
    echo "<h5>".Text::highlight(
        $article->content,
        $id[4],
        ['format' => '<span class="highlight">\1</span>']
    )."</h5>";
    echo "<h6>Article créé le : ".$article->created."</h6>";
    echo "<h6>Mise à jour le : ".$article->updated."</h6>";
    echo "<h7>Tags: ".Text::highlight(
        $article->tags,
        $id[4],
        ['format' => '<span class="highlight">\1</span>']
    )."</h6>";
    echo "<br>";
    if($article->user_id === $_SESSION['id']){
        echo "<a href='/billet/".$article->id."/edit'>Editer le billet</a>";
        echo "<br>";
        echo "<a href='/billet/".$article->id."/delete'>Supprimer le billet</a>";
        echo "<br>";
    }
    echo "<p>Commentaires:</p>";
    foreach($queryCommentaire as $commentaire){
        echo "<p>".$commentaire->commentaire." - Par ".$commentaire->User['Username']."</p>";
    }
    echo "<p>Poster un commentaire :</p>";
    echo "<form method='POST' action='/billet/".$article->id."'> ";
    echo "<input type='text' name='commentaire'>";
    echo "<button type='submit' name='submit'>Poster commentaire </button>";
    echo "</form>";    
    echo "</div>";
}

?>
</div>