<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Marcas;
use App\Repositories\MarcasRepository;

class MarcasController
{
    private AltoRouter $router;
    private MarcasRepository $repoMarcas;

    public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->repoMarcas = new MarcasRepository();
    }

    public function cadastrar(): void
    {
      try {
        $nome = $_POST["nome"] ?? null;
        $usuarioId = $_SESSION['usuario']['id'];

        $marca = new Marcas($usuarioId, $nome);
        $marcaValida = $marca->ehvalido();
        if ($marcaValida['erro']) {
          $_SESSION["mensagem_erro_flash"] = $marcaValida['mensagem'];
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $nomeExiste = $this->repoMarcas->existeNomeMarca($marca->nome, $marca->usuario_id);
        if ($nomeExiste) {
          $_SESSION["mensagem_erro_flash"] = 'Já exite uma marca com esse nome';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoMarcas->salvar($marca);

        $_SESSION["mensagem_flash"] = "Marca cadastrada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function excluir($marcaId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $marca = $this->repoMarcas->existeIdMarca((int) $marcaId, $usuarioId);
        if (!$marca) {
          $_SESSION["mensagem_erro_flash"] = 'Marca não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoMarcas->excluirMarca((int) $marcaId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Marca excluida com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function recuperar($marcaId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $marca = $this->repoMarcas->existeIdMarca((int) $marcaId, $usuarioId);
        if (!$marca) {
          $_SESSION["mensagem_erro_flash"] = 'Marca não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoMarcas->recuperarMarca((int) $marcaId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Marca recuperada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
      return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

}
