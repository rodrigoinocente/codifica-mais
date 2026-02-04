<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Categorias;
use App\Repositories\CategoriasRepository;
use Exception;

class CategoriasController
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

            $cor = new Categorias($usuarioId, $nome);
            $cor->ehvalido();
            $repoCategorias = new CategoriasRepository();

            if ($repoCategorias->exiteNomeCategoria($cor->nome, $cor->usuario_id)) {
                throw new Exception("Categoria $cor->nome já está cadastrada.");
            }

            $repoCategorias->salvar($cor);

            $_SESSION["mensagem_flash"] = "Categoria cadastrada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($categoriaId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoCategoria = new CategoriasRepository();
            $repoCategoria->existeIdCategoria((int) $categoriaId, $usuarioId);
            $repoCategoria->excluirCategoria((int) $categoriaId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Categoria excluida com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($categoriaId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoCategoria = new CategoriasRepository();
            $repoCategoria->existeIdCategoria((int) $categoriaId, $usuarioId);
            $repoCategoria->recuperarCategoria((int) $categoriaId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Categoria recuperada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
