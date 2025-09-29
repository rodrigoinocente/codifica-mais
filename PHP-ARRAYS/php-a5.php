<?php

$altura = readline("Insira a altura: ");
$peso = readline("Insira o peso: ");

$imc = $peso / ($altura * $altura);
$imc = number_format($imc, 2, ".", "");
echo PHP_EOL;

if ($imc < 18.5) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Magreza" . PHP_EOL;
} elseif ($imc <= 24.9) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Normal" . PHP_EOL;
} elseif ($imc <= 29.9) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Sobrepeso" . PHP_EOL;
} elseif ($imc <= 34.9) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Obesidade grau I" . PHP_EOL;
} elseif ($imc <= 39.9) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Obesidade grau II" . PHP_EOL;
} elseif ($imc >= 40) {
    echo "IMC: $imc " . PHP_EOL . "Classificação: Obesidade grau III" . PHP_EOL;
} else {
    echo "Algo deu errado" . PHP_EOL;
}
