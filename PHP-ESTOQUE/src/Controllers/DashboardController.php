<?php

namespace App\Controllers;

use AltoRouter;
use App\Repositories\ProdutosRepository;
use App\Service\ProdutoService;

class DashboardController
{
    private AltoRouter $router;
    private ProdutosRepository $repoProdutos;
    private ProdutoService $serviceProdutos;

    public function __construct(AltoRouter $router)
    {
      $this->router = $router;
      $this->repoProdutos = new ProdutosRepository();
      $this->serviceProdutos = new ProdutoService();
    }
    public function index(): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        $produtos = $this->repoProdutos->buscarProdutos($usuarioId);

        require __DIR__ . '/../Views/dashboard.php';
        return;
      }catch (\Exception $e){
        echo 'Página não localizada'. PHP_EOL;
        return;
      }
    }

    public function cadastroPropriedade(): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $dados = $this->serviceProdutos->getTodasPropriedades($usuarioId);
        if ($dados['erro']) {
          echo 'Página não localizada'. PHP_EOL;
          return;
        }

        extract($dados);

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/cadastro-propriedade.php';
        return;
      } catch (\Exception $e) {
        echo 'Página não localizada'. PHP_EOL;
        return;
      }
    }

    public function cadastroProduto(): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];

        $dados = $this->serviceProdutos->getPropriedadesDisponiveis($usuarioId);
        if ($dados['erro']) {
          $_SESSION["mensagem_erro_flash"] = $dados['mensagem'];;
          header("Location: " . $this->router->generate('dashboard'));
          return;
        }
        extract($dados);

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/cadastro-produto.php';
        return;
      } catch (\Exception $e) {
        echo 'Página não localizada'. PHP_EOL;
        return;
      }
    }

    public function atualizarProdutoForm($produtoId): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];
        $produto = $this->repoProdutos->buscarPorId((int)$produtoId, $usuarioId);
        if (!$produto) {
          $_SESSION["mensagem_erro_flash"] = "Produto não encontrado";;
          header("Location: " . $this->router->generate('dashboard'));
          return;
        }

        $dados = $this->serviceProdutos->getPropriedadesDisponiveis($usuarioId);
        if ($dados['erro']) {
          $_SESSION["mensagem_erro_flash"] = $dados['mensagem'];
          header("Location: " . $this->router->generate('dashboard'));
          return;
        }
        extract($dados);

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/atualizar-produto.php';
        return;
      } catch (\Exception $e) {
        echo 'Página não localizada'. PHP_EOL;
        return;
      }
    }

    public function produtosExcluidos(): void
    {
      try {
        $usuarioId = $_SESSION['usuario']['id'];
        $produtos = $this->repoProdutos->buscarProdutosExcluidos($usuarioId);

        $erro = $_SESSION["mensagem_erro_flash"] ?? null;
        unset($_SESSION["mensagem_erro_flash"]);

        $mensagem = $_SESSION["mensagem_flash"] ?? null;
        unset($_SESSION["mensagem_flash"]);

        require __DIR__ . '/../Views/produtos-excluidos.php';
        return;
      } catch (\Exception $e) {
        echo 'Página não localizada'. PHP_EOL;
        return;
      }
    }
}
