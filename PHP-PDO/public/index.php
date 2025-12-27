<?php
require __DIR__ . "/../vendor/autoload.php";
session_start();

use eftec\bladeone\BladeOne;
use AltoRouter;
use App\Middlewares\AuthMiddleware;

$router = new AltoRouter();
$blade = new BladeOne(__DIR__ . "/../views", __DIR__ . "/../views/cache", BladeOne::MODE_AUTO);
$blade->share(["router" => $router]);

require __DIR__ . "/../src/Routes/web.php";

$match = $router->match();
if ($match) {
    $rotasProtegidas = ["dashboard"];
    if (in_array($match["name"], $rotasProtegidas)) {
        AuthMiddleware::verificacao($router);
    }

    [$controller, $metodo] = explode("@", $match["target"]);
    $classeController = "App\\Controllers\\" . $controller;
    $controller = new $classeController($blade, $router);
    $controller->$metodo();
} else {
    echo "Página não encontrada!";
}
