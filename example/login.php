<?php
    session_start();
    if (isset($_SESSION['auth'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Se connecter - Exemple LDAP</title>
    </head>
    <body>
        <?php require_once __DIR__ . '/shared/header.php'; ?>
            <h1>Connexion</h1>
            <?php if (isset($_SESSION['err']) && $_SESSION['err']['actif'] === true) : ?>
                <p style="color:#C0392B;backgroud-color:#E74C3C;"><?= $_SESSION['err']['message'] ?></p>
            <?php endif; ?>
            <form action="loginRequest.php" method="post">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required="required">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">
                <button type="submit">Se connecter</button>
            </form>
        <?php require_once __DIR__ . '/shared/footer.php'; ?>
    </body>
</html>