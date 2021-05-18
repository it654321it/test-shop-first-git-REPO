<?php 
error_reporting(E_ALL);
session_start();
require ROOT . '/app/Autoloader.php';
require ROOT . '/app/etc/config.php'; 
Autoloader::register();
\Core\App::run();
