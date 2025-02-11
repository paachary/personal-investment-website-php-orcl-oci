<?php

require 'helpers.php';

spl_autoload_register(function ($class) {
  $path = basePath('framework/' . $class . '.php');

  if (file_exists($path)) {
    require($path);
  }

  $path = basePath('framework/middleware/' . $class . '.php');

  if (file_exists($path)) {
    require($path);
  }

  $path = basePath('controllers/' . $class . '.php');

  if (file_exists($path)) {
    require($path);
  }
});

Session::start();

$router = new Router();

require basePath('routes.php');

$routes = require basePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];

$router->route($uri);
