<?php

require 'session.php';
require 'helpers/base.php';

session_destroy();
redirect('login.php');
die;