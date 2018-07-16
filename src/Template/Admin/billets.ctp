<a href='/admin/billets'>Gérer tous les billets</a>
<a href='/admin/comments'>Gérer tous les commentaires</a>
<a href='/admin/users'>Gérer tous les utilisateurs</a>
<?php
use Cake\ORM\TableRegistry;
if(isset($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 1;
}
$query = TableRegistry::get('Billet')
->find()
->limit(5)
->page($page);
$count = $query->count();
?>
<?php
foreach ($query as $article) {
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
    echo "<form method='POST' action='/admin/billets/".$article->id."'>";
    echo "<button type='submit' name='delete'>Supprimer le post</button>";
    echo "</form>";
    
    echo "<p>". $queryNbCommentaire->count()." Commentaires</p>";
    echo "<a href='/billet/".$article->id."'>Commenter</a>";
    echo "</div>";
}
$i=0;
echo "<br>";
echo "<p>Page:</p>";
while($i<($count/5)){
    $i++;
    echo "<a href='/billet?p=".$i."'>".$i."</a>";    
}
?>
