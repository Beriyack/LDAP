<?php
session_start();
require_once '../LDAP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ldapDomain = $_POST['domain'];
    $ldapUser = $_POST['username'];
    $ldapUserDomain = $ldapUser . '@' . $ldapDomain;
    $ldapPass = $_POST['password'];

    $ldap = new LDAPConnection(__LDPA_SERVER__, __LDPA_PORT__);
    $result = $ldap->bind($ldapUserDomain, $ldapPass);

    $location = '';
    if ($result) {
        $location = 'Location: profile.php';
        $_SESSION['auth'] = true;
    } else {
        $location = 'Location: login.php?err=Vérifiez les informations envoyés.';
        $_SESSION['err'] = [
            'domain' => $ldapDomain,
            'username' => $ldapUser,
            'password' => $ldapPass
        ];
    }

    $ldap->close();
    header($location);
}
