   <?php
    echo $_SESSION['username'];
    
   ?>
   <form method="POST" action="accueil">
    <button type="submit" name="logoff">se déconnecter</button>
    </form>
    <a href="/billet">Voir tous les billets</a>
    <?php
    if($_SESSION['rank'] === 2){
        echo "<a href='/admin'>Admin</a>";
    }
    if($_SESSION['block'] === 1){
        echo "<p>Votre compte est bloqué</p>";
    }

    ?>
