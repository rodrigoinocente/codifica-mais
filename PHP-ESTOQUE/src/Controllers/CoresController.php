<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Cores;
use App\Repositories\CoresRepository;

class CoresController
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

            $cor = new Cores($usuarioId, $nome);
            $cor->ehvalido();
            $repoCores = new CoresRepository();

            if ($repoCores->ExisteNomeCor($cor->nome, $cor->usuario_id)) {
                throw new \Exception("Cor $cor->nome já está cadastrada.");
            }

            $repoCores->salvar($cor);

            $_SESSION["mensagem_flash"] = "Cor cadastrada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($corId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoCores = new CoresRepository();
            $repoCores->existeIdCor((int) $corId, $usuarioId);
            $repoCores->excluirCor((int) $corId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Cor excluida com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($corId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoCategoria = new CoresRepository();
            $repoCategoria->existeIdCor((int) $corId, $usuarioId);
            $repoCategoria->recuperarCor((int) $corId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Cor recuperada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
