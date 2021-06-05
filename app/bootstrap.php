<?php 
error_reporting(E_ALL);
session_start();
//$_SESSION['id'] = 111111111;
require ROOT . '/app/Autoloader.php';
require ROOT . '/app/etc/config.php'; 
Autoloader::register();
\Core\App::run();
