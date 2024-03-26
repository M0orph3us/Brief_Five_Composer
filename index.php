<?php

use app\router\Router;

require __DIR__ . '/./vendor/autoload.php';
$uri = $_SERVER['REQUEST_URI'];
Router::route($uri);
