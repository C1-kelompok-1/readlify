<?php

require 'session.php';
require 'helpers/alert.php';
require 'helpers/auth.php';

session_destroy();

unset($_COOKIE['readify_remember']);
setcookie('readify_remember', '', time() - 3600, '/');

redirect('/login.php');
die;