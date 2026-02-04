<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Segmentos;
use App\Repositories\SegmentosRepository;

class SegmentosController
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

            $segmento = new Segmentos($usuarioId, $nome);
            $segmento->ehvalido();
            $repoSegmentos = new SegmentosRepository();

            if ($repoSegmentos->existeNomeSegmento($segmento->nome, $segmento->usuario_id)) {
                throw new \Exception("Segmento $segmento->nome já está cadastrada.");
            }
            
            $repoSegmentos->salvar($segmento);

            $_SESSION["mensagem_flash"] = "Segmento cadastrado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($segmentoId)
    {
        try {
            // dd(1);
            $usuarioId = $_SESSION['usuario']['id'];
            $repoSegmentos = new SegmentosRepository();
            $repoSegmentos->existeIdSegmento((int) $segmentoId, $usuarioId);
            $repoSegmentos->excluirSegmento((int) $segmentoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Segmento excluido com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($segmentoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoSegmentos = new SegmentosRepository();
            $repoSegmentos->existeIdSegmento((int) $segmentoId, $usuarioId);
            $repoSegmentos->recuperarSegmento((int) $segmentoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Segmento recuperado com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
