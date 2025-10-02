<?php

$aprovados = 0;
$reprovados = 0;

$notasAlunos = [
	[8.5, 6.0, 7.8, 9.2, 5.5],
	[7.0, 8.0, 6.5, 7.5, 8.5],
	[6.5, 7.5, 4.5, 5.5, 7.0],
	[5.0, 4.6, 7.8, 9.0, 6.0]
];

function calcularMedia($notas)
{
	$soma = 0;
	$tamanhoArray = count($notas);
	for ($i = 0; $i < $tamanhoArray; $i++) {
		$soma += $notas[$i];
	}
	return $soma / $tamanhoArray;
}


foreach ($notasAlunos as $key => $notas) {
	$media = calcularMedia($notas);
	$key++;
	echo "Aluno $key:" . PHP_EOL . "Média $media" . PHP_EOL;
	if ($media >= 7) {
		$aprovados++;
		echo "Aprovado" . PHP_EOL;
	} else {
		$reprovados++;
		echo "Reprovado" . PHP_EOL;
	}

	echo PHP_EOL;
}

echo "Aprovados: $aprovados" . PHP_EOL;
echo "Reprovados: $reprovados" . PHP_EOL;
