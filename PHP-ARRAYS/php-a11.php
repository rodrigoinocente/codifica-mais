<?php

$estoque = [];

function adicionarProduto(&$estoque)
{
	echo PHP_EOL . "=== Adicionar Produto ===" . PHP_EOL;

	$codigo = intval(trim(readline("Digite o CÓDIGO: ")));
	if (encontrarPosicaoPeloCodigo($estoque, $codigo) !== false) {
		echo PHP_EOL . "O código $codigo inserido já está em uso!" . PHP_EOL;

		while (encontrarPosicaoPeloCodigo($estoque, $codigo) !== false) {
			$codigo++;
		}
		echo PHP_EOL . "CODIGO ALTERADO PARA: $codigo" . PHP_EOL;
	}

	$nome = trim(readline("Digite o NOME: "));
	$tamanho = trim(strtoupper(readline("Digite o TAMANHO: ")));
	$cor = trim(readline("Digite a COR: "));
	$quantidade = intval(trim(readline("Digite a QUANTIDADE em estoque: ")));

	if (empty($codigo) || empty($nome) || empty($tamanho) || empty($cor) || empty($quantidade)) {
		echo PHP_EOL . "Erro: Garanta que todos os campos estejam preenchidos." . PHP_EOL;
		return;
	}

	$estoque[] = [
		"codigo" => $codigo,
		"nome" => $nome,
		"tamanho" => $tamanho,
		"cor" => $cor,
		"quantidade" => $quantidade
	];

	echo PHP_EOL . "PRODUTO ADICIONADO COM SUCESSO!" . PHP_EOL;
}

function venderProduto(&$estoque)
{
	echo PHP_EOL . "=== Vender Produto ===" . PHP_EOL;
	$codigo = intval(trim(readline("Digite o CÓDIGO: ")));
	$posiçaoProduto = encontrarPosicaoPeloCodigo($estoque, $codigo);
	if ($posiçaoProduto === false) {
		echo PHP_EOL . "Produto não encontrado!" . PHP_EOL;
		return;
	}

	$quantidade = intval(trim(readline("Digite a QUANTIDADE: ")));
	if ($quantidade > $estoque[$posiçaoProduto]["quantidade"]) {
		echo PHP_EOL . "O produto ({$estoque[$posiçaoProduto]["nome"]}) possui {$estoque[$posiçaoProduto]["quantidade"]} unidade(s) em estoque." . PHP_EOL;
		echo "Não é possivel realizar a venda!" . PHP_EOL;
		return;
	}

	$estoque[$posiçaoProduto]["quantidade"] -= $quantidade;

	if ($estoque[$posiçaoProduto]["quantidade"] == 0) {
		echo PHP_EOL . "O item ({$estoque[$posiçaoProduto]["nome"]}) teve sua quantidade zerada e foi REMOVIDO do estoque." . PHP_EOL;
		unset($estoque[$posiçaoProduto]); //função retira o produto porem não mantem a integridade do indice associativo!
	}
	echo PHP_EOL . "VENDA REALIZADA COM SUCESSO!!!" . PHP_EOL;
}

function verificarEstoque($estoque)
{
	while (true) {
		echo PHP_EOL . "=== Verificar Estoque ===" . PHP_EOL;
		echo "(1) Pesquisar por nome" . PHP_EOL;
		echo "(2) Pesquisar por código" . PHP_EOL;
		echo "(3) Sair" . PHP_EOL;

		$input = trim(readline("Escolha a opção desejada: "));

		switch ($input) {
			case '1':
				echo PHP_EOL;
				$produtoString = trim(strtolower(readline("Digite o nome do produto: ")));

				$posiçaoProduto = array_search( //encontra a posição de "produtoString" ou retorna false
					$produtoString,
					array_map(		// retorna o array com os nomes em letra minuscula
						function ($itemDaLista) {
							return mb_strtolower($itemDaLista["nome"], "UTF-8");
						},
						$estoque
					)
				);

				if ($posiçaoProduto === false) {
					echo PHP_EOL . "Produto não encontrado!" . PHP_EOL;
					break;
				}

				$produto =  $estoque[$posiçaoProduto];
				echo PHP_EOL . "___>>> Item Localizado <<<___" . PHP_EOL . PHP_EOL;
				exibirProduto($produto);
				echo "_____________________________" . PHP_EOL;
				break;

			case '2':
				echo PHP_EOL;
				$codigo = intval(trim(readline("Digite o código do produto: ")));
				$posiçaoProduto = encontrarPosicaoPeloCodigo($estoque, $codigo);
				if ($posiçaoProduto === false) {
					echo PHP_EOL . "Produto não encontrado!" . PHP_EOL;
					return;
				}

				$produto =  $estoque[$posiçaoProduto];
				echo PHP_EOL . "___>>> Item Localizado <<<___" . PHP_EOL . PHP_EOL;
				exibirProduto($produto);
				echo "_____________________________" . PHP_EOL;
				break;

			case '3':
				return;
			default:
				echo PHP_EOL . "Escolha uma opção valida!" . PHP_EOL;
				break;
		}
	}
}

