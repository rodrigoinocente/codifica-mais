<?php

$valorDaCompra = (float) readline("Insira o valor da compra: ");
$valorDesconto = (int) readline("Insira o deconto: ");


function aplicarDesconto($valorDaCompra, $percentualDesconto)
{
    return $valorDaCompra - ($valorDaCompra * ($percentualDesconto / 100));
}

function calcularDescontoProgressivo($valorDaCompra)
{
    if ($valorDaCompra < 100) {
        return $valorDaCompra;
    } elseif ($valorDaCompra >= 100 && $valorDaCompra <= 500) {
        return $valorDaCompra - ($valorDaCompra * .1);
    } elseif ($valorDaCompra > 500) {
        return $valorDaCompra - ($valorDaCompra * .2);
    }
}

$descontoAplicado = number_format(aplicarDesconto($valorDaCompra, $valorDesconto), 2, ",", ".");
$escontoProgressivo = number_format(calcularDescontoProgressivo($valorDaCompra), 2, ",", ".");
$valorDaCompra = number_format($valorDaCompra, 2, ",", ".");

echo PHP_EOL . "____________Resultado____________" . PHP_EOL;
echo "Valor inicial da compra R$$valorDaCompra" . PHP_EOL;
echo "Valor da compra com Desconto Aplicado R$$descontoAplicado" . PHP_EOL;
echo "Valor da compra com Desconto Progressivo R$$escontoProgressivo" . PHP_EOL;