<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Tamanhos;
use App\Repositories\TamanhosRepository;

class TamanhosController
{
    private AltoRouter $router;
    private TamanhosRepository $repoTamanhos;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
        $this->repoTamanhos = new TamanhosRepository();
    }

    public function cadastrar(): void
    {
      try {
        $nome = $_POST["nome"] ?? null;
        $usuarioId = $_SESSION['usuario']['id'];

        $tamanho = new Tamanhos($usuarioId, $nome);
        $tamanhoValido = $tamanho->ehvalido();
        if ($tamanhoValido['erro']) {
          $_SESSION["mensagem_erro_flash"] = $tamanhoValido['mensagem'];
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $nomeExiste = $this->repoTamanhos->existeNomeTamannho($tamanho->nome, $tamanho->usuario_id);
        if ($nomeExiste) {
          $_SESSION["mensagem_erro_flash"] = 'Já exite um tamanho com esse nome';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoTamanhos->salvar($tamanho);

        $_SESSION["mensagem_flash"] = "Tamanho cadastrado com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function excluir($tamanhoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $tamanho = $this->repoTamanhos->existeIdTamanho((int) $tamanhoId, $usuarioId);
        if (!$tamanho) {
          $_SESSION["mensagem_erro_flash"] = 'Tamanho não localizado';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoTamanhos->excluirTamanho((int) $tamanhoId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Tamanho excluido com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function recuperar($tamanhoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $tamanho = $this->repoTamanhos->existeIdTamanho((int) $tamanhoId, $usuarioId);
        if (!$tamanho) {
          $_SESSION["mensagem_erro_flash"] = 'Tamanho não localizado';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoTamanhos->recuperarTamanho((int) $tamanhoId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Tamanho recuperado com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }
}
