<?php 

class Database {

  private $connection;
  private static $instance;

  private function __construct() {
    $this->connection = new mysqli('localhost', 'root', '', 'webstore');

    if ($this->connection->connect_error)
      die("Connection failed: " . $this->connection->connect_error);
  }

  private static function get_instance() {
    self::$instance = new Database();
    return self::$instance;
  }

  public static function get_connection() {
    return self::get_instance()->connection;
  }
}

?>