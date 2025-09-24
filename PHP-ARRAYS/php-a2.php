<?php

$largura = readline("Insira a largura: ");
$altura = readline("Insira a altura: ");

$area = $largura * $altura;
$perimetro = 2 * ($largura + $altura);   

echo "____Resultado____" . PHP_EOL;
echo "Área: $area m²" . PHP_EOL;
echo "Perímetro: $perimetro metros" . PHP_EOL;