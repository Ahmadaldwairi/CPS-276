<?php

class Db_conn {

  private $conn;

  public function dbOpen() {
    try {
      $dbHost = 'localhost';
      $dbName = 'aaldwairi'; 
      $dbUsr = 'aaldwairi';     

      $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsr, null);

      $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
      $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
      $this->conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $this->conn;

    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return null;
    }
  }
}
?>



