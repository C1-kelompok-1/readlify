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

if (!function_exists('getLoggedUser')) {
  function getLoggedUser() {
    if (isset($_SESSION['logged_account'])) {
      return $_SESSION['logged_account'];
    }
    
    return null;
  }
}

if (!function_exists('roles')) {
  function roles($roles) {
    $user = getLoggedUser();
    return in_array($user['role'], $roles);
  }
}

if (!function_exists('getLoginMinutes')) {
  function getLoginMinutes() {
    $user = getLoggedUser();
    return floor(abs(time() - $user['logged_at']) / 60);
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

if (!function_exists('str_contains')) {
  function str_contains($haystack, $needle) {
    return '' === $needle || false !== strpos($haystack, $needle);
  }
}