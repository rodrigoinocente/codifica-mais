<?php
require __DIR__ . "/../vendor/autoload.php";
session_start();
date_default_timezone_set('America/Sao_Paulo');

use App\Middlewares\AuthMiddleware;

$router = new AltoRouter();

require __DIR__ . "/../src/Routes/web.php";

$match = $router->match();
if ($match) {
  $rotasProtegidas = ["dashboard"];
  if (in_array($match["name"], $rotasProtegidas)) {
      AuthMiddleware::verificacao($router);
  }

  [$controller, $metodo] = explode("@", $match["target"]);
  $classeController = "App\\Controllers\\" . $controller;
  $controller = new $classeController($router);

  call_user_func_array([$controller, $metodo], $match['params']);
} else {
  echo "Página não encontrada!";
}
