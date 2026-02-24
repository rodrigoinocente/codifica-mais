<?php

namespace App\Middlewares;

class AuthMiddleware
{
  public static function verificacao($router): void
  {
    if (!isset($_SESSION["usuario"])) {
      $_SESSION["mensagem_erro_flash"] = "É necessário fazer o login.";
      header("Location: " . $router->generate("login"));
      exit;
    }
  }
}
