<?php

namespace TipoConta;

require_once __DIR__ . "/ContaBancaria.php";

use \ContaModel\ContaBancaria;

class ContaPoupanca extends ContaBancaria
{
  protected float $porcentagemRendimento;

  public function __construct(string $nomeTitular, $saldo)
  {
    $numeroGerado = self::gerarNumeroConta();
    $this->porcentagemRendimento = 0.01;
    parent::__construct($nomeTitular, $numeroGerado, $saldo);
  }

  private static function gerarNumeroConta(): string
  {
    $seisDigitos = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    $ultimoDigito = rand(0, 9);
    $numeroContaCompleto = $seisDigitos . '-' . $ultimoDigito;
    return $numeroContaCompleto;
  }

  public function getPorcentagemRendimento(): void
  {
    echo "O rendimento está em " . $this->porcentagemRendimento * 100 . '%' . PHP_EOL;
  }

  public function setPorcentagemRendimento($novoValor): void
  {
    $this->porcentagemRendimento = $novoValor / 100;
  }

  public function aplicarRendimento()
  {
    $rendimento = $this->saldo * $this->porcentagemRendimento;
    $this->saldo += $rendimento;
  }
}