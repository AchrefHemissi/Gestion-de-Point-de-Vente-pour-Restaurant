<?php
class Database {
    private static $serveur = 'localhost';
    private static $utilisateur = 'root';
    private static $motdepasse = '';
    private static $base_de_donnees = 'if0_36253541_glicious';
    private static $_con = null;

    private function __construct() {
        self::$_con = new mysqli(self::$serveur, self::$utilisateur, self::$motdepasse, self::$base_de_donnees);
        if (self::$_con->connect_error) {
            die("Connection failed: " . self::$_con->connect_error);
        }
    }

    public static function getInstance() {
        if (!self::$_con) {
            new Database();
        }
        return self::$_con;
    }
}
?>