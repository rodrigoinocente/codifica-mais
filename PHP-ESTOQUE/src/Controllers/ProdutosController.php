<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Produtos;
use App\Repositories\ProdutosRepository;
use App\Service\ProdutoService;

class ProdutosController
{
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function cadastrar()
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];
            $produto = new Produtos(
                $usuarioId,
                (int) $_POST['marca_id'],
                (int) $_POST['cor_id'],
                (int) $_POST['categoria_id'],
                (int) $_POST['tamanho_id'],
                (int) $_POST['genero_id'],
                (int) $_POST['segmento_id'],
                $_POST['nome'],
                (int)$_POST['quantidade'],
                $_POST['descricao'],
            );

            $produto->ehvalido();

            $serviceProduto = new ProdutoService();
            $serviceProduto->validarProduto($produto, $usuarioId);

            $repoProduto = new ProdutosRepository;
            $repoProduto->salvar($produto);

            $_SESSION['mensagem_flash'] = "Produto cadastrado com sucesso.";
            header("Location: /dashboard");
            return;
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-produto"));
            return;
        }
    }



    public function atualizarProduto()
    {
        try {
            $usuarioId = (int) $_SESSION['usuario']['id'];
            $produto = new Produtos($usuarioId, ...$_POST);

            $serviceProduto = new ProdutoService();
            $serviceProduto->validarProduto($produto, $usuarioId);

            $repoProduto = new ProdutosRepository;
            $repoProduto->atualizar($produto);

            $_SESSION['mensagem_flash'] = "Produto atualizado com sucesso.";
            header("Location: /dashboard");
            return;
        } catch (\Exception $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("atualizar-produtoForm", ["produtoId" => $_POST['id']]));
            return;
        }
    }

    public function deletarProduto($produtoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];

            $repoProduto = new ProdutosRepository();
            $repoProduto->deletar($produtoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Pruduto deletado com sucesso.";

            header("Location: /dashboard");
            return;
        } catch (\Throwable $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }


    public function recuperarProduto($produtoId)
    {
        try {
            $usuarioId = $_SESSION['usuario']['id'];

            $repoProduto = new ProdutosRepository();
            $repoProduto->recuperarProduto($produtoId, $usuarioId);

            $_SESSION["mensagem_flash"] = "Pruduto recuperado com sucesso.";

            header("Location: " . $this->router->generate("produtos-excluidos"));
            return;
        } catch (\Throwable $e) {
            $_SESSION["mensagem_erro_flash"] = $e->getMessage();
            header("Location: " . $this->router->generate("cadastro-propriedade"));
            return;
        }
    }
}
