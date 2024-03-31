<?php
class ConnexionBD
{
    private static $servername = "localhost";
    private static $username = 'root';
    private static $password = '';
    private static $dbname = "if0_36253541_glicious";
    private static $_bdd = null;
    private function __construct()
  {
    try {
      self::$_bdd = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password,    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }
  public static function getInstance()
  {
    if (!self::$_bdd) {
      new ConnexionBD();
    }
    return (self::$_bdd);
  }
}
?>