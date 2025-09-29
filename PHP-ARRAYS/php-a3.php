<?php

$temperatura = readline("Insira a temperatura: ");
$unidadeMedida = readline("Insira a unidade de medida. Exemplo C ou F: ");


if ($unidadeMedida == "C" || $unidadeMedida == "c") {
    $fahrenheit = number_format(($temperatura * 9 / 5) + 32, 2, ".", ",");
    
    echo "Temperatura: " . $temperatura . "°C" . PHP_EOL;
    echo "Temperatura em Fahrenheit: " . $fahrenheit . "°F" . PHP_EOL;
} elseif ($unidadeMedida == "F" || $unidadeMedida == "f") {
    $celsius = number_format(($temperatura - 32) * 5 / 9, 2, ".", ",");

    echo "Temperatura: " . $temperatura . "°F" . PHP_EOL;
    echo "Temperatura em Celsius: " . $celsius . "°C" . PHP_EOL;
} else {
    echo "Algo deu errado" . PHP_EOL;
}
