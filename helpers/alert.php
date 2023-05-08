<?php

require 'session.php';

if (!function_exists('setAlert')) {
  /**
   * 
   * Buat alert.
   * 
   */
  function setAlert(string $type, string $message) {
    $_SESSION['alert'] = compact('message', 'type');
  }
}

if (!function_exists('getAlert')) {
  /**
   * 
   * Panggil alert.
   * 
   */
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