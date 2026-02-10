<?php

namespace App\Controllers;

use AltoRouter;
use App\Repositories\UserRepository;

class LoginController
{
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/login.php';
    }

    public function logar()
    {
        try {
            $email = $_POST["email"] ?? "";
            $senha = $_POST["senha"] ?? "";

            $repo = new UserRepository();
            $usuario = $repo->buscarUsuarioPorEmail($email);
            if (!$usuario || !password_verify($senha, $usuario->senha)) {
                throw new \Exception("E-mail ou senha inválidos.");
            }

            session_start();
            $_SESSION["usuario"] = [
                "id"    => $usuario->id,
                "nome"  => $usuario->nome,
                "email" => $usuario->email
            ];

            $_SESSION["mensagem_flash"] = "Boas Vindas, $usuario->nome";
            header("Location: " . $this->router->generate('dashboard'));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro"));

            require __DIR__ . '/../Views/login.php';
        }
    }

    public function sair()
    {
        $_SESSION = [];
        session_destroy();

        session_start();
        $_SESSION["mensagem_flash"] = "Você saiu do sistema com sucesso. Volte sempre!";

        header("Location: " . $this->router->generate('login'));
        exit;
    }
}
