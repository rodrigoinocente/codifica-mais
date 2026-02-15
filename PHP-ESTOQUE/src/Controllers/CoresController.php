<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Cores;
use App\Repositories\CoresRepository;
use App\Service\LogService;

class CoresController
{
  private AltoRouter $router;
  private CoresRepository $repoCores;

  public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->repoCores = new CoresRepository();
    }

    public function cadastrar(): void
    {
      try {
        $nome = $_POST["nome"] ?? null;
        $usuarioId = $_SESSION['usuario']['id'];

        $cor = new Cores($usuarioId, $nome);
        $corValida = $cor->ehvalido();
        if ($corValida['erro']) {
          $_SESSION["mensagem_erro_flash"] = $corValida['mensagem'];
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $nomeExiste = $this->repoCores->ExisteNomeCor($cor->nome, $cor->usuario_id);
        if ($nomeExiste) {
          $_SESSION["mensagem_erro_flash"] = 'Já exite uma cor com esse nome';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }
        $this->repoCores->salvar($cor);

        $_SESSION["mensagem_flash"] = "Cor cadastrada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        LogService::registrarErro($e);
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }
    }

    public function excluir($corId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $cor = $this->repoCores->existeIdCor((int) $corId, $usuarioId);
        if (!$cor) {
          $_SESSION["mensagem_erro_flash"] = 'Cor não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoCores->excluirCor((int) $corId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Cor excluida com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
      } catch (\Exception $e) {
        LogService::registrarErro($e);
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
      }
    }

    public function recuperar($corId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $cor = $this->repoCores->existeIdCor((int) $corId, $usuarioId);
        if (!$cor) {
          $_SESSION["mensagem_erro_flash"] = 'Cor não localizada';
          header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
        }

        $this->repoCores->recuperarCor((int) $corId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Cor recuperada com sucesso.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      } catch (\Exception $e) {
        LogService::registrarErro($e);
        $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
        header("Location: " . $this->router->generate("cadastro-propriedade"));
          return;
      }
    }
}
