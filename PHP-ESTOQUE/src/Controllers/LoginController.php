<?php

namespace App\Controllers;

use AltoRouter;
use App\Repositories\UserRepository;

class LoginController
{
    private AltoRouter $router;
    private UserRepository $repoUsuario;

    public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->repoUsuario = new UserRepository();
    }

    public function index(): void
    {
      $erro = $_SESSION["mensagem_erro_flash"] ?? null;
      unset($_SESSION["mensagem_erro_flash"]);

      $mensagem = $_SESSION["mensagem_flash"] ?? null;
      unset($_SESSION["mensagem_flash"]);

      require __DIR__ . '/../Views/login.php';
      return;
    }

    public function logar(): void
    {
      try {
        $email = $_POST["email"] ?? "";
        $senha = $_POST["senha"] ?? "";

        $usuario = $this->repoUsuario->buscarUsuarioPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
          $_SESSION["mensagem_erro_flash"] = 'E-mail ou senha inválidos.';
          header("Location: " . $this->router->generate('login'));
          return;
        }

        $_SESSION["usuario"] = [
            "id"    => $usuario['id'],
            "nome"  => $usuario['nome'],
            "email" => $usuario['email']
        ];

        $_SESSION["mensagem_flash"] = "Boas Vindas, {$usuario['nome']}";
        header("Location: " . $this->router->generate('dashboard'));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Tivemos um erro. Tente novamente.";
        require __DIR__ . '/../Views/login.php';
        return;
      }
    }

    public function sair(): void
    {
      $_SESSION = [];
      session_destroy();

      session_start();
      $_SESSION["mensagem_flash"] = "Você saiu do sistema com sucesso. Volte sempre!";

      header("Location: " . $this->router->generate('login'));
      return;
    }
}
