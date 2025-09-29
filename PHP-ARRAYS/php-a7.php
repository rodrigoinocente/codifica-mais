<?php

$itens = ["Carne", "Carvão", "Cerveja", "Refrigerante", "Suco"];
$precos = [300.5, 30.7, 100.1, 53.6, 51.4];

//Calculo para o preço total dos itens
$precoTotal = 0;
for ($i = 0; $i < count($precos); $i++) {
    $precoTotal += $precos[$i];
}

//Captura da quantidade de participantes e o valor da contribuição indiviudal
$totalParticipantes = (int) readline("Total de participantes no churrasco: ");
if ($totalParticipantes <= 1) {
    echo "O churrasco foi cancelado, todo mundo furou!" . PHP_EOL;
    return;
}

function valorPorParticipante($precoTotal, $totalParticipantes)
{
    return $precoTotal / $totalParticipantes;
}
$valorDoParticipante = number_format(valorPorParticipante($precoTotal, $totalParticipantes), 2, ",", ".");
echo "Cada participante deverá contribuir com R$$valorDoParticipante" . PHP_EOL;

//Econtrando a posição do item mais caro
$valorItemMaisCaro = 0;
$posicaoItemMaisCaro = 0;
foreach ($precos as $key => $value) {
    if ($value > $valorItemMaisCaro) {
        $valorItemMaisCaro = $value;
        $posicaoItemMaisCaro = $key;
    }
}

//Formatando e exibindo resultados
$valorItemMaisCaro = number_format($valorItemMaisCaro, 2, ",", ".");
echo "O item mais caro do churrasco é a(o) {$itens[$posicaoItemMaisCaro]}: R$$valorItemMaisCaro" . PHP_EOL;
