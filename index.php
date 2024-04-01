<?php

use app\router\Router;

session_start();
require __DIR__ . '/./vendor/autoload.php';
require_once __DIR__ . '/./app/config/debug.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_SERVER['REQUEST_URI'];
Router::route($uri);