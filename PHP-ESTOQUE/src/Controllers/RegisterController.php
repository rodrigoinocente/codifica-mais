<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\User;
use App\Repositories\UserRepository;

class RegisterController
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
      $mensagem = $_SESSION["mensagem_flash"] ?? null;
      unset($_SESSION["mensagem_erro_flash"]);
      unset($_SESSION["mensagem_flash"]);

      require __DIR__ . '/../Views/cadastro.php';
      return;
  }

  public function cadastrar(): void
  {
    try {
      $nome = $_POST["nome"] ?? null;
      $email = $_POST["email"] ?? null;
      $senha = $_POST["senha"] ?? null;
      $confirmarSenha = $_POST["confirmarSenha"] ?? null;

      if ($senha != $confirmarSenha) {
        $_SESSION["mensagem_erro_flash"] = "Os campos Senha e Confirmar Senha precisam ser iguais.";
        header("Location: " . $this->router->generate("cadastro"));
        return;
      }

      $usuario = new User($nome, $email, $senha);

      $usuarioValido = $usuario->ehvalido();
      if ($usuarioValido['erro']) {
        $_SESSION["mensagem_erro_flash"] = $usuarioValido['mensagem'];
        header("Location: " . $this->router->generate("cadastro"));
        return;
      }

      $emailExiste = $this->repoUsuario->verificarEmail($usuario->email);
      if ($emailExiste) {
        $_SESSION["mensagem_erro_flash"] = 'E-mail já cadastrado.';
        header("Location: " . $this->router->generate("cadastro"));
        return;
      }

      $usuarioId = $this->repoUsuario->salvar($usuario);

      $_SESSION["usuario"] = [
        "id"    => $usuarioId,
        "nome"  => $usuario->nome,
        "email" => $usuario->email
      ];

      $_SESSION["mensagem_flash"] = "Boas Vindas, $usuario->nome";
      header("Location: " . $this->router->generate("dashboard"));
      return;
    } catch (\Exception $e) {
      $_SESSION["mensagem_erro_flash"] = $e->getMessage();
      header("Location: " . $this->router->generate("cadastro"));
      return;
    }
  }
}
