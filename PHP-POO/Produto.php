<?php

class Produto
{
  private string $nome;
  private float $preco;
  private int $quantidade;

  public function __construct(string $nome, float $preco, int $quantidade)
  {
    $this->nome = $nome;
    $this->preco = $preco;
    $this->quantidade = $quantidade;
  }

  public function alterarPreco($novoPreco): void
  {
    $this->preco = $novoPreco;
  }

  public function alterarQuantidade($novaQuantidade): void
  {
    try {
      if ($novaQuantidade < 0) {
        throw new \Exception("A quantidade não pode ser negativo! Valor declarado: $novaQuantidade" . PHP_EOL . PHP_EOL);
      }
      $this->quantidade = $novaQuantidade;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  public function exibirDetalhes(): void
  {
    echo "Nome do produto: $this->nome" . PHP_EOL;
    echo "Preço: R$ " . number_format($this->preco, 2, ',', '.') . PHP_EOL;
    echo "Quantidade: $this->quantidade" . PHP_EOL . PHP_EOL;
  }
}

$produto = new Produto('Chinelo', 22.10, 40);
echo $produto->exibirDetalhes();

//para testar o tratamento
$produto->alterarQuantidade(-15);

$produto->alterarPreco(30.50);
$produto->alterarQuantidade(10);
echo $produto->exibirDetalhes();
