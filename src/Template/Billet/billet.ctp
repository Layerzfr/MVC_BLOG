<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<?php if(isset($_SESSION['username'])){
    $this->Froala->plugin();
    $this->Froala->editor('#froala-editor', array('inlineMode' => false));
    echo "<form method='POST' action='/billet/new'>
        <p>Titre:</p>
        <input name='title' type='text'>
        <p>Contenu:</p>
        
        <textarea name='content' id='froala-editor'></textarea>
        <p>Tags:</p>
        <input name='tags' type='text'>
        <p>Rédacteur :". $_SESSION['username']. " </p>
        <button type='submit' name='submit'>Créer le billet</button>

    </form>
    
    ";
}else{
    echo "<p>Vous devez vous</p><a href='/accueil'>connecter </a> pour poster un billet </p>";
} ?>