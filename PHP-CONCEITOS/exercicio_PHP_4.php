<?php

$bigNumber = 0;

while (true) {
    $input = (int) readline("Insira um número inteiro: ");

    if ($input == -1) {
        echo "Verificando..." . PHP_EOL . PHP_EOL;
        break;
    }

    if ($input > $bigNumber) {
        $bigNumber = $input;
    }
}

echo "O maior número inserido é: $bigNumber" . PHP_EOL;