<?php

namespace App\Models;

use Exception;

class Produtos
{
    public int $usuario_id;
    public int $marca_id;
    public int $cor_id;
    public int $categoria_id;
    public int $tamanho_id;
    public int $genero_id;
    public int $segmento_id;
    public string $nome;
    public int $quantidade;
    public string $descricao;
    public ?int $id;
    public ?string $criado_em;
    public ?string $deletado_em;

    public function __construct(
        int $usuario_id,
        int $marca_id,
        int $cor_id,
        int $categoria_id,
        int $tamanho_id,
        int $genero_id,
        int $segmento_id,
        string $nome,
        int $quantidade,
        string $descricao,
        ?int $id = null,
        ?string $criado_em = null,
        ?string $deletado_em = null,
    ) {
        $this->usuario_id = $usuario_id;
        $this->marca_id = $marca_id;
        $this->cor_id = $cor_id;
        $this->categoria_id = $categoria_id;
        $this->tamanho_id = $tamanho_id;
        $this->genero_id = $genero_id;
        $this->segmento_id = $segmento_id;
        $this->nome = trim($nome);
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->id = $id;
        $this->criado_em = $criado_em;
        $this->deletado_em = $deletado_em;
    }

    public function ehDadosValidos(): array
    {
        if (empty($this->nome) || mb_strlen($this->nome) < 3) {
            return ['erro' => true, 'mensagem' => 'Nome inválido. É preciso ter mais que 3 dígitos.'];
        }

        if (
            $this->marca_id <= 0 ||
            $this->cor_id <= 0 ||
            $this->categoria_id <= 0 ||
            $this->tamanho_id <= 0 ||
            $this->genero_id <= 0 ||
            $this->segmento_id <= 0
        ) {
            return ['erro' => true, 'mensagem' => 'Erro na verificação dos dados.'];
        }

        if ($this->usuario_id <= 0) {
            return ['erro' => true, 'mensagem' => 'Usuário inválido'];
        }

        if ($this->quantidade <= 0) {
            return ['erro' => true, 'mensagem' => 'A quantidade não pode ser menor ou igual a 0.'];
        }

        return ['erro' => false, 'mensagem' => null];
    }
}
