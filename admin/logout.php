<?php

require 'session.php';
require 'helpers/alert.php';

session_destroy();

unset($_COOKIE['readify_remember']);
setcookie('readify_remember', '', time() - 3600, '/');

header('Location: ../login.php');
die;