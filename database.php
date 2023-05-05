<?php

class Database {
  private $hostname = 'localhost';
  private $database = 'readify';
  private $username = 'root';
  private $password = '';
  
  private $conn;

  public function __construct() {
    try {
      $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
    } catch (PDOException $error) {
      die("Koneksi ke database gagal: " . $this->conn->errorInfo());
    }
  }

  private function getDataType($data) {
    $type = null;
  
    if (gettype($data) == 'string') $type = PDO::PARAM_STR;
    else if (gettype($data) == 'integer') $type = PDO::PARAM_INT;
    else if (gettype($data) == 'double') $type = PDO::PARAM_INT;
    else if (gettype($data) == 'boolean') $type = PDO::PARAM_BOOL;
    else $type = PDO::PARAM_NULL;

    return $type;
  }

  public function fetchAll(string $query, array $params = []) {
    $stmt = $this->conn->prepare($query);
  
    foreach ($params as $param => $value) {  
      $stmt->bindParam(':'.$param, $value, $this->getDataType($value));
    }
  
    $rows = [];
  
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
      }
    }
  
    return $rows;
  }

  public function fetchOne(string $query, array $params = []) {
    $stmt = $this->conn->prepare($query);
  
    foreach ($params as $param => $value) {
      $stmt->bindParam(':'.$param, $value, $this->getDataType($value));
    }
  
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return null;
  }

  /**
   * 
   * Method ini bisa dipake untuk insert, update, dan delete.
   * 
   */
  public function query(string $query, array $params = []) {
    $stmt = $this->conn->prepare($query);
    return $stmt->execute($params) && $stmt->rowCount();
  }
}