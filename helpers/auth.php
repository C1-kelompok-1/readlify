<?php

require 'session.php';

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