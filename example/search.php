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
            <form action="<?= __FILE__ ?>" method="get">
                <input type="text" name="group" id="group" placeholder="Nom d'un groupe">
                <input type="text" name="username" id="username" placeholder="Nom d'un utilisateur">
            </form>
        <?php require_once __DIR__ . '/shared/footer.php'; ?>
    </body>
</html>