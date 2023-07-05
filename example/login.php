<?php
    if (isset($_SESSION['auth'])) {
        header('Location: index.php');
    }

    $title = 'Connexion';
    require_once './shared/header.php';
?>
        <h3><?= $title; ?></h3>
        <p>
            Serveur : <?= __LDAP_SERVER__ ?><br>
            Port : <?= __LDAP_PORT__ ?><br>
            Domaine : <?= __LDAP_DOMAIN__ ?>
        </p>
        <form method="POST" action="./Controller/AuthController.php" class="row g-3">
            <?php if (isset($_GET['err'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    <div>
                        <?= $_GET['err'] ?>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

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