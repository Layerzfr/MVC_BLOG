<?php
use Cake\ORM\TableRegistry;
$id = explode("/", $_SERVER['REQUEST_URI']);
$query = TableRegistry::get('Billet')
->find()
->where(['id' => $id[2]])
?>
<a href="/accueil">Accueil</a>
<a href="/billet">Voir tous les billets</a>
<div class="container">
<?php if(isset($_SESSION['username'])){
    $articlesTable = TableRegistry::get('Billet');
    if($article = $articlesTable->exists(['id' => $id[2]])){

echo "<form method='POST' action='edit'>
    <p>Titre:</p>
    <input name='title' type='text'>
    <p>Contenu:</p>
    <input name='content' type='text'>
    <p>Tags:</p>
    <input name='tags' type='text'>
    <p>Rédacteur :". $_SESSION['username']. " </p>
    <button type='submit' name='submit'>Modifier le billet</button>

</form>";
    }
}else{
echo "<p>Vous devez vous</p><a href='/accueil'>connecter </a> pour moidifer un billet </p>";
} ?>
</div>