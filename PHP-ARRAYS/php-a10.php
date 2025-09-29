<?php

function calcularSalarioTotal($salarioBase, $horasExtras, $valorHoraExtra)
{
	return $salarioBase + (($valorHoraExtra * 1.5) * $horasExtras);
}

function formatarNumero($numero)
{
	return number_format($numero, 2, ",", ".");
}

function listarFuncionarios($funcionarios, $mostrarSalarioTotal = false)
{
	if ($mostrarSalarioTotal) {
		echo "___Lista de Funcionários Atualizada!___" . PHP_EOL;
	} else {
		echo "_________Lista de Funcionários_________" . PHP_EOL;
	}

	foreach ($funcionarios as $key => $funcionario) {
		$valorHora = $funcionario[1] / 160;
		$salarioTotal = formatarNumero(calcularSalarioTotal($funcionario[1], $funcionario[2], $valorHora));
		$salarioFormatado = number_format($funcionarios[$key][1], 2, ",", ".");

		echo "{$funcionarios[$key][0]}:" .  PHP_EOL .
			"   Salário Base: R$" .  $salarioFormatado . PHP_EOL .
			"   Horas Extras: {$funcionarios[$key][2]}" . PHP_EOL;
		if ($mostrarSalarioTotal) {
			$salarioTotal = formatarNumero(calcularSalarioTotal($funcionario[1], $funcionario[2], $valorHora));
			echo "   Salário Total : $salarioTotal" . PHP_EOL;
		}
		echo "-----------------------" . PHP_EOL;
	}
	echo PHP_EOL . PHP_EOL;
}


$funcionarios = [
	["Pedro", 2500, 10],
	["Renata", 3000, 5],
	["Sérgio", 2800, 8],
	["Vanessa", 3200, 12],
	["André", 1700, 0],
];

listarFuncionarios($funcionarios);
listarFuncionarios($funcionarios, $mostrarSalarioTotal = true);
