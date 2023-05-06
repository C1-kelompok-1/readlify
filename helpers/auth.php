<?php

require 'database.php';
require 'session.php';
require 'helpers/alert.php';

if (!function_exists('redirect')) {
  /**
   * 
   * Untuk ngarahin ke halaman lain.
   * 
   */
  function redirect($path) {
    echo "<script>";
    echo "window.location = '$path';";
    echo "</script>";
    die;
  }
}

if (!function_exists('getLoginUser')) {
  /**
   * 
   * Ambil data user yang sudah ter-login.
   * 
   */
  function getLoginUser() {
    if (isset($_SESSION['user'])) {
      return $_SESSION['user'];
    }
    return null;
  }
}

if (!function_exists('redirectIfAuthenticated')) {
  /**
   * 
   * Arahkan ke halaman lain kalo sudah ter-login.
   * 
   */
  function redirectIfAuthenticated($path, $checkRemember = true) {
    if ($checkRemember) {
      checkRemember();
    }

    if (isset($_SESSION['user'])) {
      redirect($path);
      die;
    }
  }
}

if (!function_exists('redirectIfNotAuthenticated')) {
  /**
   * 
   * Arahkan ke halaman lain kalo belum login (masih guest).
   * 
   */
  function redirectIfNotAuthenticated($path) {
    if (!isset($_SESSION['user'])) {
      redirect($path);
      die;
    }
  }
}

if (!function_exists('checkRemember')) {
  /**
   * 
   * Cek apakah ada remember me atau tidak.
   * 
   */
  function checkRemember() {
    if (isset($_COOKIE['readify_remember'])) {
      $userId = base64_decode($_COOKIE['readify_remember']);
      $user = fetchOne('SELECT * FROM pengguna WHERE id = :id', [':id' => $userId]);
      $_SESSION['user'] = $user;
    }
  }
}