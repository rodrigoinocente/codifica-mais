<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Segmentos;
use App\Repositories\SegmentosRepository;
use App\Service\LogService;

class SegmentosController
{
  private AltoRouter $router;
  private SegmentosRepository $repoSegmentos;

  public function __construct(AltoRouter $router)
  {
    $this->router = $router;
    $this->repoSegmentos = new SegmentosRepository();
  }

  public function cadastrar(): void
  {
    try {
      $nome = $_POST["nome"] ?? null;
      $usuarioId = $_SESSION['usuario']['id'];

      $segmento = new Segmentos($usuarioId, $nome);
      $segmentoValido = $segmento->ehvalido();
      if ($segmentoValido['erro']) {
        $_SESSION["mensagem_erro_flash"] = $segmentoValido['mensagem'];
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }

      $repoSegmentos = new SegmentosRepository();
      $nomeExiste = $repoSegmentos->existeNomeSegmento($segmento->nome, $segmento->usuario_id);
      if ($nomeExiste) {
        $_SESSION["mensagem_erro_flash"] = 'Já exite um segmento com esse nome';
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }

      $this->repoSegmentos->salvar($segmento);

      $_SESSION["mensagem_flash"] = "Segmento cadastrado com sucesso.";
      header("Location: " . $this->router->generate("cadastro-propriedade"));
      return;
    } catch (\Exception $e) {
      LogService::registrarErro($e);
      $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
      header("Location: " . $this->router->generate("cadastro-propriedade"));
      return;
    }
  }

  public function excluir($segmentoId): void
  {
    try {
      $usuarioId = $_SESSION['usuario']['id'];

      $segmento = $this->repoSegmentos->existeIdSegmento((int) $segmentoId, $usuarioId);
      if (!$segmento) {
        $_SESSION["mensagem_erro_flash"] = 'Segmento não localizado';
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }

      $this->repoSegmentos->excluirSegmento((int) $segmentoId, $usuarioId);

      $_SESSION["mensagem_flash"] = "Segmento excluido com sucesso.";
      header("Location: " . $this->router->generate("cadastro-propriedade"));
      return;
    } catch (\Exception $e) {
      LogService::registrarErro($e);
      $_SESSION["mensagem_erro_flash"] = "Ocoreu um erro. Tente novamente mais tarde.";
      header("Location: " . $this->router->generate("cadastro-propriedade"));
      return;
    }
  }

  public function recuperar($segmentoId): void
  {
    try {
      $usuarioId = $_SESSION['usuario']['id'];

      $segmento = $this->repoSegmentos->existeIdSegmento((int) $segmentoId, $usuarioId);
      if (!$segmento) {
        $_SESSION["mensagem_erro_flash"] = 'Segmento não localizado';
        header("Location: " . $this->router->generate("cadastro-propriedade"));
        return;
      }

      $this->repoSegmentos->recuperarSegmento((int) $segmentoId, $usuarioId);

      $_SESSION["mensagem_flash"] = "Segmento recuperado com sucesso.";
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
