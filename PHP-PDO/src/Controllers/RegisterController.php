<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\User;
use App\Repositories\UserRepository;
use eftec\bladeone\BladeOne;

class RegisterController
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
        echo $this->blade->run("cadastro", []);
    }

    public function cadastrar()
    {
        try {
            $nome = $_POST["nome"] ?? null;
            $email = $_POST["email"] ?? null;
            $senha = $_POST["senha"] ?? null;
            $confirmarSenha = $_POST["confirmarSenha"] ?? null;

            if ($senha != $confirmarSenha) {
                echo $this->blade->run("cadastro", ["erro" => "Os campos Senha e Confirmar Senha precisam ser iguais."]);
                return;
            }

            $usuario = new User($nome, $email, $senha);
            $usuario->ehvalido();

            $repo = new UserRepository();
            $repo->verificarEmail($usuario->email);
            $repo->salvar($usuario);

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["usuario"] = [
                "id"    => $usuario->id,
                "nome"  => $usuario->nome,
                "email" => $usuario->email
            ];

            header("Location: " . $this->router->generate("dashboard"));
        } catch (\Exception $e) {
            echo $this->blade->run("cadastro", ["erro" => $e->getMessage()]);
            return;
        }
    }
}
