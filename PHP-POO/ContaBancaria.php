<?php


class ContaBancaria
{
  private int $numeroConta;
  private string $nomeTitular;
  private float $saldo;

  public function __construct(string $nomeTitular, int $numeroConta, float $saldo)
  {
    $this->numeroConta = $numeroConta;
    $this->nomeTitular = $nomeTitular;
    $this->saldo = $saldo;
  }

  public function depositar($quantia): void
  {
    $this->saldo += $quantia;
  }

  public function sacar($quantia): void
  {
    try {
      if ($quantia > $this->saldo) {
        throw new \Exception("Saldo insuficiente para realizar o saque de R$ " . number_format($quantia, 2, ',', '') . PHP_EOL . PHP_EOL);
      }
      $this->saldo -= $quantia;
      echo "Saque de R$ " . number_format($quantia, 2, ',', '.') . " realizado com sucesso!" . PHP_EOL;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  public function verSaldo(): string //number_format retorna uma string
  {
    return  number_format($this->saldo, 2, ',', '.');
  }
}

$conta = new ContaBancaria('Juliana Santos', 1, 500);
$conta->depositar(100);

//para testar o tratamento
$conta->sacar(5000);

$conta->sacar(50);
echo "Saldo: R$ " . $conta->verSaldo(), PHP_EOL;
