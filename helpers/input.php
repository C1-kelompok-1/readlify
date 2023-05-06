<?php

require 'session.php';

if (!function_exists('isThereAnyInputError')) {
  /**
   * 
   * Cek apakah masih ada inputan yang belum lolos validasi.
   * 
   */
  function isThereAnyInputError() {
    return isset($_SESSION['input_errors']) && count($_SESSION['input_errors']);
  }
}

if (!function_exists('setInputError')) {
  /**
   * 
   * Buat menetapkan inputan yang belum lolos validasi.
   * 
   */
  function setInputError(string $name, string $message) {
    if (!isset($_SESSION['input_errors'][$name])) {
      $_SESSION['input_errors'][$name] = $message;
    }
  }
}

if (!function_exists('getInputError')) {
  /**
   * 
   * Buat mengambil inputan yang belum lolos validasi.
   * 
   */
  function getInputError(string $name) {
    if (isset($_SESSION['input_errors'][$name])) {
      $error = '<p class="text-danger">'.$_SESSION['input_errors'][$name].'</p>';
      unset($_SESSION['input_errors'][$name]);
      return $error;
    }

    return null;
  }
}

if (!function_exists('setOldInputs')) {
  /**
   * 
   * Menyimpan semua inputan (semua data dari variabel $_POST) sebagai nilai old.
   * 
   */
  function setOldInputs() {
    foreach ($_POST as $name => $value) {
      $_SESSION['old_input'][$name] = $value;
    }
  }
}

if (!function_exists('getOldInput')) {
  /**
   * 
   * Mengambil inputan old yang tersimpan.
   * 
   */
  function getOldInput(string $name, $default = null) {
    if (isset($_SESSION['old_input'][$name])) {
      $oldInput = $_SESSION['old_input'][$name];
      unset($_SESSION['old_input'][$name]);
      return $oldInput;
    }

    return $default;
  }
}