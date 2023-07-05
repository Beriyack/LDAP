<?php
    $title = 'Accueil';
    require_once './shared/header.php';

    $ping = fsockopen(__LDAP_DOMAIN__, 80, $error_code, $error_message, 10);
    fclose($ping);
?>
    <h1>Bienvenue sur un exemple d'utilisation de la classe LDAP</h1>
    <h3>Fichier de configuration</h3>
    <p>
        Serveur : <?= __LDAP_SERVER__ ?><br>
        Port : <?= __LDAP_PORT__ ?><br>
        Domaine : <?= __LDAP_DOMAIN__ ?><br>
        Ping : <?= $ping ? "En ligne" : "Hors ligne"; ?>
    </p>
    <p>
        Version PHP : <?= phpversion(); ?><br>
        Extension LDAP : <?= extension_loaded('ldap') ? 'Activé' : 'Désactivé'; ?>
    </p>
    <p>
        <?php var_dump($_SESSION); ?>
    </p>
<?php require_once './shared/footer.php'; ?>