function listarEstoque($estoque)
{
	echo PHP_EOL . "===== ESTOQUE =====" . PHP_EOL;

	if (count($estoque) == 0) {
		echo "       VAZIO!" . PHP_EOL;
		return;
	}

	foreach ($estoque as $produto) {
		echo PHP_EOL . "-------------------" . PHP_EOL;
		exibirProduto($produto);
		echo "-------------------" . PHP_EOL;
	}
	echo PHP_EOL . "===================" . PHP_EOL;
}

function exibirProduto($produto)
{
	echo "Código: {$produto["codigo"]}" . PHP_EOL;
	echo "Nome: {$produto["nome"]}" . PHP_EOL;
	echo "Tamanho: {$produto["tamanho"]}" . PHP_EOL;
	echo "Cor: {$produto["cor"]}" . PHP_EOL;
	echo "Quantidade: {$produto["quantidade"]}" . PHP_EOL;
}

function atualizarProduto(&$estoque)
{
	echo PHP_EOL . "=== Atualizar Produto ===" . PHP_EOL;
	$codigo = intval(trim(readline("Digite o CÓDIGO: ")));

	$posiçaoProduto = encontrarPosicaoPeloCodigo($estoque, $codigo);
	if ($posiçaoProduto === false) {
		echo PHP_EOL . "PRODUTO NÃO ENCONTRADO" . PHP_EOL;
		return;
	}

	echo PHP_EOL . ">>>> Produto Selecionado <<<<" . PHP_EOL;
	exibirProduto($estoque[$posiçaoProduto]);
	echo "=============================" . PHP_EOL . PHP_EOL;

	echo "Digite \"sim\" para selecionar a propriedade desejada!" . PHP_EOL;
	$propriedadesLista = ["NOME", "TAMANHO", "COR", "QUANTIDADE"];
	foreach ($propriedadesLista as $prop) {
		$input = trim(strtolower(readline("Atualizar $prop? ")));
		if ($input == "sim") {
			$propriedadeSelecionada = strtolower($prop);
			break;
		}
	}

	if (empty($propriedadeSelecionada)) {
		echo PHP_EOL . "NENHUMA PROPRIEDADE FOI SELECIONADA!" . PHP_EOL;
		return;
	}

	$novoValor = trim(readline("Digite o novo valor da propriedade: "));
	if (empty($novoValor)) {
		echo PHP_EOL . "NOVO VALOR NÃO INSERIDO. ATUALIZAÇÃO NÃO REALIZADA!" . PHP_EOL;
		return;
	}

	$estoque[$posiçaoProduto][$propriedadeSelecionada] = $novoValor;
	echo PHP_EOL . "=== PRODUTO ATUALIZADO COM SUCESSO! ===" . PHP_EOL;
	exibirProduto($estoque[$posiçaoProduto]);
	echo "=====================================" . PHP_EOL;
}

function encontrarPosicaoPeloCodigo($estoque, $codigo)
{
	return array_search( //array_search se tiver sucesso irá retorna o indice(int), caso contrario será bool(false) do array montado por array_map
		$codigo,
		array_map( //array_map fará um array com os valores da chave (mantendo o indice) "codigo" contidos em $estoque
			function ($itemDaLista) {
				return $itemDaLista["codigo"];
			},
			$estoque
		)
	);
}

function exibirMenu($estoque)
{
	while (true) {

		echo PHP_EOL . "==== GERENCIAMENTO DE ESTOQUE ====" . PHP_EOL;
		echo "(1) Adicionar um produto" . PHP_EOL;
		echo "(2) Remover um produto" . PHP_EOL;
		echo "(3) Verificar o estoque" . PHP_EOL;
		echo "(4) Listar o estoque" . PHP_EOL;
		echo "(5) Atualizar o estoque" . PHP_EOL;
		echo "(6) Sair" . PHP_EOL;
		echo "==================================" . PHP_EOL;

		$input = readline("Escolha a opção desejada: ");

		switch ($input) {
			case '1':
				adicionarProduto($estoque);
				break;

			case '2':
				venderProduto($estoque);
				break;

			case '3':
				verificarEstoque($estoque);
				break;

			case '4':
				listarEstoque($estoque);
				break;

			case '5':
				atualizarProduto($estoque);
				break;

			case '6':
				echo "Saindo..." . PHP_EOL;
				exit();
				break;
			default:
				echo PHP_EOL . "Digite um valor valido!" . PHP_EOL;
				break;
		}
	}
}

exibirMenu($estoque);
