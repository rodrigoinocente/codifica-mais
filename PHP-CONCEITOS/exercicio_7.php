<?php

echo "______Tabuada______" . PHP_EOL;
echo "Digite o número da tabuada: ";
$input = (int) trim(fgets(STDIN));
echo PHP_EOL;

for ($i = 1; $i <= 10; $i++) {
    echo "$input X $i = " . $input * $i . PHP_EOL;
}