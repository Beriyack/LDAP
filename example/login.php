<?php
    if (isset($_SESSION['auth'])) {
        header('Location: index.php');
    }

    $title = 'Connexion';
    require_once './shared/header.php';
?>
        <?php if (isset($_GET['err'])) : ?>
        <p>
            <?= $_GET['err'] ?>
        </p>
        <?php endif; ?>

        <form method="POST" action="./Controller/ldap_login.php" class="row g-3">
            <p>
                Serveur : <?= __LDPA_SERVER__ ?><br>
                Port : <?= __LDPA_PORT__ ?><br>
                Domaine : <?= __LDPA_DOMAIN__ ?>
            </p>

            <div class="col-md-6">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= isset($_SESSION['err']['username']) ? $_SESSION['err']['username'] : ''; ?>" required>
                </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
<?php require_once './shared/footer.php'; ?>