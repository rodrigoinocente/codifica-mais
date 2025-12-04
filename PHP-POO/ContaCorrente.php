<?php

namespace TipoConta;

require_once __DIR__ . "/ContaBancaria.php";

use \ContaModel\ContaBancaria;

class ContaCorrente extends ContaBancaria
{
  private const TAXA_SAQUE = 3.50;
  private const TAXA_TRANSFERENCIA = 1.50;

  public function __construct(string $nomeTitular, $saldo)
  {
    $numeroGerado = self::gerarNumeroConta();
    parent::__construct($nomeTitular, $numeroGerado, $saldo);
  }

  public function transferirDinheiro(ContaBancaria $conta, $valor): void
  {
    parent::sacar($valor + self::TAXA_TRANSFERENCIA);
    $conta->depositar($valor);
    echo "Transferência no valor de R$ $valor realizada com sucesso" . PHP_EOL;
  }

  private static function gerarNumeroConta(): string
  {
    $oitoDigitos = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
    $ultimoDigito = rand(0, 9);
    $numeroContaCompleto = $oitoDigitos . '-' . $ultimoDigito;
    return $numeroContaCompleto;
  }

  public function sacar($valor): void
  {
    if ($valor + self::TAXA_SAQUE > $this->saldo) {
      throw new \Exception("Saldo insuficiente para realizar o saque de R$ " . number_format($valor, 2, ',', '') . PHP_EOL);
    }
    $this->saldo -= $valor + self::TAXA_SAQUE;
    echo "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!" . PHP_EOL;
  }
}