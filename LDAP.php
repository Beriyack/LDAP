<?php
class LDAPConnection {
    private $ldapConn;

    /**
     * Constructeur de la classe LDAPConnection.
     *
     * @param string $ldapServer Adresse du serveur LDAP
     * @param int $ldapPort Port du serveur LDAP
     */
    public function __construct($ldapServer, $ldapPort) {
        $this->ldapConn = ldap_connect($ldapServer, $ldapPort);
        // Spécifie le protocole LDAP à utiliser (V2 ou V3). V3
        ldap_set_option($this->ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
        // Indique s'il faut suivre automatiquement les références renvoyées par le serveur LDAP. False
        ldap_set_option($this->ldapConn, LDAP_OPT_REFERRALS, 0);
    }

    /**
     * Effectue la liaison (bind) avec le serveur LDAP.
     *
     * @param string $ldapUser Nom d'utilisateur LDAP
     * @param string $ldapPass Mot de passe LDAP
     * @return bool Résultat de la liaison
     */
    public function bind($ldapUser, $ldapPass): bool {
        return ldap_bind($this->ldapConn, $ldapUser, $ldapPass);
    }

    /**
     * Recherche des entrées dans l'annuaire LDAP.
     *
     * @param string $baseDN Base DN pour la recherche
     * @param string $filter Filtre de recherche
     * @param array $attributes Attributs à retourner
     * @return array Résultat de la recherche
     */
    public function search($baseDN, $filter, $attributes = []): array|false {
        $result = ldap_search($this->ldapConn, $baseDN, "(|(sn=brouillard*)(givenname=brouillard*))", $attributes);
        var_dump($result);
        return ldap_get_entries($this->ldapConn, $result);
    }

    /**
     * Récupère une entrée spécifique dans l'annuaire LDAP.
     *
     * @param string $dn DN de l'entrée à récupérer
     * @param array $attributes Attributs à retourner
     * @return array Résultat de la lecture de l'entrée
     */
    public function getEntry($dn, $attributes = []) {
        $result = ldap_read($this->ldapConn, $dn, "(objectClass=*)", $attributes);
        return ldap_get_entries($this->ldapConn, $result);
    }

    /**
     * Ajoute une nouvelle entrée à l'annuaire LDAP.
     *
     * @param string $dn DN de l'entrée à ajouter
     * @param array $entry Données de l'entrée à ajouter
     * @return bool Résultat de l'opération d'ajout
     */
    public function addEntry($dn, $entry) {
        return ldap_add($this->ldapConn, $dn, $entry);
    }

    /**
     * Supprime une entrée de l'annuaire LDAP.
     *
     * @param string $dn DN de l'entrée à supprimer
     * @return bool Résultat de l'opération de suppression
     */
    public function deleteEntry($dn) {
        return ldap_delete($this->ldapConn, $dn);
    }

    /**
     * Modifie une entrée dans l'annuaire LDAP.
     *
     * @param string $dn DN de l'entrée à modifier
     * @param array $entry Données de l'entrée modifiée
     * @return bool Résultat de le succès ou l'échec de l'opération de modification.
     */
    public function modifyEntry($dn, $entry) {
        return ldap_modify($this->ldapConn, $dn, $entry);
    }

    /**
     * Ferme la connexion LDAP
     */
    public function close() {
        ldap_unbind($this->ldapConn);
    }
}
