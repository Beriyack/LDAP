<?php 
    require_once __DIR__ . '/../config/app.php';

    $ping = fsockopen(__LDAP_DOMAIN__, 80, $error_code, $error_message, 10);
    fclose($ping);
?>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                <li><a href="search.php">Recherche</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="login.php">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <h1>Configuration</h1>
    <p>
        Serveur : <?= __LDAP_SERVER__ ?><br>
        Port : <?= __LDAP_PORT__ ?><br>
        Domaine : <?= __LDAP_DOMAIN__ ?><br>
        Ping : <?= $ping ? "En ligne" : "Hors ligne"; ?><br>
        Extension LDAP : <?= extension_loaded('ldap') ? 'Activé' : 'Désactivé'; ?>
    </p>