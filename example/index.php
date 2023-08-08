<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - Exemple LDAP</title>
    </head>
    <body>
        <?php require_once __DIR__ . '/shared/header.php'; ?>
            <h1>Accueil</h1>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                <p>Vous êtes connecté</p>
            <?php else: ?>
                <p>Vous êtes déconnecté</p>
            <?php endif; ?>
        <?php require_once __DIR__ . '/shared/footer.php'; ?>
    </body>
</html>