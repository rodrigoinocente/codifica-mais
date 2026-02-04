<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Tamanhos;
use App\Repositories\TamanhosRepository;

class TamanhosController
{
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function cadastrar()
    {
        try {
            $nome = $_POST["nome"] ?? null;
            $usuarioId = $_SESSION['usuario']['id'];

            $tamanho = new Tamanhos($usuarioId, $nome);
            $tamanho->ehvalido();
            $repoTamanhos = new TamanhosRepository();

            if ($repoTamanhos->existeNomeTamannho($tamanho->nome, $tamanho->usuario_id)) {
                throw new \Exception("Tamanho $nome já está cadastrado.");
            }

            $repoTamanhos->salvar($tamanho);

            $_SESSION["mensagem_flash"] = "Tamanho cadastrado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($tamanhoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoTamanho = new TamanhosRepository();
            $repoTamanho->existeIdTamanho((int) $tamanhoId, $usuarioId);
            $repoTamanho->excluirTamanho((int) $tamanhoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Tamanho excluido com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($tamanhoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoTamanho = new TamanhosRepository();
            $repoTamanho->existeIdTamanho((int) $tamanhoId, $usuarioId);
            $repoTamanho->recuperarTamanho((int) $tamanhoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Tamanho recuperado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
