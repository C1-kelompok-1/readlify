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

if (!function_exists('setAlert')) {
  function setAlert($type, $message) {
    $_SESSION['alert'] = compact('message', 'type');
  }
}

if (!function_exists('getAlert')) {
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