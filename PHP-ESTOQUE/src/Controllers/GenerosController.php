<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Generos;
use App\Repositories\GenerosRepository;

class GenerosController
{
    private AltoRouter $router;
    private GenerosRepository $repoGeneros;

    public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->repoGeneros = new GenerosRepository();
    }

    public function cadastrar(): void
    {
      try {
        $nome = $_POST["nome"] ?? null;
        $usuarioId = $_SESSION['usuario']['id'];

        $genero = new Generos($usuarioId, $nome);
        $corValida = $genero->ehvalido();
        if ($corValida['erro']) {
          $_SESSION["mensagem_erro_flash"] = $corValida['mensagem'];
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $nomeExiste = $this->repoGeneros->existeNomeGenero($genero->nome, $genero->usuario_id);
        if ($nomeExiste) {
          $_SESSION["mensagem_erro_flash"] = 'Já exite um nome com esse nome';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoGeneros->salvar($genero);

        $_SESSION["mensagem_flash"] = "Gênero cadastrado com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function excluir($generoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $genero = $this->repoGeneros->existeIdGenero((int) $generoId, $usuarioId);
        if (!$genero) {
          $_SESSION["mensagem_erro_flash"] = 'Gênero não localizado';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoGeneros->excluirGenero((int) $generoId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Gênero excluido com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function recuperar($generoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];
        $genero = $this->repoGeneros->existeIdGenero((int) $generoId, $usuarioId);

        if (!$genero) {
          $_SESSION["mensagem_erro_flash"] = 'Gênero não localizado';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoGeneros->recuperarGenero((int) $generoId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Gênero recuperado com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }
}
