<?php

$hostname = 'localhost';
$database = 'readify';
$username = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
} catch (PDOException $error) {
  die("Koneksi ke database gagal: " . $error);
}

if (!function_exists('fetchAll')) {
  /**
   * 
   * Fungsi ini buat ngambil banyak data.
   * 
   */
  function fetchAll(string $query, array $params = []) {
    global $conn;
  
    $stmt = $conn->prepare($query);
  
    $rows = [];
  
    if ($stmt->execute($params) && $stmt->rowCount()) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
      }
    }
  
    return $rows;
  }
}

if (!function_exists('fetchOne')) {
  /**
   * 
   * Fungsi ini buat ngambil satu data aja.
   * 
   */
  function fetchOne(string $query, array $params = []) {
    global $conn;
  
    $stmt = $conn->prepare($query);
  
    if ($stmt->execute($params) && $stmt->rowCount()) {
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  
    return null;
  }
}

if (!function_exists('query')) {
  /**
   * 
   * Fungsi ini bisa dipake untuk insert, update, dan delete.
   * 
   */
  function query(string $query, array $params = []) {
    global $conn;
    
    $stmt = $conn->prepare($query);

    if ($stmt->execute($params)) {
      return $conn->lastInsertId();
    }

    throw new PDOException('', $conn->errorCode());
  }
}

if (!function_exists('getDataType')) {
  /**
   * 
   * Mengecek jenis tipe data dari suatu data dan mengembalikannya menjadi tipe data PDO.
   * 
   */
  function getDataType($data) {
    $type = null;
  
    if (gettype($data) == 'string') $type = PDO::PARAM_STR;
    else if (gettype($data) == 'integer') $type = PDO::PARAM_INT;
    else if (gettype($data) == 'double') $type = PDO::PARAM_INT;
    else if (gettype($data) == 'boolean') $type = PDO::PARAM_BOOL;
    else $type = PDO::PARAM_NULL;
  
    return $type;
  }
}

if (!function_exists('beginTransaction')) {
  function beginTransaction() {
    global $conn;
    $conn->beginTransaction();
  }
}

if (!function_exists('commit')) {
  function commit() {
    global $conn;
    $conn->commit();
  }
}

if (!function_exists('rollBack')) {
  function rollBack() {
    global $conn;
    $conn->rollBack();
  }
}