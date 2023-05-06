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
  function setAlert($type, $message) {
    $_SESSION['alert'] = compact('message', 'type');
  }
}

if (!function_exists('alert')) {
  function getAlert() {
    if (isset($_SESSION['alert'])) {
      $type =  $_SESSION['alert']['type'];
      $message =  $_SESSION['alert']['message'];

      unset($_SESSION['alert']);

      return "<div class=\"alert alert-$type\">$message</div>";
    }

    return null;
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