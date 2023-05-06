<?php

require 'session.php';

if (!function_exists('setInputError')) {
  function setInputError(string $name, string $message) {
    if (!isset($_SESSION['input_errors'][$name])) {
      $_SESSION['input_errors'][$name] = $message;
    }
  }
}

if (!function_exists('getInputError')) {
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
  function setOldInputs() {
    foreach ($_POST as $name => $value) {
      $_SESSION['old_input'][$name] = $value;
    }
  }
}

if (!function_exists('getOldInput')) {
  function getOldInput(string $name, $default = null) {
    if (isset($_SESSION['old_input'][$name])) {
      $oldInput = $_SESSION['old_input'][$name];
      unset($_SESSION['old_input'][$name]);
      return $oldInput;
    }

    return $default;
  }
}

if (!function_exists('isThereAnyError')) {
  function isThereAnyError() {
    return isset($_SESSION['input_errors']) && count($_SESSION['input_errors']);
  }
}