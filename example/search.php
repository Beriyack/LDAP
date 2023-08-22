<?php
    session_start();
    if (!isset($_SESSION['auth'])) {
        header('Location: login.php');
    }
    $contenu = array();
    $username = "";
    require_once __DIR__ . '/config/config.php';
    require_once __DIR__ . '/../LDAP.php';
    if (isset($_GET['username'])) {
        // $attributes = ['mail'];
        $username = htmlentities($_GET['username']);
        $filter = "(&(objectCategory=user)(samAccountName=*$username*))";

        $ldap = new LDAP(__LDAP_SERVER__, __LDAP_PORT__);
        $ldap->bind(__LDAP_ACCOUNT__ . '@' . __LDAP_DOMAIN__, __LDAP_PASSWORD__);
        $contenu = $ldap->search(__LDAP_DN__, $filter);
        $ldap->close();
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rechercher - Exemple LDAP</title>
    </head>
    <body>
        <?php require_once __DIR__ . '/shared/header.php'; ?>
            <h1>Recherche</h1>
            <form action="search.php" method="get">
                <!-- <input type="text" name="group" id="group" placeholder="Nom d'un groupe"> -->
                <label for="username">Nom de connexion :</label>
                <input type="text" name="username" id="username" value="<?= $username ?>" placeholder="Nom de connexion">
                <!-- <input type="text" name="samaccount" id="username" placeholder="Nom d'un utilisateur"> -->
                <!-- <input type="text" name="username" id="username" placeholder="Nom d'un utilisateur"> -->
                <button type="submit">Rechercher</button>
            </form>
            <pre><?php var_dump($contenu); ?></pre>
        <?php require_once __DIR__ . '/shared/footer.php'; ?>
    </body>
</html>