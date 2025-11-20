<?php
require __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

$dataInput = readline("Digite a sua data de nascimento (DD/MM/YYYY): ");

$dataNascimento = Carbon::createFromFormat('d/m/Y', $dataInput);
$hoje = Carbon::today();

$idade = $dataNascimento->age;
$semanaNascimento = $dataNascimento->locale('pt_BR')->dayName;
$diasVivos = (int) $dataNascimento->diffInDays($hoje);
$diasParaAniversario = (int) $hoje->diffInDays($dataNascimento->copy()->setYear($hoje->year + 1));
                                                    /* copy() garante que o valor da variavel não seja alterada,
                                                    mantendo sua integridade */

$expectativaDeVidaBrasil2023 = 76;
if ($expectativaDeVidaBrasil2023 > $idade) {
  $anosRestantes = $dataNascimento->copy()->addYears($expectativaDeVidaBrasil2023);
  $diasRestantes = (int) $hoje->diffInDays($anosRestantes);
  $mensagemMotivacional = "Segundo a expectativa de vida do brasileiro (IBGE - 2023), restam-lhe $diasRestantes dias. Carpe Diem!";
}else{
  $mensagemMotivacional = "Parabéns! Você ultrapassou a expectativa de vida no Brasil!!!";
}

echo PHP_EOL;
echo "==============>> RESULTADO <<==============" . PHP_EOL;
echo "Faltam $diasParaAniversario dias para o seu aniversário." . PHP_EOL;
echo "Idade: $idade anos." . PHP_EOL;
echo "Dias de vida: $diasVivos." . PHP_EOL;
echo "Dia da semana que nasceu: $semanaNascimento." . PHP_EOL . PHP_EOL;
echo $mensagemMotivacional . PHP_EOL;
echo "===========================================" . PHP_EOL;