<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . "/config/config.php";

// Class Databse
class  Database
{
  public $pdo;

  // Construct Class
  public function __construct()
  {

    if (!isset($this->pdo)) {
      try {
        $link = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASS);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo  =  $link;
      } catch (PDOException $e) {
        die("Connection error..." . $e->getMessage());
      }
    }
  }
}
