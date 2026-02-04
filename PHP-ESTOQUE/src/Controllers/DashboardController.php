<?php

namespace App\Controllers;

use AltoRouter;
use App\Repositories\ProdutosRepository;
use App\Service\ProdutoService;
use eftec\bladeone\BladeOne;

class DashboardController
{
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        $repoProduto = new ProdutosRepository();
        $produtos = $repoProduto->buscarProdutos($_SESSION['usuario']['id']);

        require __DIR__ . '/../Views/dashboard.php';
    }

    public function cadastroPropriedade()
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $serviceProduto = new ProdutoService();
            $dados = $serviceProduto->verificarTodosDados($usuarioId);
            extract($dados);

            $erro = $_SESSION["mensagem_erro_flash"] ?? null;
            unset($_SESSION["mensagem_erro_flash"]);

            $mensagem = $_SESSION["mensagem_flash"] ?? null;
            unset($_SESSION["mensagem_flash"]);
            require __DIR__ . '/../Views/cadastro-propriedade.php';
        } catch (\Throwable $th) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }

    public function cadastroProduto()
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];

            $serviceProduto = new ProdutoService();
            $dados = $serviceProduto->verificarDados($usuarioId);
            extract($dados);

            $erro = $_SESSION["mensagem_erro_flash"] ?? null;
            unset($_SESSION["mensagem_erro_flash"]);

            $mensagem = $_SESSION["mensagem_flash"] ?? null;
            unset($_SESSION["mensagem_flash"]);
            require __DIR__ . '/../Views/cadastro-produto.php';
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("dashboard"));
            return;
        }
    }


    public function atualizarProdutoForm($produtoId)
    {
        $usuarioId = $_SESSION['usuario']['id'];

        $repoProdutos = new ProdutosRepository();
        $produto = $repoProdutos->buscarPorId((int)$produtoId, $usuarioId);
        if (!$produto) {
            $_SESSION['mensagem_erro_flash'] = "Produto não encontrado.";
            header("Location: /dashboard/produtos");
            return;
        }

        $serviceProduto = new ProdutoService();
        $dados = $serviceProduto->verificarDados($usuarioId);
        extract($dados);

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/atualizar-produto.php';
    }

    public function produtosExcluidos()
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];

            $repoProduto = new ProdutosRepository();
            $produtos = $repoProduto->buscarProdutosExcluidos($usuarioId);

            $erro = $_SESSION["mensagem_erro_flash"] ?? null;
            unset($_SESSION["mensagem_erro_flash"]);

            $mensagem = $_SESSION["mensagem_flash"] ?? null;
            unset($_SESSION["mensagem_flash"]);

            require __DIR__ . '/../Views/produtos-excluidos.php';
        } catch (\Throwable $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
