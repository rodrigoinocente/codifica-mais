<?php

namespace App\Controllers;

use AltoRouter;
use eftec\bladeone\BladeOne;

class DashboardController
{
    private $blade;
    private $router;

    public function __construct(BladeOne $blade, AltoRouter $router)
    {
        $this->blade = $blade;
        $this->router = $router;
    }

    public function index()
    {
        $usuario = $_SESSION["usuario"];
        echo $this->blade->run("dashboard", ["usuario" => $usuario]);
        return;
    }
}
