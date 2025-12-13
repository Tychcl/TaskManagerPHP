<?php
use Classes\Router;
use Classes\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/propel/generated/config.php';

$router = new Router();
$router->addController('Controllers\TaskController');

$request = new Request();
$response = $router->dispatch($request);
$response->send();
?>