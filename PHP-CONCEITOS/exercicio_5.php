<?php

echo "______Ímpar ou par______" . PHP_EOL;
echo "Digite um número: ";
$input = (int) trim(fgets(STDIN));

if ($input % 2 == 0) {
    echo "O número informado é par" . PHP_EOL;
} else {
    echo "O número informado é ímpar" . PHP_EOL;
}