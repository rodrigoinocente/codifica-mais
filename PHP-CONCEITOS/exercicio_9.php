<?php

echo "______O maior número______" . PHP_EOL;
echo "Digite um número: ";
$number1 = (int) trim(fgets(STDIN));

echo "Digite um número: ";
$number2 = (int) trim(fgets(STDIN));

echo "O maior número é: " . max($number1, $number2) . PHP_EOL;

// Solução com ternário
// echo "O maior número é: " . ($number1 > $number2? $number1 : $number2) . PHP_EOL;

//Solução com estrutura condicional
// if ($number1 > $number2) {
//     echo "O maior número é: $number1" . PHP_EOL;
// } else {
//     echo "O maior número é: $number2" . PHP_EOL;
// }