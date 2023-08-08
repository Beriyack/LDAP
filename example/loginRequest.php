<?php
session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/../LDAP.php';

$location = 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $ldapUsername = htmlentities($_POST['username']);
        $ldapPassword = htmlentities($_POST['password']);
        $ldapUserDomain = $ldapUsername . '@' . __LDAP_DOMAIN__;
        $ldap = new LDAP(__LDAP_SERVER__, __LDAP_PORT__);
        $connect = $ldap->bind($ldapUserDomain, $ldapPassword);

        if ($connect) {
            $_SESSION['err']['actif'] = false;
            $_SESSION['err']['message'] = 'Connexion réussi';
            $_SESSION['auth'] = true;
        } else {
            $_SESSION['err']['actif'] = true;
            $_SESSION['err']['message'] = 'Vérifiez les informations envoyés.';
            $_SESSION['auth'] = false;
            $location = 'login.php';
        }

        $ldap->close();
    }
}

header('Location: ' . $location);