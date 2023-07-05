<?php
session_start();
require_once '../config/config.php';
require_once '../../LDAP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ldapUser = $_POST['username'];
    $ldapUserDomain = $ldapUser . '@' . __LDAP_DOMAIN__;
    $ldapPass = $_POST['password'];

    $ldap = new LDAPConnection(__LDAP_SERVER__, __LDAP_PORT__);
    $connect = $ldap->bind($ldapUserDomain, $ldapPass);

    $location = '';
    if ($connect) {
        $location = 'Location: ../index.php';

        $filter = "(|(uid=$ldapUser))";
        $search = $ldap->search('dc=orif,dc=lan', $filter);
        var_dump($search);
        $_SESSION['auth'] = [
            "connected" => true,
            "account" => $search
        ];
    } else {
        $location = 'Location: ../login.php?err=Vérifiez les informations envoyés.';
        $_SESSION['err'] = [
            'username' => $ldapUser,
        ];
    }

    $ldap->close();
    // header($location);
}