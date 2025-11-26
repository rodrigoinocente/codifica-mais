<?php

enum Cargo: string
{
  case MestreDeObra = 'Mestre de Obra';
  case Pedreiro = 'Pedreiro';
  case Auxiliar = 'Auxiliar de Serviços Gerais';
}

class Funcionario
{
  private string $nome;
  private Cargo $cargo;
  private float $salario;

  public function __construct(string $nome, Cargo $cargo, float $salario)
  {
    $this->nome = $nome;
    $this->cargo = $cargo;
    $this->salario = $salario;
  }

  public function alterarCargo(Cargo $novoCargo)
  {
    $this->cargo = $novoCargo;
  }

  public function alterarSalario($novoSalario): void
  {
    try {
      if ($novoSalario < 0) {
        throw new \Exception("O salário não pode ter o valor negativo!" . PHP_EOL . PHP_EOL);
      }
      $this->salario = $novoSalario;
      echo "Salário atualizado com sucesso!" . PHP_EOL;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  public function exibirDetalhes(): void
  {
    echo "Nome do Funcionario $this->nome" . PHP_EOL;
    echo "Cargo: " . $this->cargo->value . PHP_EOL;
    echo "Salário: R$ " . number_format($this->salario, 2, ',', '.') . PHP_EOL . PHP_EOL;
  }
}

$funcionario = new Funcionario('Alberto', Cargo::Auxiliar, 3000);
$funcionario->exibirDetalhes();

//para testar o tratamento
$funcionario->alterarSalario(-100);

$funcionario->alterarSalario(4100);
$funcionario->alterarCargo(Cargo::Pedreiro);
$funcionario->exibirDetalhes();
