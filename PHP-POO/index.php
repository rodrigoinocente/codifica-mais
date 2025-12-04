<?php

require_once __DIR__ . "/ContaPoupanca.php";
require_once __DIR__ . "/ContaCorrente.php";

use TipoConta\ContaCorrente;
use TipoConta\ContaPoupanca;

try {
  echo "### Criar uma ContaCorrente e uma ContaPoupanca com valores iniciais válidos e inválidos." . PHP_EOL;
  $contaCorrente = new ContaCorrente("Maria", 300);
  $contaPoupanca = new ContaPoupanca("Carla", 700);
  $contaCorrenteTeste = new ContaCorrente("Juliana", -300);
} catch (\Exception $e) {
  echo $e->getMessage();
}

echo PHP_EOL;

try {
  echo "### Mostrar números de conta (para ver o formato diferente de Conta Corrente e ContaPoupança)" . PHP_EOL;
  $contaCorrente->getNumeroConta();
  $contaPoupanca->getNumeroConta();
  echo PHP_EOL;

  echo "### Saque Conta Poupança" . PHP_EOL;
  $contaPoupanca->sacar(100);

  echo "### Saque com taxa na Conta Corrente" . PHP_EOL;
  $contaCorrente->sacar(100);
  $contaCorrente->getSaldo();
  echo PHP_EOL;

  echo "### Saque com taxa na Conta Corrente" . PHP_EOL;
  $contaCorrente->transferirDinheiro($contaPoupanca, 100);
  $contaCorrente->getSaldo();
  echo PHP_EOL;

  $contaPoupanca->getPorcentagemRendimento();
  echo "### Alterar rendimento" . PHP_EOL;
  $contaPoupanca->setPorcentagemRendimento(10);
  $contaPoupanca->getPorcentagemRendimento();
  echo PHP_EOL;

  echo "### Exibir saldo" . PHP_EOL;
  $contaPoupanca->getSaldo();
  echo PHP_EOL;

  echo "### Aplicar rendimento" . PHP_EOL;
  $contaPoupanca->aplicarRendimento();

  echo "### Exibir novo saldo" . PHP_EOL;
  $contaPoupanca->getSaldo();
} catch (\Exception $e) {
  echo $e->getMessage();
}