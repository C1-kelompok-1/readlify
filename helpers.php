<?php

require 'session.php';

if (!function_exists('getPageName')) {
  function getPageName() {
    $segments = explode('/', $_SERVER['REQUEST_URI']);
    foreach ($segments as $segment) {
      if (str_contains($segment, '.php')) {
        return $segment;
      }
    }
  
    return null;
  }
}

if (!function_exists('getLoginUser')) {
  function getLoginUser() {
    if (isset($_SESSION['login_user'])) {
      return $_SESSION['login_user'];
    }
    
    return null;
  }
}

if (!function_exists('roles')) {
  function roles($role) {
    $user = getLoginUser();
    return $user['role'] == $role;
  }
}

if (!function_exists('alert')) {
  function alert($message) {
    echo "<script>alert('$message')</script>";
  }
}

if (!function_exists('redirect')) {
  function redirect($path) {
    echo "<script>";
    echo "window.location = '$path';";
    echo "</script>";
    die;
  }
}

if (!function_exists('checkAuthenticated')) {
  function checkAuthenticated() {
    if (!isset($_SESSION['logged_account'])) {
      redirect('login.php');
      die;
    }
  }
}

if (!function_exists('checkAuthorized')) {
  function checkAuthorized($roles, $redirectPath = 'errors-403.php') {
    if (!roles($roles)) {
      redirect($redirectPath);
      die;
    }
  }
}

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

if (!function_exists('str_contains')) {
  function str_contains($haystack, $needle) {
    return '' === $needle || false !== strpos($haystack, $needle);
  }
}

if (!function_exists('generateRandomString')) {
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}