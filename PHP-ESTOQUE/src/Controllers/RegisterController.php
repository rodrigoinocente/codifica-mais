<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\User;
use App\Repositories\UserRepository;

class RegisterController
{
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/cadastro.php';
    }

    public function cadastrar()
    {
        try {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

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
            $usuario->ehvalido();

            $repo = new UserRepository();
            $repo->verificarEmail($usuario->email);
            $usuarioId = $repo->salvar($usuario);

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
