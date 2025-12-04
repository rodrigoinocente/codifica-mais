<?php

namespace ContaModel;


class ContaBancaria
{
  protected string $numeroConta;
  protected string $nomeTitular;
  protected float $saldo;

  public function __construct(string $nomeTitular, string $numeroConta, float $saldo = 0)

  {
    $this->numeroConta = $numeroConta;
    $this->nomeTitular = $nomeTitular;
    $this->saldo = self::validarSaldoInicial($saldo);
  }

  public function depositar($valor): void
  {
    if ($valor <= 0) {
      throw new \Exception("A valor não pode ser menor ou igual a 0 \n");
    }
    $this->saldo += $valor;

    echo "Deposito de $valor realizado com sucesso" . PHP_EOL;
  }

  public function sacar($valor): void
  {
    if ($valor > $this->saldo) {
      throw new \Exception("Saldo insuficiente para realizar o saque de R$ " . number_format($valor, 2, ',', '.') . PHP_EOL . PHP_EOL);
    }
    $this->saldo -= $valor;
    echo "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!" . PHP_EOL;
  }

  public function getSaldo(): void
  {
    echo "Conta: $this->numeroConta - Titular: $this->nomeTitular - Saldo: $this->saldo" . PHP_EOL;
  }

  public function getNumeroConta()
  {
    echo "Número da conta: {$this->numeroConta}" . PHP_EOL;
  }

  public function getTitular(): void
  {
    echo "Titular: $this->nomeTitular" . PHP_EOL;
  }

  private static function validarSaldoInicial($valor)
  {
    if ($valor < 0) {
      throw new \Exception("O saldo inicial não poder ser menor que 0" . PHP_EOL);
    }
    return $valor;
  }
}

// $conta = new ContaBancaria('Juliana Santos', 1, 500);
// $conta->depositar(100);

// // para testar o tratamento
// $conta->sacar(5000);

// $conta->sacar(50);
// echo "Saldo: R$ " . $conta->verSaldo(), PHP_EOL;
