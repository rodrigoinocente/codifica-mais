<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Generos;
use App\Repositories\GenerosRepository;

class GenerosController
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

            $genero = new Generos($usuarioId, $nome);
            $genero->ehvalido();
            $repoGeneros = new GenerosRepository();

            if ($repoGeneros->existeNomeGenero($genero->nome, $genero->usuario_id)) {
                throw new \Exception("Gênero $genero->nome já está cadastrado.");
            }

            $repoGeneros->salvar($genero);

            $_SESSION["mensagem_flash"] = "Gênero cadastrado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($generoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoGenero = new GenerosRepository();
            $repoGenero->existeIdGenero((int) $generoId, $usuarioId);
            $repoGenero->excluirGenero((int) $generoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Gênero excluido com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($generoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoGenero = new GenerosRepository();
            $repoGenero->existeIdGenero((int) $generoId, $usuarioId);
            $repoGenero->repucperarGenero((int) $generoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Gênero recuperado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
