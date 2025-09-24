<?php

function calculoDeDesconto($valorOriginal, $porcentagem)
{
    return $valorOriginal - ($valorOriginal * ($porcentagem / 100));
}

$resultado = number_format(calculoDeDesconto(100, 10), 2, ",", ".");
echo "Valor final com desconto R$$resultado" . PHP_EOL;