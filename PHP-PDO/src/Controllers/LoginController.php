<?php

namespace App\Controllers;

use AltoRouter;
use App\Repositories\UserRepository;
use eftec\bladeone\BladeOne;

class LoginController
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
        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        echo $this->blade->run("login", ["erro" => $erro, "mensagem" => $mensagem]);
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

            $_SESSION["usuario"] = [
                "id"    => $usuario->id,
                "nome"  => $usuario->nome,
                "email" => $usuario->email
            ];

            header("Location: " . $this->router->generate("dashboard"));

            return;
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("login"));
        }
    }

    public function sair()
    {
        $_SESSION = [];
        session_destroy();

        session_start();
        $_SESSION["mensagem_flash"] = "Você saiu do sistema com sucesso. Volte sempre!";

        header("Location: " . $this->router->generate("login"));
        exit;
    }
}
