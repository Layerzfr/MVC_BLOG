
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
->order(['updated' => 'DESC'])
->order(['id' => 'DESC'])
->page($page);
$count = $query->count();
?>
<a href="/accueil">Accueil</a>
<?php
if($_SESSION['rank']> 0){
    echo "<a href='/billet/new'>Nouveau billet</a>";
}
?>
<div class="container">
<h2>Tous les articles:</h2>
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
    if($article->user_id === $_SESSION['id']){
        echo "<a href='/billet/".$article->id."/edit'>Editer le billet</a>";
        echo "<br>";
        echo "<a href='/billet/".$article->id."/delete'>Supprimer le billet</a>";
        echo "<br>";
    }
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
</div>