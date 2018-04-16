<?php
  class Connexion
  {
    private static $pdo;

    public static function getConnection(){
      if (Connexion::$pdo) {
        return Connexion::$pdo;
      }
      $chaineConnection = SGBD.':dbname='.NOM_BD.';host='.NOM_HOTE_BD . ";charset = utf8";
      try {
        Connexion::$pdo = new PDO($chaineConnection, NOM_USAGER_BD, MDP_USAGER_BD);
      } catch (PDOException $e) {
        print("NON!");
      }
      return Connexion::$pdo;
    }
  }
 ?>
