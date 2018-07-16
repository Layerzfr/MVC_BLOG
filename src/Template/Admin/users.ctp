
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
$queryUser = TableRegistry::get('User')
->find()
->limit(5)
->page($page)
->order(['id' => 'DESC']); 
$count = $queryUser->count();

?>
<div>
<?php
foreach($queryUser as $user){
    echo "<p>Username: ".$user->Username."</p>";
    echo "<p>ID: ".$user->id."</p>";
    echo "<p>Nom: ".$user->Nom."</p>";
    echo "<p>Prenom: ".$user->Prenom."</p>";
    echo "<p>Date de naissance: ".$user->Birthday."</p>";
    echo "<p>Email: ".$user->Email."</p>";
    echo "<form method='POST' action='/admin/users/".$user->id."'>";
    if($user->id !== $_SESSION['id']){
        if($user->Block === 0){
    echo "<button type='submit' name='disable'>Désactiver l'utilisateur</button>";
        }else{
            echo "<button type='submit' name='disable'>Activer l'utilisateur</button>";
        }
    echo "<button type='submit' name='delete'>Supprimer l'utilisateur</button>";
    }
    echo "</form>";
    echo "--";
}
$i=0;
echo "<br>";
echo "<p>Page:</p>";
while($i<($count/5)){
    $i++;
    echo "<a href='/admin/users?p=".$i."'>".$i."</a>";    
}

?>
</div>
