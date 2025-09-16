<?php

echo "______Soma______" . PHP_EOL;

function getNumber()
{
    while (true) {

        $input = trim(fgets(STDIN));

        if (filter_var($input, FILTER_VALIDATE_INT) !== false || filter_var($input, FILTER_VALIDATE_FLOAT) !== false) {
            return $input;
        } else {
            echo "O valor inserido não é um número. Tente novamente: ";
        }

        //PARA CONSISTENCIA NA TIPAGEM, UTILIZE ESSA ESTRUTRA CONDICIONAL
        // if (filter_var($input, FILTER_VALIDATE_INT) !== false) {
        //     return intval($input);
        // } elseif (filter_var($input, FILTER_VALIDATE_FLOAT) !== false) {
        //     return floatval($input);
        // } else {
        //     echo "O valor inserido não é um número. Tente novamente: ";
        // }
    }
}

echo "Digite o 1º número: ";
$number1 = getNumber();

echo "Digite o 2º número: ";
$number2 = getNumber();

echo "O resultado é: " . ($number1 + $number2) . PHP_EOL;