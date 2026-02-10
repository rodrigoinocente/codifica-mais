<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Marcas;
use App\Repositories\MarcasRepository;

class MarcasController
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

            $marca = new Marcas($usuarioId, $nome);
            $marca->ehvalido();
            $repoMarcas = new MarcasRepository();

            if ($repoMarcas->existeNomeMarca($marca->nome, $marca->usuario_id)) {
                throw new \Exception("Marca $marca->nome já está cadastrada.");
            }

            $repoMarcas->salvar($marca);

            $_SESSION["mensagem_flash"] = "Marca cadastrada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function excluir($marcaId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoCategoria = new MarcasRepository();
            $repoCategoria->existeIdMarca((int) $marcaId, $usuarioId);
            $repoCategoria->excluirMarca((int) $marcaId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Marca excluida com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function recuperar($marcaId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $repoMarca = new MarcasRepository();
            $repoMarca->existeIdMarca((int) $marcaId, $usuarioId);
            $repoMarca->recuperarMarca((int) $marcaId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Marca recuperada com sucesso.";
            header("Location: " . $this->router->generate("cadastro-propriedade"));
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

}
