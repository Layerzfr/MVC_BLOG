
<?php

use Cake\ORM\TableRegistry;
$queryUser = TableRegistry::get('User')
->find()
->limit(10)
->order(['id' => 'DESC']);

$queryBillet = TableRegistry::get('Billet')
->find()
->order(['updated' => 'DESC'])
->limit(10);

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
->order(['Commentaire.id' => 'DESC'])
->limit(10);

?>
<div>
<a href='/admin/billets'>Gérer tous les billets</a>
<a href='/admin/comments'>Gérer tous les commentaires</a>
<a href='/admin/users'>Gérer tous les utilisateurs</a>
<h3>10 derniers utilisateurs inscrits:</h3>
<?php
foreach($queryUser as $user){
    echo "<div>";
    echo "<p>Username: ".$user->Username."</p>";
    echo "<p>Email: ".$user->Email."</p>";
    echo "</div>";
    echo "--";
}
echo "</div>";
echo"<div>";
echo "<h3>10 derniers billets: </h3>";
foreach ($queryBillet as $article) {
    $queryNbCommentaire = TableRegistry::get('Commentaire')
    ->find()
    ->where(['article_id' => $article->id]);
    echo "<div class='article'>";
    echo "<h3>".$article->title."</h3>";
    echo "<h5>".$article->content."</h5>";
    echo "<h6>Article créé le : ".$article->created."</h6>";
    echo "<h6>Mise à jour le : ".$article->updated."</h6>";
    echo "<h7>Tags: ".$article->tags."</h6>";
    echo "<br>";
    if($article->user_id === $_SESSION['id']){
        echo "<a href='/billet/".$article->id."/edit'>Editer le billet</a>";
        echo "<br>";
        echo "<a href='/billet/".$article->id."/delete'>Supprimer le billet</a>";
        echo "<br>";
    }
    echo "<a href='/billet/".$article->id."'>". $queryNbCommentaire->count()." Commentaires</a>";
    echo "</div>";
}
echo "</div>";
echo "<div>";
echo "<h3>10 derniers commentaires:</h3>";
foreach($queryCommentaire as $commentaire){
    echo "<p>".$commentaire->commentaire." - Par ".$commentaire->User['Username']."- sur l'article avec l'id: ".$commentaire->article_id."</p>";
}

?>

</div>