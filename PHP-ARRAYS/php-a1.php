<?php

$valorDaConta = readline("Insira o valor total da conta: ");
$gorjeta = readline("Insira a porcentagem da gorjeta: ");

$valorGorjeta = $valorDaConta * ($gorjeta / 100);
$valorTotalConta = $valorDaConta + $valorGorjeta;

$valorGorjetaForm =  number_format($valorGorjeta, 2, ",", ".");
$valorTotalContaForm = number_format($valorDaConta + $valorGorjeta, 2, ",", ".");

echo "Valor da gorjeta: R$$valorGorjetaForm" . PHP_EOL;
echo "Valor total a ser pago: R$$valorTotalContaForm" . PHP_EOL;