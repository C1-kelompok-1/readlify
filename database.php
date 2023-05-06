<?php

$hostname = 'localhost';
$database = 'readify';
$username = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
} catch (PDOException $error) {
  die("Koneksi ke database gagal: " . $conn->errorInfo());
}

/**
 * 
 * Fungsi ini buat ngambil banyak data.
 * 
 */
function fetchAll(string $query, array $params = []) {
  global $conn;

  $stmt = $conn->prepare($query);

  foreach ($params as $param => $value) {  
    $stmt->bindParam(':'.$param, $value, getDataType($value));
  }

  $rows = [];

  if ($stmt->execute() && $stmt->rowCount()) {
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
  }

  return $rows;
}

/**
 * 
 * Fungsi ini buat ngambil satu data aja.
 * 
 */
function fetchOne(string $query, array $params = []) {
  global $conn;

  $stmt = $conn->prepare($query);

  foreach ($params as $param => $value) {
    $stmt->bindParam(':'.$param, $value, getDataType($value));
  }

  if ($stmt->execute() && $stmt->rowCount()) {
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return null;
}

/**
 * 
 * Fungsi ini bisa dipake untuk insert, update, dan delete.
 * 
 */
function query(string $query, array $params = []) {
  global $conn;
  
  $stmt = $conn->prepare($query);

  if ($stmt->execute($params) && $stmt->rowCount()) {
    return $conn->lastInsertId();
  }

  throw new PDOException('', $conn->errorCode());
}

function getDataType($data) {
  $type = null;

  if (gettype($data) == 'string') $type = PDO::PARAM_STR;
  else if (gettype($data) == 'integer') $type = PDO::PARAM_INT;
  else if (gettype($data) == 'double') $type = PDO::PARAM_INT;
  else if (gettype($data) == 'boolean') $type = PDO::PARAM_BOOL;
  else $type = PDO::PARAM_NULL;

  return $type;
}

function beginTransaction() {
  global $conn;
  $conn->beginTransaction();
}

function commit() {
  global $conn;
  $conn->commit();
}

function rollBack() {
  global $conn;
  $conn->rollBack();
}