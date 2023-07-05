<?php
    $title = 'Accueil';
    require_once './shared/header.php';
?>
    <h1>Bienvenu sur l'interface LDPA</h1>
    <h3>Fichier de configuration</h3>
    <p>
        Serveur : <?= __LDPA_SERVER__ ?><br>
        Port : <?= __LDPA_PORT__ ?><br>
        Domaine : <?= __LDPA_DOMAIN__ ?>
    </p>
<?php
    require_once './shared/footer.php';
?>