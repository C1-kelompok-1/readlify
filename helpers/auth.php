<?php

require 'session.php';
require 'helpers/base.php';

if (!function_exists('getLoginUser')) {
  function getLoginUser() {
    if (isset($_SESSION['user'])) {
      return $_SESSION['user'];
    }
    
    return null;
  }
}

if (!function_exists('redirectIfAuthenticated')) {
  function redirectIfAuthenticated($path) {
    if (isset($_SESSION['user'])) {
      redirect($path);
      die;
    }
  }
}

if (!function_exists('redirectIfNotAuthenticated')) {
  function redirectIfNotAuthenticated($path) {
    if (!isset($_SESSION['user'])) {
      redirect($path);
      die;
    }
  }
}