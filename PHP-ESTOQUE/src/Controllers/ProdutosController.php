<?php

namespace App\Controllers;

use AltoRouter;
use App\Models\Produtos;
use App\Repositories\ProdutosRepository;
use App\Service\ProdutoService;

class ProdutosController
{
    private AltoRouter $router;
    private ProdutoService $serviceProduto;
    private ProdutosRepository $repoProduto;

    public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->serviceProduto = new ProdutoService;
      $this->repoProduto = new ProdutosRepository;
    }

    public function cadastrar(): void
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

        $produtoValidado = $produto->ehDadosValidos();
        if ($produtoValidado['erro']) {
          $_SESSION["mensagem_erro_flash"] = $produtoValidado['mensagem'];
          header("Location: " . $this->router->generate("cadastro-produto"));
          return;
        }

        $propriedadeValidas = $this->serviceProduto->validarPropriedades($produto, $usuarioId);
        if ($propriedadeValidas ['erro']) {
          $_SESSION["mensagem_erro_flash"] = $propriedadeValidas['mensagem'];
          header("Location: " . $this->router->generate("cadastro-produto"));
          return;
        }

        $this->repoProduto->salvar($produto);

        $_SESSION['mensagem_flash'] = "Produto cadastrado com sucesso.";
        header("Location: /dashboard");
        return;
      }catch (\Exception $e) {
        $_SESSION['mensagem_erro_flash'] = "Tivemos um erro. Tente novamente.";
        header("Location: " . $this->router->generate("cadastro-produto"));
        return;
      }

    }

    public function atualizarProduto(): void
    {
      try {
        $usuarioId = (int) $_SESSION['usuario']['id'];

        $produto = new Produtos($usuarioId, ...$_POST);
        $produtoValidado = $produto->ehDadosValidos();
        if ($produtoValidado['erro']) {
          $_SESSION["mensagem_erro_flash"] = $produtoValidado['mensagem'];
          header("Location: " . $this->router->generate("cadastro-produto"));
          return;
        }

        $propriedadeValidas = $this->serviceProduto->verificarDominioPropriedades($produto, $usuarioId);
        if ($propriedadeValidas['erro']) {
          $_SESSION["mensagem_erro_flash"] = $propriedadeValidas['mensagem'];
          header("Location: " . $this->router->generate("atualizar-produtoForm", ["produtoId" => $_POST['id']]));
          return;
        }

        $this->repoProduto->atualizar($produto);

        $_SESSION['mensagem_flash'] = "Produto atualizado com sucesso.";
        header("Location: " . $this->router->generate("dashboard"));
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Tivemos um erro. Tente novamente.";
        header("Location: " . $this->router->generate("atualizar-produtoForm", ["produtoId" => $_POST['id']]));
        return;
      }
  }

    public function deletarProduto($produtoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $produtoValido = $this->serviceProduto->verificarDominioProduto($produtoId, $usuarioId);
        if ($produtoValido['erro']) {
          $_SESSION["mensagem_erro_flash"] = $produtoValido['mensagem'];
          header("Location: " . $this->router->generate("dashboard"));
          return;
        }

        $this->repoProduto->deletar($produtoId, $usuarioId);

        $_SESSION["mensagem_flash"] = "Pruduto deletado com sucesso.";
        header("Location: /dashboard");
        return;
      } catch (\Exception $e) {
        $_SESSION["mensagem_erro_flash"] = "Tivemos um erro. Tente novamente.";
        header("Location: " . $this->router->generate("dashboard"));
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
