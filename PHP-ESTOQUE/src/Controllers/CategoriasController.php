<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Categorias;
use App\Repositories\CategoriasRepository;

class CategoriasController
{
    private AltoRouter $router;
    private CategoriasRepository $repoCategorias;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
        $this->repoCategorias = new CategoriasRepository();
    }

    public function cadastrar(): void
    {
      try {
        $nome = $_POST["nome"] ?? null;
        $usuarioId = $_SESSION['usuario']['id'];

        $categoria = new Categorias($usuarioId, $nome);
        $categoriaValida = $categoria->ehvalido();
        if ($categoriaValida['erro']) {
          $_SESSION["mensagem_erro_flash"] = $categoriaValida['mensagem'];
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $nomeExiste = $this->repoCategorias->exiteNomeCategoria($categoria->nome, $categoria->usuario_id);
        if ($nomeExiste) {
          $_SESSION["mensagem_erro_flash"] = 'Já exite uma categoria com esse nome';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoCategorias->salvar($categoria);

        $_SESSION["mensagem_flash"] = "Categoria cadastrada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function excluir($categoriaId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $categoria = $this->repoCategorias->existeIdCategoria((int) $categoriaId, $usuarioId);
        if (!$categoria) {
          $_SESSION["mensagem_erro_flash"] = 'Categoria não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoCategorias->excluirCategoria((int) $categoriaId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Categoria excluida com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function recuperar($categoriaId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $categoria = $this->repoCategorias->existeIdCategoria((int) $categoriaId, $usuarioId);
        if (!$categoria) {
          $_SESSION["mensagem_erro_flash"] = 'Categoria não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoCategorias->recuperarCategoria((int) $categoriaId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Categoria recuperada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }
}
