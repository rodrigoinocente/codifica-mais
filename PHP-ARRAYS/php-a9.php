<?php

$estoque = [
    ["Bermuda", 59.9, 6],
    ["Camisa", 89.9, 5],
    ["Sapato", 179.9, 10],
    ["Calça", 99.9, 7]
];

$valorTotal = 0;

for ($i = 0; $i < count($estoque); $i++) {
    $valorTotal += $estoque[$i][1] * $estoque[$i][2];
}

echo "Valor total que a loja tem de estoque R$" . number_format($valorTotal, 2, ",", ".") . PHP_EOL;
