
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
$query = TableRegistry::get('Commentaire')
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
->limit(5)
->page($page);

$count = $query->count();
?>
<?php
foreach ($query as $commentaire) {
    echo "<div>";
    echo "<p>".$commentaire->commentaire."- Par ".$commentaire->User['Username']." sur l'article ayant l'id ".$commentaire->article_id."</p>";
    echo "<form method='POST' action='/admin/comments/".$commentaire->id."'>";
    echo "<button type='submit' name='delete'>Supprimer ce commentaire</button>";
    echo "</form>";
    echo "</div>";
    
}
$i=0;
echo "<br>";
echo "<p>Page:</p>";
while($i<($count/5)){
    $i++;
    echo "<a href='/admin/comments?p=".$i."'>".$i."</a>";    
}
?>
